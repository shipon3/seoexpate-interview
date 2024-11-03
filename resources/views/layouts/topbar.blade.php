
<?php

use App\Enum\UserType;
$user_admin = UserType::ADMIN->value;
$admin = auth()->user(); // Assuming the admin is logged in
$notifications = $admin->unreadNotifications;

?>
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="top-menu-left d-none d-lg-block">
                <ul class="nav">
                    <li class="nav-item">
                        <div class="toggle-icon ms-auto nav-link"><i class='bx bx-menu'></i>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                class="alert-count">{{count($notifications)}}</span>
                            <i class="bx bx-bell"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="msg-header">
                                <p class="msg-header-title">Notifications</p>
                                @if(count($notifications) > 0)
                                <p class="msg-header-clear ms-auto">
                                    <a href="{{route('read.all.notify')}}">
                                        Marks all as read
                                    </a>
                                </p>
                                @endif
                            </div>
                            <div class="header-notifications-list ps">
                                @foreach($notifications as $key => $notification)
                                @if($key < 5) <a class="dropdown-item" href="{{route('notification.read',$notification->id)}}">
                                    <div class="d-flex align-items-center">
                                        <div class="notify bg-light-danger text-danger"><i
                                                class="bx bx-file"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">{{$notification->data['title']}} <span
                                                    class="msg-time float-end">{{$notification->created_at->diffForHumans()}}</span>
                                            </h6>
                                            <p class="msg-info">{{$notification->data['description']}}</p>
                                        </div>
                                    </div>
                                    </a>
                                    @endif
                                    @endforeach
                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                    </div>
                                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                    </div>
                            </div>
                            <a href="{{route('notification.index')}}">
                                <div class="text-center msg-footer">View All Notifications</div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown border-light-2">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="#" class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{route('profile.edit')}}"><i class="bx bx-user"></i><span>Profile</span></a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class='bx bx-log-out-circle'></i><span>{{ __('Logout') }}</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>