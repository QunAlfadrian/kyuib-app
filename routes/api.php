<?php

use App\Http\Controllers\API\V1\ArticleController;
use App\Http\Controllers\API\V1\OwnerController;
use App\Http\Controllers\API\V1\ProjectController;
use App\Http\Controllers\API\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// https://kyuib.my.id/api/v1
Route::group([
    'prefix' => 'v1',
    'middleware' => 'auth:sanctum'
], function () {
    // Projects
    Route::apiResource('/projects', ProjectController::class);

    // Articles
    Route::apiResource('/articles', ArticleController::class);

    // Owners
    Route::get('/owners/{user}', [OwnerController::class, 'show'])->name('owners');

    // User
    Route::get('/user', UserController::class);
});
