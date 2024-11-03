<?php
use App\Enum\UserType;
$admin = UserType::ADMIN->value;
?>
<div class="sidebar-wrapper " data-simplebar="true">
    <div class="sidebar-header">
        <h4 class="logo-text">Project Management</h4>
    </div>

    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @if(Auth::user()->user_type->value == $admin)
        <li>
            <a href="{{ route('user.index') }}">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Users</div>
            </a>
        </li>
        @endif
        <li>
            <a href="{{ route('project.index') }}">
                <div class="parent-icon"><i class='bx bx-file'></i>
                </div>
                <div class="menu-title">Projects</div>
            </a>
        </li>
        <li>
            <a href="{{ route('recycle.index') }}">
                <div class="parent-icon"><i class='bx bx-recycle'></i>
                </div>
                <div class="menu-title">Recycle Bin</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>