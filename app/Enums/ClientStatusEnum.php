<?php
namespace App\Enums;

enum ClientStatusEnum: string {
    case New         = 'new';
    case Contacted   = 'contacted';
    case Qualified   = 'qualified';
    case Unqualified = 'unqualified';

    public function label(): string
    {
        return match ($this) {
            self::New         => 'New',
            self::Contacted   => 'Contacted',
            self::Qualified   => 'Qualified',
            self::Unqualified => 'Unqualified',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::New         => 'text-bg-info',
            self::Contacted   => 'text-bg-primary',
            self::Qualified   => 'text-bg-success',
            self::Unqualified => 'text-bg-danger',
        };
    }
}
