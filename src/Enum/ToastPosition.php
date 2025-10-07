<?php

namespace Asmitta\ToastBundle\Enum;


enum ToastPosition: string
{
    case TOP_LEFT = 'top-left';
    case TOP_RIGHT = 'top-right';
    case TOP_CENTER = 'top-center';
    case BOTTOM_LEFT = 'bottom-left';
    case BOTTOM_RIGHT = 'bottom-right';
    case BOTTOM_CENTER = 'bottom-center';
    case CENTER = 'center';

    /**
     * @return array<string>
     */
    public static function values(): array
    {
        return array_map(fn(ToastPosition $p) => $p->value, self::cases());
    }
}
