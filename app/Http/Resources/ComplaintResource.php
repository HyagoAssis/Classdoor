<?php

namespace App\Http\Resources;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Complaint $this */
        $statusText = 'Em análise';

        switch ($this->status) {
            case Complaint::STATUS_APPROVED:
                $statusText = 'Aprovada';

                break;
            case Complaint::STATUS_REPROVED:
                $statusText = 'Reprovada';

                break;
        }

        return array_merge(parent::toArray($request), [
            'status_text' => $statusText,
        ]);
    }
}
