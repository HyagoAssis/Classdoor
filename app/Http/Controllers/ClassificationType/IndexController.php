<?php

namespace App\Http\Controllers\ClassificationType;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassificationTypeResource;
use App\Models\ClassificationType;
use Illuminate\Http\Request;

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
