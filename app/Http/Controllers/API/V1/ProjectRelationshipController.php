<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleIdentifier;
use App\Http\Resources\V1\ArticleRelation;
use App\Http\Resources\V1\ArticleResource;
use App\Http\Resources\V1\ProjectImageRelation;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectRelationshipController extends Controller {
    /**
     * Display a listing of related articles
     */
    public function relatedArticles(Project $project) {
        return (ArticleRelation::collection($project->articles()->paginate(10)))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Display a listing of related articles identifier
     */
    public function relationshipArticles(Project $project) {
        return ArticleIdentifier::collection($project->articles);
    }

    /**
     * Display a listing of related project-images
     */
    public function relatedImages(Project $project) {
        return (ProjectImageRelation::collection($project->images))
            ->response()
            ->setStatusCode(200);
    }
}
