<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Project;
use Illuminate\Support\Str;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Resources\V1\ProjectImageResource;

class ProjectImageController extends Controller {
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

        $manager = new ImageManager(new Driver());
        $webp = $manager->read($image)->toWebp(60);
        Storage::disk('public')->put('images/' . $filename, $webp);

        $projectImage = $project->images()->create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'alternative_text' => $request->input('alternative_text'),
            'filename' => $filename,
            'url' => asset(Storage::url('images/' . $filename))
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
        $projectImage->delete();

        return response()->json(null, 204);
    }
}
