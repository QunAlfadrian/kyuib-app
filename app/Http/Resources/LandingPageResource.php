<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class LandingPageResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'type' => 'landing-page-settings',
            'id' => $this->id(),
            'attributes' => [
                'display_name' => $this->displayName(),
                'job_title' => $this->jobTitle(),
                'hero_image_url' => $this->heroImageUrl(),
                'about_me_title' => $this->aboutMeTitle(),
                'about_me_body' => $this->aboutMeBody(),
                'contact_url' => $this->contactUrl()
            ],
            'relationships' => [
                'related_projects' => [

                ],
                'related_articles' => [

                ]
            ],
            'links' => [
                'self' => route('landingPages.show', $this->id()),
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
