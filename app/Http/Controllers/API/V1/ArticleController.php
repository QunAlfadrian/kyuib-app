<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Article;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\V1\ImageService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\V1\ArticleResource;
use App\Http\Resources\V1\ArticleCollection;

class ArticleController extends Controller {
    public function __construct(private ImageService $imageService) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return new ArticleCollection(Article::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'bail|required|string|max:127|unique:articles,title',
            'hero_image' => 'bail|required|image|max:5048',
            'body' => 'bail|required|string|min:5',
            'project_id' => 'bail|required|integer',
        ]);

        $slug = Str::slug($request->input('title'));
        $image = $request->file('hero_image');
        $filename = $slug . "-hero-" . time() . ".webp";
        $path = 'images/articles/';

        $this->imageService->StoreImage(
            $image,
            $filename,
            $path,
            100
        );

        $project = Project::find($request->input('project_id'));
        $article = $project->articles()->create([
            'title' => $request->input('title'),
            'slug' => $slug,
            'hero_image_url' => asset(Storage::url($path.$filename)),
            'body' => $request->input('body'),
            'author_id' => $project->owner()->id()
        ]);
        $article->authorRelation()->associate(Auth::user());

        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article) {
        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article) {
        $request->validate([
            'title' => ['sometimes', 'max:127', Rule::unique('articles', 'title')->ignore($article->id)],
            'hero_image' => 'bail|nullable|image|max:5048',
            'body' => 'bail|required|string|min:5',
        ]);

        $data = $request->only([
            'title',
            'body'
        ]);

        $slug = Str::slug($request->input('title'));
        if ($request->hasFile('hero_image')) {
            // delete old hero image
            if ($article->heroImageUrl()) {
                $oldPath = str_replace(asset('storage') . '/', '', $article->heroImageUrl());
                Storage::disk('public')->delete($oldPath);
            }

            $image = $request->file('hero_image');
            $filename = $slug . "-hero-" . time() . ".webp";
            $path = 'images/articles/';

            $this->imageService->StoreImage(
                $image,
                $filename,
                $path,
                100
            );

            $data['hero_image_url'] = asset(Storage::url($path . $filename));
        }
        $data['slug'] = $slug;

        $article->update($data);

        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article) {
        $article->delete();

        return response()->json(null, 204);
    }
}
