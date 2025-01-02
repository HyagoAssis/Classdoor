<?php

namespace App\Http\Controllers\Api\ClassificationType;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassificationTypeResource;
use App\Models\ClassificationType;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $classificationTypes = ClassificationType::query()->paginate();

        return ClassificationTypeResource::collection($classificationTypes);
    }
}
