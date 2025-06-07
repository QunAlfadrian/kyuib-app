<?php

namespace App\Models;

use App\Traits\HasFeaturedArticles;
use App\Traits\HasFeaturedProjects;
use App\Traits\ModelHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPageSettings extends Model {
    use HasFactory;
    use ModelHelpers;
    use HasFeaturedProjects;
    use HasFeaturedArticles;

    const TABLE = 'landing_page_settings';

    protected $table = self::TABLE;

    protected $fillable = [
        'display_name',
        'job_title',
        'hero_image_url',
        'about_me_title',
        'about_me_image_url',
        'about_me_body',
        'contact_url'
    ];

    public function id(): string {
        return (string) $this->id;
    }

    public function displayName(): string {
        return $this->display_name;
    }

    public function jobTitle(): string {
        return $this->job_title;
    }

    public function heroImageUrl(): string {
        return $this->hero_image_url;
    }

    public function aboutMeTitle(): string {
        return $this->about_me_title;
    }

    public function aboutMeImageUrl(): string {
        return $this->about_me_image_url;
    }

    public function aboutMeBody(): string {
        return $this->about_me_body;
    }

    public function contactUrl(): string {
        return $this->contact_url;
    }
}
