<?php

namespace App\Http\Controllers\Api\Classification;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassificationResource;
use App\Models\{ClassifiableItem, Classification};
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $perPage        = $request->query('perPage', 10);
        $type           = $request->input('type');
        $classifiableId = $request->input('classifiable_id');
        $name           = $request->input('name');

        $data = Classification::with(['classifiableItem.classificationType'])->when($type, function ($query, $type) {
            $query
                ->join(ClassifiableItem::table(), ClassifiableItem::column('id'), Classification::column('classifiable_item_id'))
                ->where(ClassifiableItem::column('classification_type_id'), $type);
        })->when($classifiableId, function ($query, $classifiableId) {
            $query->where(Classification::column('classifiable_item_id'), $classifiableId);
        })
//            ->when($name, function ($query, $name) {
//
//        })
            ->orderBy(Classification::column('created_at'), 'desc')
            ->paginate($perPage);

        return ClassificationResource::collection($data);
    }
}
