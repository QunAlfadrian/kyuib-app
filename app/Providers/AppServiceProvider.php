<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectImage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
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
            return Category::where('slug', $value)
                ->orWhere('id', is_numeric($value) ? $value : null)
                ->firstOrFail();
        });

        Route::bind('projectImage', function ($value) {
            return ProjectImage::where('slug', $value)
                ->orWhere('id', is_numeric($value) ? $value : null)
                ->firstOrFail();
        });
    }
}
