<?php

namespace App\Enums;

enum LeaveType: string
{
    case Annual = 'annual';
    case Sick = 'sick';
    case Parental = 'parental';
    case Maternity = 'maternity';
    

    
    public function label(): string
    {
        return match($this) {
            LeaveType::Annual => 'Κανονική Άδεια',
            LeaveType::Sick => 'Αναρρωτική Άδεια',
            LeaveType::Parental => 'Γονικη Άδεια',
            LeaveType::Maternity=> 'Μητρότητας',
        };
    }

    public function badgeClass(): string
{
    return match($this) {
        LeaveType::Annual   => 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400',
        LeaveType::Sick     => 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400',
        LeaveType::Parental => 'bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400',
        LeaveType::Maternity => 'bg-pink-100 dark:bg-pink-900/30 text-pink-600 dark:text-pink-400',
    };
}

}

