<?php

namespace App\Enums\Order;

enum StatusEnum: int
{
    case IN_PROGRESS = 1;
    case SHIPPED = 2;
    case COMPLETED = 3;
}
