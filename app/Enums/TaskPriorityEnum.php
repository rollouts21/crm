<?php
namespace App\Enums;

enum TaskPriorityEnum: string {
    case Low    = 'low';
    case Normal = 'normal';
    case High   = 'high';

    public function label(): string
    {
        return match ($this) {
            self::Low    => 'Low',
            self::Normal => 'Normal',
            self::High   => 'high',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Low    => 'text-bg-info',
            self::Normal => 'text-bg-primary',
            self::High   => 'text-bg-danger',
        };
    }
}
