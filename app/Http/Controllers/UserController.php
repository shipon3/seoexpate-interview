<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $user;

    public function __construct(UserService $userService)
    {
        $this->user = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rows = $this->user->getUsers();
        if($request->wantsJson()){
            return $this->user->dataTable($rows);
        }
        $data = [
            'page_title' => 'Users',
        ];
        return view('user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data =[
            'modal_title' => 'Create',
            'modal_btn' => 'Save',
        ];
        return view('user.modal.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request) : JsonResponse
    {
        $data = $request->validated();
        try {
            $this->user->create($data);
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
        $user = $this->user->details($id);

        $data =[
            'modal_title' => 'Information of user',
            'modal_btn' => 'Close',
            'user' => $user,
        ];
        return view('user.modal.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->user->details($id);
        $data =[
            'modal_title' => 'Edit',
            'modal_btn' => 'Update',
            'user' => $user,
        ];
        return view('user.modal.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $data = $request->validated();
        try {
            $this->user->update($data,$id);
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
            $this->user->delete($id);
            return response()->json(['status' => 'success', 'message'=> 'Data successfully deleted']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message'=> $e->getMessage()]);
        }
    }
}
