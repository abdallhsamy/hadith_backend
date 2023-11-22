<?php

namespace App\Http\Resources\Dashboard\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->transform(fn($item) => [
            '_id' => $item->_id,
            'id' => $item->id,
            'title' => $item->translation()->title,
            'hadeeths_count' => $item->hadeeths_count,
        ])->toArray();
    }
}
