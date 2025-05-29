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
        $perPage              = $request->query('perPage', 10);
        $type                 = $request->input('type');
        $classifiableId       = $request->input('classifiable_id');
        $name                 = $request->input('search');
        $filterUser           = $request->input('filterUser', false);
        $user                 = null;
        $value                = $request->input('value', null);
        $classificationSearch = $request->input('classification_search', false);

        if ($filterUser) {
            $user = auth()->user();
        }

        $data = Classification::with(['classifiableItem.classificationType', 'complaints'])
            ->join(ClassifiableItem::table(), ClassifiableItem::column('id'), Classification::column('classifiable_item_id'))
            ->when(!$filterUser, function ($query) {
                $query->where(Classification::column('valid'), true);
            })
            ->when($type, function ($query, $type) {
                $query
                    ->where(ClassifiableItem::column('classification_type_id'), $type);
            })
            ->when($classifiableId, function ($query, $classifiableId) {
                $query->where(Classification::column('classifiable_item_id'), $classifiableId);
            })
            ->when($name, function ($query, $name) {
                $query->where(ClassifiableItem::column('name'), 'like', '%' . $name . '%');
            })
            ->when($filterUser, function ($query) use ($user) {
                $query->where(Classification::column('user_id'), $user->id);
            })
            ->when($value, function ($query) use ($value) {
                $query->where(Classification::column('value'), $value);
            })
            ->when($classificationSearch, function ($query) use ($classificationSearch) {
                $query->where(Classification::column('comment'), 'LIKE', '%' . $classificationSearch . '%');
            })
            ->orderBy(Classification::column('created_at'), 'desc')
            ->select([Classification::column('*')])
            ->paginate($perPage);

        return ClassificationResource::collection($data);
    }
}
