<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use App\Services\UserService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private UserService $user;
    private ProjectService $project;

    public function __construct(UserService $userService, ProjectService $projectService)
    {
        $this->user = $userService;
        $this->project = $projectService;
    }

    public function index() {
        $data = [
            'total_user' => count($this->user->getUsers()->get()),
            'total_project' => count($this->project->total_project()),
            'total_active_project' => count($this->project->total_active_project()),
            'total_inactive_project' => count($this->project->total_inactive_project()),
            'total_hold_project' => count($this->project->total_hold_project()),
            'total_trash_project' => count($this->project->total_trash_project()),
        ];

        return view('dashboard',$data);
    }
}
