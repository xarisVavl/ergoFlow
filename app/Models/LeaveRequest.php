<?php

namespace App\Models;

use App\Enums\LeaveStatus;
use App\Enums\LeaveType;
use Carbon\Carbon;
use Database\Factories\LeaveRequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    /** @use HasFactory<LeaveRequestFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'description',
        'start_date',
        'end_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function durationInDays(): int
    {
        return Carbon::parse($this->start_date)->diffInDays($this->end_date);

    }

    public function scopePending($query)
    {
        return $query->where('status', LeaveStatus::Pending);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', LeaveStatus::Approved);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', LeaveStatus::Rejected);
    }

    protected function casts(): array
    {
        return [
            'type' => LeaveType::class,
            'status' => LeaveStatus::class,
        ];
    }
}
