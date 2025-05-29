<?php

namespace App\Traits;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCategory {
    public function category(): Category {
        return $this->categoryRelation;
    }

    public function categoryRelation(): BelongsTo {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function isPartOfCategory(Category $category): bool {
        return $this->category()->matches($category);
    }

    public function partOfCategory(Category $category) {
        return $this->categoryRelation()->associate($category);
    }
}
