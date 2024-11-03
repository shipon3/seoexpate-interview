<?php

namespace App\Services;

use App\Enum\UserType;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserService
{
    public function getUsers() : object
    {
        return User::where('user_type',UserType::STAFF);
    } 
    public function dataTable(object $rows) : object
    {
        return Datatables::of($rows)
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
            ->rawColumns(['action'])
            ->make(true);
    }
    public function create(array $data) : void
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make(123456);
        $user->user_type = UserType::STAFF;
        if(!empty($data['avater'])){
            $imageName = time().'.'.$data['avater']->extension();
            $data['avater']->move(public_path('uploads/users'), $imageName);
            $user->avater = 'uploads/users/'.$imageName;
        }else{
            $user->avater = null;
        }
        $user->save();
        return;
        
    }

    public function details(int $user_id) : object
    {
        return User::where('id',$user_id)->first();
    }

    public function update(array $data, int $user_id) : void
    {
        $user = User::where('id',$user_id)->first();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->user_type = UserType::STAFF;
        if(!empty($data['avater'])){

            if (!empty($user->avater) && file_exists(public_path($user->avater))) {
                unlink(public_path($user->avater));
            }

            $imageName = time().'.'.$data['avater']->extension();
            $data['avater']->move(public_path('uploads/users'), $imageName);
            $user->avater = 'uploads/users/'.$imageName;
        }
        $user->save();
        return;
    }

    public function delete(int $user_id) : void
    {
        $user = User::where('id',$user_id)->first();

        if (!empty($user->avater) && file_exists(public_path($user->avater))) {
            unlink(public_path($user->avater));
        }

        $user->delete();
        return;
    }

    public function getAdmin(){
        return User::where('user_type',UserType::ADMIN)->first();
    }
}
