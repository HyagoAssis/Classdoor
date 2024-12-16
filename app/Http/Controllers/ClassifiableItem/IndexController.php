<?php

namespace App\Http\Controllers\ClassifiableItem;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassifiableItemResource;
use App\Models\ClassifiableItem;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $type = $request->input('type');
        $name = $request->input('name');

        $data = ClassifiableItem::where(ClassifiableItem::column('classification_type_id'), $type)->paginate();

        return ClassifiableItemResource::collection($data);
    }
}