<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProjectResource;
use App\Http\Resources\V1\ProjectCollection;

class ProjectController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return new ProjectCollection(Project::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:65|unique:projects,title',
            'description' => 'required|string|min:5',
        ]);

        $project = Project::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'description' => $request->input('description'),
            'owner_id' => auth()->id() ?? 1
        ]);

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
            'title' => ['sometimes', 'max:65', Rule::unique('projects', 'title')->ignore($project->id)],
            'description' => 'required|string|min:5',
        ]);

        $project->update([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'description' => $request->input('description')
        ]);

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
