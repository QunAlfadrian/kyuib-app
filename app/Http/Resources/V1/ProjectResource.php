<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource {
    // public static $wrap = 'projects';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        // return parent::toArray($request);
        return [
            'type' => 'projects',
            'id' => $this->id(),
            'attributes' => [
                'title' => $this->title(),
                'slug' => $this->slug(),
                'hero_image_url' => $this->heroImageUrl(),
                'description' => $this->description(),
                'start_date' => $this->startDate(),
                'finish_date' => $this->finishDate(),
                'created_at' => $this->created_at
            ],
            'relationships' => [
                'owner' => OwnerResource::make($this->owner()),
                'category' => CategoryRelation::make($this->category()),
                'articles' => [
                    'links' => [
                        'self' => route('projects.relationships.articles', $this->slug()),
                        'related' => route('projects.articles', $this->slug())
                    ]
                ],
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
