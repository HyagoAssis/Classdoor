<?php

namespace App\Http\Controllers\Api\Complaint;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintResource;
use App\Models\{ClassifiableItem, Classification, Complaint};
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $perPage    = $request->query('perPage', 10);
        $type       = $request->input('type');
        $name       = $request->input('search');
        $filterUser = $request->input('filterUser', false);
        $value      = $request->input('value');
        $search     = $request->input('search');
        $status     = $request->input('status');

        $user = auth()->user();

        if (!$filterUser && !$user->isAdmin()) {
            throw new UnauthorizedException();
        }

        $data = Complaint::with(['classification.classifiableItem.classificationType'])
            ->join(Classification::table(), Complaint::column('classification_id'), Classification::column('id'))
            ->join(ClassifiableItem::table(), ClassifiableItem::column('id'), Classification::column('classifiable_item_id'))
            ->when($type, function ($query, $type) {
                $query
                    ->where(ClassifiableItem::column('classification_type_id'), $type);
            })
            ->when($name, function ($query, $name) {
                $query->where(ClassifiableItem::column('name'), 'like', '%' . $name . '%');
            })
            ->when($filterUser, function ($query) use ($user) {
                $query->where(Complaint::column('user_id'), $user->id);
            })
            ->when($value, function ($query) use ($value) {
                $query->where(Classification::column('value'), $value);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(ClassifiableItem::column('name'), 'LIKE', '%' . $search . '%');
            })
            ->when($status, function ($query) use ($status) {
                $query->where(Complaint::column('status'), $status);
            })
            ->orderBy(Classification::column('created_at'), 'desc')
            ->select([Complaint::column('*')])
            ->paginate($perPage);

        return ComplaintResource::collection($data);
    }
}
