<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Article;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ArticleResource;
use App\Http\Resources\V1\ArticleCollection;

class ArticleController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return new ArticleCollection(Article::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'bail|required|string|max:127|unique:articles,title',
            'body' => 'bail|required|string|min:5',
            'project_id' => 'bail|required|integer',
        ]);

        $project = Project::find($request->input('project_id'));
        $article = Article::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'body' => $request->input('body'),
            'project_id' => $request->input('project_id'),
            'author_id' => $project->owner()->id()
        ]);

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
            'title' => ['sometimes', 'max:127', Rule::unique('projects', 'title')->ignore($article->id)],
            'body' => 'bail|required|string|min:5',
        ]);

        $article->update([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'body' => $request->input('body'),
        ]);

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
