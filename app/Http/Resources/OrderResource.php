<?php

namespace App\Http\Resources;

use App\Enums\Order\StatusEnum;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'customer' => $this->resource->customer,
            'customer_comment' => $this->resource->customer_comment,
            'status' => $this->resource->status,
            'items' => OrderItemResource::collection($this->resource->items()->get())->jsonSerialize(),
            'total_price' => Order::getTotalPrice($this->resource),
        ];
    }
}
