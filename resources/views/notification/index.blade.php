@extends('layouts.master')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{$page_title}}</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{URL::previous()}}" class=" mx-1 btn btn-secondary">Back</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="notifications dropdown-large">
            <div class="header-notifications-list ps">
                @foreach($notifications as $key => $notification)

                <a class="dropdown-item" href="{{route('notification.read',$notification->id)}}">
                    <div class="d-flex align-items-center">
                        <div class="notify bg-light-danger text-danger"><i
                                class="bx {{$notification->data['icon']}}"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="msg-name">{{$notification->data['title']}} <span
                                    class="msg-time float-end">{{$notification->created_at->diffForHumans()}}</span>
                            </h6>
                            <p class="msg-info">{{$notification->data['description']}}</p>
                        </div>
                    </div>
                </a>
                @endforeach
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection