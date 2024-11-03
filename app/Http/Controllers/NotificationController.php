<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notifications()
    {
        $admin = Auth::user();
        $notifications =  $admin->unreadNotifications; 
        $data = [
            'page_title' => 'Notifications',
            'notifications' => $notifications,
        ];
        return view('notification.index',$data);
    }
    public function readAllNotifications()
    {
        $admin = Auth::user();
        $admin->unreadNotifications->markAsRead();
        return back();
    }

    public function notificationRead(string $id)
    {
        $admin = Auth::user();
        $notification = $admin->unreadNotifications->where('id', $id)->first();
        if($notification) {
            $notification->markAsRead();
        }
        return back();
    }

}
