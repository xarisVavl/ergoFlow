<?php

namespace Database\Factories;

use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LeaveRequest>
 */
class LeaveRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    $startDate = fake()->dateTimeBetween('now', '+7 months');
    $endDate = (clone $startDate)->modify('+1 week');

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'status' => 'pending',
            'description'=> fake()->sentence(),
            'start_date'=> $startDate,
            'end_date' => $endDate,
        ];
    }
}