<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\LeaveType;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    /** @use HasFactory<\Database\Factories\LeaveRequestFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'description',
        'start_date',
        'end_date',
        'status'
    ];

      public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function durationInDays() : int {
       return Carbon::parse($this->start_date)->diffInDays($this->end_date);

    }
    protected function casts(): array
{
    return [
        'type' => LeaveType::class,
    ];
}

}

