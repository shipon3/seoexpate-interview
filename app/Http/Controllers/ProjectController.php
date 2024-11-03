<?php

namespace App\Http\Controllers;

use App\Enum\ProjectStatus;
use App\Enum\UserType;
use App\Http\Requests\ProjectRequest;
use App\Services\ProjectService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private ProjectService $project;

    public function __construct(ProjectService $projectService)
    {
        $this->project = $projectService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, UserService $user)
    {
        $filter_data = [
            'user_id' => $request->user_id,
            'status' => $request->status,
        ];
        $rows = $this->project->getProjects($filter_data);
        if($request->wantsJson()){
            return $this->project->dataTable($rows);
        }

        $data =[
            'page_title' => 'Projects',
            'project_status' => ProjectStatus::options(),
            'admin' => UserType::ADMIN,
            'users' => $user->getUsers()->get(),
        ];

        return view('project.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(UserService $user)
    {
        $data =[
            'modal_title' => 'Create',
            'modal_btn' => 'Save',
            'project_status' => ProjectStatus::options(),
            'users' => $user->getUsers()->get(),
            'admin' => UserType::ADMIN,
        ];
        return view('project.modal.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request, UserService $user) : JsonResponse
    {
        $data = $request->validated();
        try {
            $this->project->create($data,$user);
            return response()->json(['status' => 'success', 'message'=> 'Data successfully created']);
            //code...
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message'=> $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = $this->project->details($id);

        $data =[
            'modal_title' => 'Information of Project',
            'modal_btn' => 'Close',
            'project' => $project,
        ];
        return view('project.modal.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id,UserService $user)
    {
        $project = $this->project->details($id);
        $data =[
            'modal_title' => 'Create',
            'modal_btn' => 'Save',
            'project_status' => ProjectStatus::options(),
            'users' => $user->getUsers()->get(),
            'project' => $project,
            'admin' => UserType::ADMIN,
        ];
        return view('project.modal.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, string $id) : JsonResponse
    {
        $data = $request->validated();
        try {
            $this->project->update($data, $id);
            return response()->json(['status' => 'success', 'message'=> 'Data successfully updated']);
            //code...
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message'=> $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->project->delete($id);
            return response()->json(['status' => 'success', 'message'=> 'Data successfully deleted']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message'=> $e->getMessage()]);
        }
    }

    public function recycleIndex(Request $request, UserService $user){
        $filter_data = [
            'user_id' => $request->user_id,
            'status' => $request->status,
        ];
        $rows = $this->project->trash($filter_data);
        if($request->wantsJson()){
            return $this->project->trashDataTable($rows);
        }

        $data =[
            'page_title' => 'Trash Projects',
            'project_status' => ProjectStatus::options(),
            'admin' => UserType::ADMIN,
            'users' => $user->getUsers()->get(),
        ];

        return view('project.recycle-index',$data);
    }

    public function restore(int $project_id) : JsonResponse
    {
        try {
            $this->project->restore($project_id);
            return response()->json(['status' => 'success', 'message'=> 'Data successfully restore']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message'=> $e->getMessage()]);
        }
    }
}
