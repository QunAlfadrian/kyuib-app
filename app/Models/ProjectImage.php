<?php

namespace App\Models;

use App\Traits\HasProject;
use App\Traits\ModelHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectImage extends Model {
    use HasFactory;
    use ModelHelpers;
    use HasProject;

    const TABLE = 'project_images';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'slug',
        'alternative_text',
        'filename',
        'url',
        'project_id'
    ];

    protected static function booted() {
        static::deleting(function ($image) {
            Storage::disk('public')->delete("images/projects/{$image->filename()}");
        });
    }

    public function id(): string {
        return (string) $this->id;
    }

    public function name(): string {
        return $this->name;
    }

    public function slug(): string {
        return $this->slug;
    }

    public function alternativeText(): string {
        return $this->alternative_text;
    }

    public function filename(): string {
        return $this->filename;
    }

    public function url(): string {
        return $this->url;
    }
}
