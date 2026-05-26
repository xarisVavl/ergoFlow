<?php

namespace App\Enums;

enum LeaveStatus: string
{
    case Approved = 'approved';
    case Pending = 'pending';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            LeaveStatus::Approved => 'Εγκρίθηκε',
            LeaveStatus::Rejected => 'Απορρίφθηκε',
            LeaveStatus::Pending => 'Σε αναμονή',

        };
    }

    public function outerSpanCss(): string
    {
        return match ($this) {
            LeaveStatus::Approved => 'inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400',
            LeaveStatus::Rejected => 'inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400',
            LeaveStatus::Pending => 'inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400',

        };
    }

    public function innerSpanCss(): string
    {
        return match ($this) {
            LeaveStatus::Approved => 'w-1.5 h-1.5 rounded-full bg-green-400',
            LeaveStatus::Rejected => 'w-1.5 h-1.5 rounded-full bg-red-400',
            LeaveStatus::Pending => 'w-1.5 h-1.5 rounded-full bg-yellow-400',

        };
    }
}
