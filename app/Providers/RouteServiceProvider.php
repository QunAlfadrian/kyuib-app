<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {
    public function boot(): void {
        $this->routes(function () {
            Route::middleware('web')
            ->group(base_path('routes/web.php'));

            Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
        });

        // Custom model binding
        Route::bind('article', function ($value) {
            return Article::where('id', $value)
                ->orWhere('slug', $value)
                ->firstOrFail();
        });

        Route::bind('project', function ($value) {
            return Project::where('id', $value)
                ->orWhere('slug', $value)
                ->firstOrFail();
        });

        Route::bind('category', function ($value) {
            return Category::where('id', $value)
                ->orWhere('slug', $value)
                ->firstOrFail();
        });
    }
}
