<?php

namespace App\Models;

use App\Traits\HasCategory;
use App\Traits\ModelHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model {
    use HasFactory;
    use ModelHelpers;

    const TABLE = 'categories';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function id(): string {
        return (string) $this->id;
    }

    public function name(): string {
        return $this->name;
    }

    public function slug(): string {
        return $this->slug;
    }

    public function projects(): HasMany {
        return $this->hasMany(Project::class);
    }
}
