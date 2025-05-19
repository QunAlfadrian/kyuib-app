<?php
namespace App\Traits;

use App\Models\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasProject {
    public function project(): Project {
        return $this->projectRelation;
    }

    public function projectRelation(): BelongsTo {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function isPartOfProject(Project $project): bool {
        return $this->project()->matches($project);
    }

    public function partOfProject(Project $project) {
        return $this->projectRelation()->associate($project);
    }
}
