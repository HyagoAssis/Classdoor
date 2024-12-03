<?php

namespace App\Http\Controllers\ClassificationType;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassificationType\StoreRequest;
use App\Http\Resources\ClassificationTypeResource;
use App\Models\ClassificationType;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request): ClassificationTypeResource
    {
        $classificationType = ClassificationType::create([
            'name' => $request->name,
        ]);

        return ClassificationTypeResource::make($classificationType);
    }
}
