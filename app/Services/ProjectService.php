<?php

namespace App\Services;

use App\Enum\ProjectStatus;
use App\Enum\UserType;
use App\Models\Project;
use App\Notifications\ProjectNotification;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
class ProjectService
{
    private UserService $user;
    public function __construct(UserService $userService)
    {
        $this->user = $userService;
    }
    public function getProjects(array $data) : object
    {
        $auth = Auth::user();
        $project = Project::with(['user'])->orderBy('id','desc');
        if($auth->user_type != UserType::ADMIN){
            $project->where('user_id',$auth->id);
        }
        if(!empty($data['user_id'])){
            $project->where('user_id',$data['user_id']);
        }
        if(!empty($data['status'])){
            $project->where('status',$data['status']);
        }
        return $project;
    }
    public function total_project() : object
    {
        $auth = Auth::user();
        $projects = Project::query();
        if($auth->user_type != UserType::ADMIN){
            $projects->where('user_id',$auth->id);
        }
        return $projects->get();
    }
    public function total_active_project() : object
    {
        $auth = Auth::user();
        $active_project = Project::where('status',ProjectStatus::ACTIVE);
        if($auth->user_type != UserType::ADMIN){
            $active_project->where('user_id',$auth->id);
        }
        return $active_project->get();
    }
    public function total_inactive_project() : object
    {
        $auth = Auth::user();
        $inactive_project = Project::where('status',ProjectStatus::INACTIVE);
        if($auth->user_type != UserType::ADMIN){
            $inactive_project->where('user_id',$auth->id);
        }
        return $inactive_project->get();
    }
    public function total_hold_project() : object
    {
        $auth = Auth::user();
        $hold_project = Project::where('status',ProjectStatus::HOLD);
        if($auth->user_type != UserType::ADMIN){
            $hold_project->where('user_id',$auth->id);
        }
        return $hold_project->get();
    }
    public function total_trash_project() : object
    {
        $auth = Auth::user();
        $trash_project = Project::onlyTrashed();
        if($auth->user_type != UserType::ADMIN){
            $trash_project->where('user_id',$auth->id);
        }
        return $trash_project->get();
    }
    public function dataTable(object $rows) : object
    {
        return Datatables::of($rows)
        ->addColumn('assign',function($row){
            return $row->user->name;
        })
        ->addColumn('status',function($row){
            return '<span class="badge" style="color:#000;background:'.$row->status->color().'">'.$row->status->getLabel().'</span>';

        })
        ->addColumn('action', function ($row) {
            return '<button type="button" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit-btn">
                            <i class="bx bx-edit-alt"></i>
                        </button>
                        <button type="button" data-id="' . $row->id . '" class="btn btn-info btn-sm show-btn">
                            <i class="bx bx-show text-whit"></i>
                        </button>
                        <button type="button" data-id="' . $row->id . '" class="btn btn-danger btn-sm delete-btn">
                            <i class="bx bx-trash-alt"></i>
                        </button>';
        })
        ->addIndexColumn()
        ->rawColumns(['action','assign','status'])
        ->make(true);
    }
    public function create(array $data) : void
    {
        $project = new Project();
        $project->name = $data['name'];
        $project->user_id = $data['user_id'];
        $project->description = $data['description'];
        $project->status = $data['status'];
        if(!empty($data['image'])){
            $imageName = time().'.'.$data['image']->extension();
            $data['image']->move(public_path('uploads/projects'), $imageName);
            $project->image = 'uploads/projects/'.$imageName;
        }else{
            $project->image = null;
        }
        $project->save();

        $this->sendNotification($project,'New Project Created');
        return;
    }

    public function details(int $project_id) : object
    {
        return Project::with('user')->findOrFail($project_id);
    }

    public function update(array $data, int $project_id) : void
    {
        $auth = Auth::user();
        $project = Project::with(['user'])->findOrFail($project_id);
        $project->name = $data['name'];
        $project->user_id = $data['user_id'];
        $project->description = $data['description'];
        $project->status = $data['status'];
        if(!empty($data['image'])){
            if (!empty($user->image) && file_exists(public_path($project->image))) {
                unlink(public_path($project->image));
            }
            $imageName = time().'.'.$data['image']->extension();
            $data['image']->move(public_path('uploads/projects'), $imageName);
            $project->image = 'uploads/projects/'.$imageName;
        }
        $project->save();

        $this->sendNotification($project,'Project Status Update');
        
        return;
    }

    public function delete(int $project_id) : void
    {
        $project = Project::with(['user'])->findOrFail($project_id);
        // if (!empty($user->image) && file_exists(public_path($project->image))) {
        //     unlink(public_path($project->image));
        // }
        $this->sendNotification($project,'Project Delete');
        $project->delete();
    }

    public function multipleDelete(array $project_ids) : void
    {
        foreach($project_ids as $key => $item){
          $project = Project::where('id', $item)->first();
            $this->sendNotification($project,'Multiple Project Delete');
            $project->delete();
        }
        return;
    }

    public function trash(array $data) : object
    {
        $auth = Auth::user();
        $project = Project::with(['user'])->onlyTrashed()->orderBy('id','desc');
        if($auth->user_type != UserType::ADMIN){
            $project->where('user_id',$auth->id);
        }
        if(!empty($data['user_id'])){
            $project->where('user_id',$data['user_id']);
        }
        if(!empty($data['status'])){
            $project->where('status',$data['status']);
        }
        return $project;
    }

    public function trashDataTable(object $rows) : object
    {
        return Datatables::of($rows)
        ->addColumn('assign',function($row){
            return $row->user->name;
        })
        ->addColumn('action', function ($row) {
            return '<button type="button" data-id="' . $row->id . '" class="btn btn-danger btn-sm restore-btn">
                            <i class="bx bx-reset"></i>
                        </button>';
        })
        ->addIndexColumn()
        ->rawColumns(['action','assign'])
        ->make(true);
    }

    public function restore(int $project_id) : void
    {
        $project = Project::withTrashed()->find($project_id);
        $project->restore();
        $this->sendNotification($project,'Project Restore');
        return;
    }

    public function multipleRestore(array $project_ids)
    {
        foreach($project_ids as $key => $item){
            $project = Project::withTrashed()->find($item);
            $project->restore();
            $this->sendNotification($project,'Multiple Project Restore');
        }
        return;
    }

    private function sendNotification(Project $project,string $subject) : void
    {
        $auth = Auth::user();
        if($auth->user_type != UserType::ADMIN){
            $admin = $this->user->getAdmin();
            $admin->notify(new ProjectNotification($project,$subject));
            
        }else{
            $user = $project->user;
            $user->notify(new ProjectNotification($project,$subject));
        }
    }
}
