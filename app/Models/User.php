<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Role;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'annual_leave_days',

    ];

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === Role::Admin;
    }

    public function isEmployee(): bool
    {
        return $this->role !== Role::Admin;
    }

    public function remainingDays(): int
    {
        $usedDays = $this->leaveRequests()->approved()->get()
            ->sum(fn ($r) => $r->durationInDays());

        return $this->annual_leave_days - $usedDays;

    }

    public function usedDays(): int
    {
        $usedDays = $this->leaveRequests()->approved()->get()->sum(fn ($r) => $r->durationInDays());

        return $usedDays;
    }

    public function usedDaysPercentage(): int
    {
        return $this->annual_leave_days > 0 ? round($this->usedDays() / $this->annual_leave_days * 100) : 0;

    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => Role::class,
        ];
    }
}
