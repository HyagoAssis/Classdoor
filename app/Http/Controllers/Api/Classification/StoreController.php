<?php

namespace App\Http\Controllers\Api\Classification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Classification\StoreRequest;
use App\Http\Resources\ClassificationResource;
use App\Models\Classification;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request): ClassificationResource
    {
        $user = $request->user();
        $file = $request->file('file');

        /** @var Classification $classification */
        $classification = $user->classifications()->create([
            'value'                => $request->value,
            'comment'              => $request->comment,
            'classifiable_item_id' => $request->classifiable_item_id,
        ]);

        if ($file) {
            $fileName = 'classification_files/' . $classification->getId() . '_' . $file->getClientOriginalPath();

            \Storage::disk('public')->put($fileName, file_get_contents($file));
            $classification->file = $file->getClientOriginalPath();
            $classification->save();
        }

        return ClassificationResource::make($classification);
    }
}
