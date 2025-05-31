<?php

namespace App\Models;

use App\Traits\HasCategory;
use App\Traits\HasOwner;
use App\Traits\ModelHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model {
    use HasFactory;
    use ModelHelpers;
    use HasOwner;
    use HasCategory;

    const TABLE = 'projects';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'slug',
        'hero_image_url',
        'description',
        'start_date',
        'finish_date',
        'owner_id',
        'category_id'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'finish_date' => 'datetime'
    ];

    public function id(): string {
        return (string) $this->id;
    }

    public function title(): string {
        return $this->title;
    }

    public function slug(): string {
        return $this->slug;
    }

    public function heroImageUrl(): string {
        return $this->hero_image_url;
    }

    public function description(): string {
        return $this->description;
    }

    public function startDate(): string {
        return $this->start_date ? $this->start_date->format('d-m-Y'): '';
    }

    public function finishDate(): string {
        return $this->finish_date ? $this->finish_date->format('d-m-Y'): '';
    }

    public function articles(): HasMany {
        return $this->hasMany(Article::class);
    }

    public function images(): HasMany {
        return $this->hasMany(ProjectImage::class);
    }
}
