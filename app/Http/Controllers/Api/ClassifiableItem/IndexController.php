<?php

namespace App\Http\Controllers\Api\ClassifiableItem;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassifiableItemResource;
use App\Models\{ClassifiableItem, Classification};
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

        $data = ClassifiableItem::with(['classifications'])
            ->join(Classification::table(), Classification::column('classifiable_item_id'), ClassifiableItem::column('id'))
            ->when($type, function ($query, $type) {
                $query->where(ClassifiableItem::column('classification_type_id'), $type);
            })
            ->select([
                ClassifiableItem::column('*'),
                \DB::raw('ROUND(AVG(' . Classification::column('value') . '), 0) as avg_classification'),
                \DB::raw('COUNT(' . Classification::column('id') . ') as total_classification'),
            ])
            ->groupBy(ClassifiableItem::column('id'))
            ->paginate();

        return ClassifiableItemResource::collection($data);
    }
}
