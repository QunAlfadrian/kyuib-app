<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryRelation extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'type' => 'categories',
            'id' => $this->id(),
            'name' => $this->name(),
            'links' => [
                'self' => route('categories.show', $this->id()),
                'related' => route('categories.show', $this->slug())
            ]
        ];
    }

    public function with($request) {
        return [
            'status' => 'success'
        ];
    }

    public function withResponse(Request $request, JsonResponse $response) {
        $response->header('Accept', 'application/json');
    }
}
