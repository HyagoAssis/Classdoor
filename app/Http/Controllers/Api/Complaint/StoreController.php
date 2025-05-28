<?php

namespace App\Http\Controllers\Api\Complaint;

use App\Http\Controllers\Controller;
use App\Http\Requests\Complaint\StoreRequest;
use App\Http\Resources\ComplaintResource;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request): ComplaintResource
    {
        $user = $request->user();

        $complaint = $user->complaints()->create([
            'complaint'         => $request->complaint,
            'classification_id' => $request->classification_id,
            'status'            => 1,
        ]);

        return ComplaintResource::make($complaint);
    }
}
