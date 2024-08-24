<?php

namespace App\Enum;

enum CommentableTypeEnum: string
{
    case Books = 'book';
    case Publishers = 'publisher';

    public static function fromValue(string $value): ?self
    {
        return match ($value) {
            'book' => self::Books,
            'publisher' => self::Publishers,
            default => null,
        };
    }
}