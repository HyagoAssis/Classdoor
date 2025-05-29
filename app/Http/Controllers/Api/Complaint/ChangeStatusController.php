<?php

namespace App\Http\Controllers\Api\Complaint;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ChangeStatusController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Complaint $complaint, Request $request)
    {
        $newStatus = $request->get('status');

        $complaint->status = $newStatus;
        $complaint->save();

        $classification = $complaint->classification;

        if ($complaint->status === Complaint::STATUS_REPROVED) {
            $classification->update(['valid' => false]);
        } else {
            $hasInvalidComplaint = $classification->complaints->contains(
                fn (Complaint $complaint) => $complaint->status === Complaint::STATUS_REPROVED
            );

            if (!$hasInvalidComplaint) {
                $classification->update(['valid' => true]);
            }
        }

        return response()->json([
            'Salvo com sucesso',
        ]);
    }
}
