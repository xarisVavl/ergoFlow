<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function update(LeaveRequest $leaveRequest) {
        
        if (request()->input('action') === 'approve') {
            $leaveRequest->update(['status'=>'approved']);
        }
        else  {
            $leaveRequest->update(['status'=>'rejected']);
        }
        return redirect(route('dashboard'));


    }

}
