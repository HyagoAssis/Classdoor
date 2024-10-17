<?php

namespace App\Http\Controllers\ClassificationType;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassificationType\UpdateRequest;
use App\Http\Resources\ClassificationTypeResource;
use App\Models\ClassificationType;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ClassificationType $classificationType, UpdateRequest $request): ClassificationTypeResource
    {
        $classificationType->name = $request->get('name');
        $classificationType->save();

        return ClassificationTypeResource::make($classificationType);

    }
}
