<?php

namespace App\Enum;

enum CommentableTypeEnum: string
{
    case Books = '1';
    case Publishers = '2';

    public static function fromValue(string $value): ?self
    {
        return match ($value) {
            '1' => self::Books,
            '2' => self::Publishers,
            default => null,
        };
    }
}