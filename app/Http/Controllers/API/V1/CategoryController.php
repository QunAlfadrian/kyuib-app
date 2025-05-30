<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoryResource;
use App\Http\Resources\V1\CategoryCollection;

class CategoryController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return new CategoryCollection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'bail|required|string|max:50|unique:categories,name',
        ]);

        $category = Category::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'))
        ]);

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category) {
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category) {
        $request->validate([
            'name' => ['required', 'max:50', Rule::unique('categories', 'name')->ignore($category->id)],
        ]);

        $category->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'))
        ]);

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) {
        $category->delete();

        return response()->json(null, 204);
    }
}
