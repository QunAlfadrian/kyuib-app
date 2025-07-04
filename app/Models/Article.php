<?php

namespace App\Models;

use App\Traits\HasAuthor;
use App\Traits\HasProject;
use App\Traits\ModelHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    use HasFactory;
    use ModelHelpers;
    use HasProject;
    use HasAuthor;

    const TABLE = 'articles';
    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'slug',
        'hero_image_url',
        'body',
        'project_id',
        'author_id'
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

    public function body(): string {
        return $this->body;
    }
}
