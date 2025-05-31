<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OwnerResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'type' => 'user',
            'id' => $this->id(),
            'name' => $this->name(),
            'links' => [
                'self' => route('users.show', $this->name())
            ],
        ];
    }
}
