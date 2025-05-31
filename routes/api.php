<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\OwnerController;
use App\Http\Controllers\API\V1\ArticleController;
use App\Http\Controllers\API\V1\ProjectController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\ProjectRelationshipController;
use App\Http\Controllers\API\V1\CategoryRelationshipController;
use App\Http\Controllers\API\V1\ProjectImageController;

Route::group([], function () {
    Route::get('/', function () {
        redirect('test');
    });

    Route::get('/test', function () {
        redirect('test');
    });
});

Route::group([
    'prefix' => 'v1'
], function () {
    Route::get('/test', function () {
        return response()->json([
            'message' => 'Kyuib-app is up!',
            'version' => 'v1'
        ]);
    })->name('test');
});


// https://kyuib.my.id/api/v1
Route::group([
    'prefix' => 'v1',
    'middleware' => 'auth:sanctum'
], function () {
    // User
    Route::get('/user', UserController::class);

    // Categories
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Projects
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    // ProjectImages
    Route::post('/projects/{project}/images', [ProjectImageController::class, 'store'])->name('projects.images.store');
    Route::delete('/projects/{project}/images/{projectImage}', [ProjectImageController::class, 'destroy'])->name('projects.images.destroy');

    // Articles
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    // Owners
    Route::get('/users/{user:name}', [OwnerController::class, 'show'])->name('users.show');
});

Route::group([
    'prefix' => 'v1'
], function () {
    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/relationships/projects', [CategoryRelationshipController::class, 'relationshipProjects'])->name('categories.relationships.projects');
    Route::get('/categories/{category}/projects', [CategoryRelationshipController::class, 'relatedProjects'])->name('categories.projects');

    // Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/relationships/articles', [ProjectRelationshipController::class, 'relationshipArticles'])->name('projects.relationships.articles');
    Route::get('/projects/{project}/articles', [ProjectRelationshipController::class, 'relatedArticles'])->name('projects.articles');
    Route::get('/projects/{project}/images', [ProjectRelationshipController::class, 'relatedImages'])->name('projects.images.index');
    Route::get('/projects/{project}/images/{projectImage}', [ProjectImageController::class, 'show'])->name('projects.images.show');

    // Articles
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
});
