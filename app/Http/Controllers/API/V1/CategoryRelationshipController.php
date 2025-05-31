<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProjectCollection;
use App\Http\Resources\V1\ProjectIdentifier;
use App\Http\Resources\V1\ProjectRelation;
use App\Http\Resources\V1\ProjectResource;

class CategoryRelationshipController extends Controller {
    /**
     * Display a listing of related projects.
     */
    public function relatedProjects(Category $category) {
        return ProjectRelation::collection($category->projects()->paginate(10))
            ->response()
            ->setStatusCode(200);
    }

    /**
     *
     */
    public function relationshipProjects(Category $category) {
        return ProjectIdentifier::collection($category->projects);
    }
}
