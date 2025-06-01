<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Project;
use Illuminate\Support\Str;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\V1\ProjectImageResource;
use App\Services\V1\ImageService;

class ProjectImageController extends Controller {
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
    public function store(Request $request, Project $project) {
        $request->validate([
            'image' => 'bail|required|image|max:5048',
            'name' => 'bail|required|string|max:255',
            'alternative_text' => 'bail|required|string|max:255'
        ]);

        $slug = Str::slug($request->input('name'));
        $image = $request->file('image');
        $filename = $slug . "-" . time() . ".webp";
        $path = 'images/projects/' . $project->slug() . '/' . 'gallery/';

        $this->imageService->StoreImage(
            $image,
            $filename,
            $path
        );

        $projectImage = $project->images()->create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'alternative_text' => $request->input('alternative_text'),
            'filename' => $filename,
            'url' => asset(Storage::url($path . $filename))
        ]);

        return (new ProjectImageResource($projectImage))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, ProjectImage $projectImage) {
        return (new ProjectImageResource($projectImage))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, ProjectImage $projectImage) {
        $path = str_replace(asset('storage') . '/', '', $projectImage->url());
        Storage::disk('public')->delete($path);

        $projectImage->delete();

        return response()->json(null, 204);
    }
}
