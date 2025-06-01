<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\V1\ImageService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\V1\ProjectResource;
use App\Http\Resources\V1\ProjectCollection;

class ProjectController extends Controller {
    public function __construct(private ImageService $imageService) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return new ProjectCollection(Project::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'bail|required|string|max:65|unique:projects,title',
            'hero_image' => 'bail|required|image|max:5048',
            'description' => 'bail|required|string|min:5',
            'redirect_url' => 'bail|nullable|string',
            'start_date' => 'bail|required|date',
            'finish_date' => 'sometimes|nullable|date',
            'category_id' => 'bail|required|integer'
        ]);

        $slug = Str::slug($request->input('title'));
        $image = $request->file('hero_image');
        $filename = $slug . "-hero-" . time() . ".webp";
        $path = 'images/projects/';

        $this->imageService->StoreImage(
            $image,
            $filename,
            $path,
            100
        );

        $category = Category::findOrFail($request->input('category_id'));

        $project = $category->projects()->create([
            'title' => $request->input('title'),
            'slug' => $slug,
            'hero_image_url' => asset(Storage::url($path . $filename)),
            'description' => $request->input('description'),
            'redirect_url' => $request->input('redirect_url'),
            'start_date' => $request->input('start_date'),
            'finish_date' => $request->input('finish_date'),
            'owner_id' => auth()->id()
        ]);
        $project->ownedBy(Auth::user());

        return (new ProjectResource($project))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project) {
        return (new ProjectResource($project))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project) {
        $request->validate([
            'title' => ['required', 'max:65', Rule::unique('projects', 'title')->ignore($project->id)],
            'hero_image' => 'bail|nullable|image|max:5048',
            'description' => 'bail|required|string|min:5',
            'redirect_url' => 'bail|nullable|string',
            'start_date' => 'bail|required|date',
            'finish_date' => 'sometimes|nullable|date'
        ]);
        $slug = Str::slug($request->input('title'));

        $data = $request->only([
            'title',
            'description',
            'redirect_url',
            'start_date',
            'finish_date',
        ]);

        if ($request->hasFile('hero_image')) {
            // delete old hero image
            if ($project->heroImageUrl()) {
                $oldPath = str_replace(asset('storage') . '/', '', $project->heroImageUrl());
                Storage::disk('public')->delete($oldPath);
            }

            $image = $request->file('hero_image');
            $filename = $slug() . "-hero-" . time() . ".webp";
            $path = 'images/projects/';

            $this->imageService->StoreImage(
                $image,
                $filename,
                $path,
                100
            );

            $data['hero_image_url'] = asset(Storage::url($path . $filename));
        }
        $data['slug'] = $slug;

        $project->update($data);

        return (new ProjectResource($project))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project) {
        $project->delete();

        return response()->json(null, 204);
    }
}
