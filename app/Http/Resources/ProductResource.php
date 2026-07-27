<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'description' => $this->description,
            // Removed 'category' field - use 'categories' array instead
            'categories' => $this->whenLoaded('categories', function () {
                return $this->categories->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'status' => $category->status,
                    ];
                });
            }),
            'product_image' => $this->product_image ? asset('storage/' . $this->product_image) : null,
            'product_description' => $this->product_description ? array_map(function ($card) {
                return [
                    'title' => $card['title'] ?? null,
                    'introduction' => $card['introduction'] ?? null,
                    'image' => isset($card['image']) ? asset('storage/' . $card['image']) : null,
                ];
            }, $this->product_description) : null,
            'status' => $this->status,
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
