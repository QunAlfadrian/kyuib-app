<?php

use App\Http\Controllers\API\V1\ArticleController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\OwnerController;
use App\Http\Controllers\API\V1\ProjectController;
use App\Http\Controllers\API\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

    // Articles
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    // Owners
    Route::get('/owners/{user}', [OwnerController::class, 'show'])->name('owners');
});

Route::group([
    'prefix' => 'v1'
], function () {
    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    // Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

    // Articles
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
});
