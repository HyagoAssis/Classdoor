<?php

namespace App\Http\Controllers\Api\ClassifiableItem;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassifiableItem\StoreRequest;
use App\Http\Resources\ClassifiableItemResource;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request): ClassifiableItemResource
    {
        $user = $request->user();

        $classifiableItem = $user->classifiableItems()->create([
            'name'                   => $request->name,
            'classification_type_id' => $request->classification_type_id,
        ]);

        return ClassifiableItemResource::make($classifiableItem);
    }
}
