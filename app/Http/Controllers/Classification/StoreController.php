<?php

namespace App\Http\Controllers\Classification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Classification\StoreRequest;
use App\Http\Resources\ClassificationResource;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request): ClassificationResource
    {
        $user = $request->user();

        $classification = $user->classifications()->create([
            'value'                => $request->value,
            'comment'              => $request->comment,
            'classifiable_item_id' => $request->classifiable_item_id,
        ]);

        return ClassificationResource::make($classification);
    }
}
