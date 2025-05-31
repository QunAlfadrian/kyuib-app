<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectRelation extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'type' => 'project',
            'id' => $this->id(),
            'attributes' => [
                'title' => $this->title(),
                'hero_image_url' => $this->heroImageUrl(),
                'start_date' => $this->startDate(),
            ],
            'links' => [
                'self' => route('projects.show', $this->id()),
                'related' => route('projects.show', $this->slug())
            ]
        ];
    }

    public function with($request) {
        return [
            'status' => 'success',
        ];
    }

    public function withResponse(Request $request, JsonResponse $response) {
        $response->header('Accept', 'application/json');
    }
}
