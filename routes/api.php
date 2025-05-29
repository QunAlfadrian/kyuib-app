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
    Route::apiResource('/categories', CategoryController::class);

    // Projects
    Route::apiResource('/projects', ProjectController::class);

    // Articles
    Route::apiResource('/articles', ArticleController::class);

    // Owners
    Route::get('/owners/{user}', [OwnerController::class, 'show'])->name('owners');
});
