<?php
namespace App\Enums;

enum TaskStatusEnum: string {
    case Open     = 'open';
    case Done     = 'done';
    case Canceled = 'canceled';

    public function label(): string
    {
        return match ($this) {
            self::Open     => 'Open',
            self::Done     => 'Done',
            self::Canceled => 'Canceled',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Open     => 'text-bg-success',
            self::Done     => 'text-bg-primary',
            self::Canceled => 'text-bg-danger',
        };
    }
}
