<?php

namespace App\Enums;

enum PurchaseStatus: int
{
    case PENDING = 0;
    case PROCESS = 1;
    case TRANSIT = 2;
    case COMPLETE = 3;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('Pending'),
            self::PROCESS => __('Process'),
            self::TRANSIT => __('Transit'),
            self::COMPLETE => __('Complete'),
        };
    }
}
