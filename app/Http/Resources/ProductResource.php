<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'category' => $this->resource->category()->first()->toArray(),
            'description' => $this->resource->description,
            'price' => $this->resource->price,
        ];
    }
}
