<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/index', [UserController::class,'index'])->name('user.index');
    Route::get('/user/create', [UserController::class,'create'])->name('user.create');
    Route::post('/user/store', [UserController::class,'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class,'edit'])->name('user.edit');
    Route::post('/user/update/{id}', [UserController::class,'update'])->name('user.update');
    Route::get('/user/show/{id}', [UserController::class,'show'])->name('user.show');
    Route::delete('/user/destroy/{id}', [UserController::class,'destroy'])->name('user.destory');

    Route::get('/project/index', [ProjectController::class,'index'])->name('project.index');
    Route::get('/project/create', [ProjectController::class,'create'])->name('project.create');
    Route::post('/project/store', [ProjectController::class,'store'])->name('project.store');
    Route::get('/project/edit/{id}', [ProjectController::class,'edit'])->name('project.edit');
    Route::post('/project/update/{id}', [ProjectController::class,'update'])->name('project.update');
    Route::get('/project/show/{id}', [ProjectController::class,'show'])->name('project.show');
    Route::delete('/project/destroy/{id}', [ProjectController::class,'destroy'])->name('project.destory');
    Route::delete('/project/multiple/destroy', [ProjectController::class,'destroyMultiple'])->name('project.destory.multiple');

    Route::get('/recycle/index', [ProjectController::class,'recycleIndex'])->name('recycle.index');
    Route::get('/project/restore/{id}', [ProjectController::class,'restore']);
    Route::get('/project/multiple/restore', [ProjectController::class,'restoreMultiple']);

    Route::get('/read-all-notifications',[NotificationController::class,'readAllNotifications'])->name('read.all.notify');
    Route::get('/notifications',[NotificationController::class,'notifications'])->name('notification.index');
    Route::get('/notification/{id}',[NotificationController::class,'notificationRead'])->name('notification.read');
});

require __DIR__.'/auth.php';
