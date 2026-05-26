<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'requests' => LeaveRequest::with('user')->pending()->get(),
            'pendingCount' => LeaveRequest::pending()->count(),
            'approvedCount' => LeaveRequest::approved()->count(),
            'rejectedCount' => LeaveRequest::rejected()->count(),
            'users' => User::all(),
        ]);
    }
}
