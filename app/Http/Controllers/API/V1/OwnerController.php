<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;

class OwnerController extends Controller {
    public function show(User $user) {
        return UserResource::make(
            $user
        );
    }
}
