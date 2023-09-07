<?php

namespace App\Enums;

enum ProjectLinkTypes: string
{
    case IOS = 'ios';
    case ANDROID = 'android';
    case WEB = 'web';

    public static function list(): array
    {
        return array_map(
            function ($type) {
                return [
                    'key'  => $type->name,
                    'value' => $type->value,
                ];
            },
            self::cases()
        );
    }
}
