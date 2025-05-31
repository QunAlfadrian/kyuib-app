<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectImageRelation extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'type' => 'project-images',
            'id' => $this->id(),
            'attributes' => [
                'name' => $this->name(),
                'url' => $this->url()
            ],
            'links' => [
                'self' => route('projects.images.show', [
                    'project' => $this->project()->slug(),
                    'projectImage' => $this->id()
                ]),
                'related' => route('projects.images.show', [
                    'project' => $this->project()->slug(),
                    'projectImage' => $this->slug()
                ]),
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
