<?php
use App\Enum\ProjectStatus;
use App\Enum\UserType;
$active = ProjectStatus::ACTIVE->color();
$inactive = ProjectStatus::INACTIVE->color();
$hold = ProjectStatus::HOLD->color();
$admin = UserType::ADMIN->value;
?>
@extends('layouts.master')

@section('content')
<div class="dashboard-wrap">
    <div class="row row-cols-1 row-cols-lg-4">
        @if(Auth::user()->user_type->value == $admin)
        <div class="col">
            <a href="{{route('user.index')}}">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Total Staff</p>
                                <h5 class="mb-0">{{$total_user}}</h5>
                            </div>
                            <div class="ms-auto">
                                <i class="bx bx-user font-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
        <div class="col">
            <a href="{{route('project.index')}}">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Total Project</p>
                                <h5 class="mb-0">{{$total_project}}</h5>
                            </div>
                            <div class="ms-auto">
                                <i class="bx bx-file font-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{route('project.index')}}">
                <div class="card radius-10 overflow-hidden" style="background: {{$active}}">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0" style="color: #fff">Active Project</p>
                                <h5 class="mb-0" style="color: #fff">{{$total_active_project}}</h5>
                            </div>
                            <div class="ms-auto">
                                <i class="bx bx-file text-white font-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{route('project.index')}}">
                <div class="card radius-10 overflow-hidden" style="background: {{$inactive}}">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0" style="color: #fff">Inactive Project</p>
                                <h5 class="mb-0" style="color: #fff">{{$total_inactive_project}}</h5>
                            </div>
                            <div class="ms-auto">
                                <i class="bx bx-file text-white font-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{route('project.index')}}">
                <div class="card radius-10 overflow-hidden" style="background: {{$hold}}">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Hold Project</p>
                                <h5 class="mb-0">{{$total_hold_project}}</h5>
                            </div>
                            <div class="ms-auto">
                                <i class="bx bx-file font-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{route('recycle.index')}}">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Total Trash Project</p>
                                <h5 class="mb-0">{{$total_trash_project}}</h5>
                            </div>
                            <div class="ms-auto">
                                <i class="bx bx-recycle font-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<!--end row-->
@endsection