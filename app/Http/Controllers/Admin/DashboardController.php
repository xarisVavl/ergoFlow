<?php

namespace App\Http\Controllers\Admin;

use App\Models\LeaveRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
        return view('admin.dashboard',[
        'requests' =>LeaveRequest::with('user')->where('status','pending')->get(),
        'pendingCount' => LeaveRequest::where('status', 'pending')->count(),
        'approvedCount' => LeaveRequest::where('status', 'approved')->count(),
        'rejectedCount' => LeaveRequest::where('status', 'rejected')->count(),
        'users' =>User::all(),
    ]);
    }
}
