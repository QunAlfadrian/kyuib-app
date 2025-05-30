<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'type' => 'category',
            'id' => $this->id(),
            'attributes' => [
                'name' => $this->name(),
                'slug' => $this->slug()
            ],
            'relationships' => [
                'projects' => ProjectRelation::collection($this->projects)
            ],
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
