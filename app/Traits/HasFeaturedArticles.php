<?php

namespace App\Traits;

use App\Models\Article;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasFeaturedArticles {
    public function featuredArticles(): Collection {
        return $this->articleRelation;
    }

    public function articleRelation(): BelongsToMany {
        return $this->belongsToMany(Article::class, 'featured_articles')
            ->withPivot('position')
            ->orderBy('pivot_position');
    }
}
