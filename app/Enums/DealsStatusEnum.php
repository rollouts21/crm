<?php
namespace App\Enums;

enum DealsStatusEnum: string {
    case New         = 'new';
    case In_Progress = 'in progress';
    case Won         = 'won';
    case Lost        = 'lost';

    public function label(): string
    {
        return match ($this) {
            self::New         => 'New',
            self::In_Progress => 'In progress',
            self::Won         => 'Won',
            self::Lost        => 'Lost',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::New         => 'text-bg-info',
            self::In_Progress => 'text-bg-primary',
            self::Won         => 'text-bg-success',
            self::Lost        => 'text-bg-danger',
        };
    }
}
