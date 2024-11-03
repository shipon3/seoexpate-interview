<?php

namespace App\Enum;

enum ProjectStatus :string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case HOLD = 'hold';

    public function color(): string {
        return match($this) {
            self::ACTIVE => 'green',
            self::INACTIVE => 'red',
            self::HOLD => 'yellow',
        };
    }
    public function getLabel(): string
    {
        return match ($this) {
            self::ACTIVE   => 'Active',
            self::INACTIVE => 'Inactive',
            self::HOLD => 'Hold',
        };
    }
    public static function options(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::HOLD,
        ];
    }
}
