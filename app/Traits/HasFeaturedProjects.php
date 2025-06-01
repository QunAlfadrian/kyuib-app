<?php

namespace App\Traits;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasFeaturedProjects {
    public function featuredProjects(): Collection {
        return $this->projectRelation;
    }

    public function projectRelation(): BelongsToMany {
        return $this->belongsToMany(Project::class, 'featured_projects')
            ->withPivot('position')
            ->orderBy('pivot_position');
    }
}
