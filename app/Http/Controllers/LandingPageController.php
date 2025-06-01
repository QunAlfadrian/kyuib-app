<?php

namespace App\Http\Controllers;

use App\Http\Resources\LandingPageResource;
use App\Http\Resources\V1\ArticleRelation;
use App\Http\Resources\V1\ProjectRelation;
use Illuminate\Http\Request;
use App\Services\V1\ImageService;
use App\Models\LandingPageSettings;
use Exception;
use Illuminate\Support\Facades\Storage;

class LandingPageController extends Controller {
    public function __construct(private ImageService $imageService) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'display_name' => 'bail|required|string|max:255',
            'job_title' => 'bail|required|string|max:255',
            'hero_image' => 'bail|required|image|max:5048',
            'about_me_title' => 'bail|required|string|max:255',
            'about_me_body' => 'bail|required|string|5048',
            'contact_url' => 'bail|required|string|2048'
        ]);

        $image = $request->file('hero_image');
        $filename = 'hero-image-' . time() . '.webp';
        $path = 'images/home/';

        $this->imageService->StoreImage(
            $image,
            $filename,
            $path,
            100
        );

        $landingPage = LandingPageSettings::create([
            'display_name' => $request->input('display_name'),
            'job_title' => $request->input('job_title'),
            'hero_image_url' => asset(Storage::url($path . $filename)),
            'about_me_title' => $request->input('about_me_title'),
            'about_me_body' => $request->input('about_me_body'),
            'contact_url' => $request->input('contact_url')
        ]);

        return (new LandingPageResource($landingPage))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(LandingPageSettings $landingPageSettings) {
        return (new LandingPageResource($landingPageSettings))
            ->response()
            ->setStaleIfError(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LandingPageSettings $landingPageSettings) {
        $request->validate([
            'display_name' => 'bail|required|string|max:255',
            'job_title' => 'bail|required|string|max:255',
            'hero_image' => 'bail|nullable|image|max:5048',
            'about_me_title' => 'bail|required|string|max:255',
            'about_me_body' => 'bail|required|string|max:5048',
            'contact_url' => 'bail|required|string|max:2048'
        ]);

        $data = $request->only([
            'display_name',
            'job_title',
            'about_me_title',
            'about_me_body',
            'contact_url',
        ]);

        if ($request->hasFile('hero_image')) {
            // delete old hero image
            if ($landingPageSettings->heroImageUrl()) {
                $oldPath = str_replace(asset('storage') . '/', '', $landingPageSettings->heroImageUrl());
                Storage::disk('public')->delete($oldPath);
            }

            $image = $request->file('hero_image');
            $filename = 'hero-image-' . time() . '.webp';
            $path = 'images/home/';

            $this->imageService->StoreImage(
                $image,
                $filename,
                $path,
                100
            );

            $data['hero_image_url'] = asset(Storage::url($path . $filename));
        }

        $landingPageSettings->update($data);

        return (new LandingPageResource($landingPageSettings))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Display the resource of featured articles
     */
    public function indexFeaturedProjects(LandingPageSettings $landingPageSettings) {
        return (ProjectRelation::collection($landingPageSettings->featuredProjects()))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Update the featured articles displayed on landing page
     */
    public function UpdateFeaturedProjects(Request $request, LandingPageSettings $landingPageSettings) {
        try {
            $validated = $request->validate([
                'projects' => 'required|array|min:1|max:5',
                'projects.*.id' => 'required|exists:articles,id',
                'projects.*.position' => 'required|integer|min:1'
            ]);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $syncData = [];

        foreach ($validated['projects'] as $project) {
            $syncData[$project['id']] = [
                'position' => $project['position'] ?? null
            ];
        }

        $landingPageSettings->projectRelation()->sync($syncData);

        return (ProjectRelation::collection($landingPageSettings->featuredProjects()))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Display the resource of featured articles
     */
    public function indexFeaturedArticles(LandingPageSettings $landingPageSettings) {
        return (ArticleRelation::collection($landingPageSettings->featuredArticles()))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Update the featured articles displayed on landing page
     */
    public function UpdateFeaturedArticles(Request $request, LandingPageSettings $landingPageSettings) {
        try {
            $validated = $request->validate([
                'articles' => 'required|array|min:1|max:5',
                'articles.*.id' => 'required|exists:articles,id',
                'articles.*.position' => 'required|integer|min:1'
            ]);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $syncData = [];

        foreach ($validated['articles'] as $article) {
            $syncData[$article['id']] = [
                'position' => $article['position'] ?? null
            ];
        }

        $landingPageSettings->articleRelation()->sync($syncData);

        return (ArticleRelation::collection($landingPageSettings->featuredArticles()))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LandingPageSettings $landingPageSettings) {
        //
    }
}
