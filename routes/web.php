<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'admin'])->name('dashboard');
Route::patch('/leave-requests/{leaveRequest}', [LeaveRequestController::class, 'update'])->name('leave-requests.update')->middleware('auth');

Route::get('/dashboard/users/create', [UserController::class, 'create'])->middleware('auth')->name('users.create');
Route::post('/dashboard/users', [UserController::class, 'store'])->middleware('auth')->name('users.store');

Route::get('/dashboard/users', [UserController::class, 'index'])->middleware('auth', 'admin')->name('users.index');
Route::get('/dashboard/users/{user}', [UserController::class, 'show'])->middleware('auth')->name('users.show');

Route::get('/dashboard/users/{user}/edit', [UserController::class, 'edit'])->middleware('auth')->name('users.edit');
Route::patch('/dashboard/users/{user}', [UserController::class, 'update'])->middleware('auth')->name('users.update');

Route::get('employee/dashboard', [EmployeeDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('employee.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
