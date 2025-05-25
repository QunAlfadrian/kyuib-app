<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'type' => 'article',
            'id' => $this->id(),
            'attributes' => [
                'title' => $this->title(),
                'slug' => $this->slug(),
                'body' => $this->body(),
                'created_at' => $this->created_at
            ],
            'relationships' => [
                'project' => ProjectResource::make($this->project())
            ],
            'links' => [
                'self' => route('articles.show', $this->id()),
                'related' => route('articles.show', $this->slug())
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
