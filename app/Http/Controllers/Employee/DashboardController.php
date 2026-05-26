<?php

namespace App\Http\Controllers\Employee;

use App\Enums\LeaveStatus;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $leaveRequests = $user->leaveRequests;
        $pendingCount = $leaveRequests->where('status', LeaveStatus::Pending)->count();

        return view('employee.dashboard', [
            'user' => $user,
            'leaveRequests' => $leaveRequests,
            'pendingCount' => $pendingCount,
            'usedDaysPercentage' => $user->usedDaysPercentage(),
        ]);
    }
}
