<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource {
    public static $wrap = 'projects';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        // return parent::toArray($request);
        return [
            'type' => 'project',
            'id' => $this->id(),
            'attributes' => [
                'title' => $this->title(),
                'slug' => $this->slug(),
                'description' => $this->description(),
                'start_date' => $this->startDate(),
                'finish_date' => $this->finishDate(),
                'created_at' => $this->created_at
            ],
            'relationships' => [
                'owner' => OwnerResource::make($this->owner())
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
