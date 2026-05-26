<?php

namespace App\Http\Controllers;

use App\Enums\LeaveStatus;
use App\Models\LeaveRequest;

class LeaveRequestController extends Controller
{
    public function update(LeaveRequest $leaveRequest)
    {

        if (request()->input('action') === 'approve') {
            $leaveRequest->update(['status' => LeaveStatus::Approved]);
        } else {
            $leaveRequest->update(['status' => LeaveStatus::Rejected]);
        }

        return redirect(route('dashboard'));

    }
}
