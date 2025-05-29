<?php

namespace App\Enums\Order;

enum StatusEnum: int
{
    case IN_PROGRESS = 1;
    case SHIPPED = 2;
    case COMPLETED = 3;

    public function description(): string
    {
        return match ($this->value) {
            self::IN_PROGRESS->value => __('Собирается'),
            self::SHIPPED->value => __('Отправлен'),
            self::COMPLETED->value => __('Выполнен')
        };
    }

    public static function values(): array
    {
        return array_map(
            static function ($case) {
                return [
                    'value' => $case->value,
                    'description' => $case->description()
                ];
            },
            self::cases()
        );
    }
}
