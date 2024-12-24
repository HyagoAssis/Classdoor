<?php

namespace App\Http\Resources;

use App\Models\{ClassifiableItem, Classification};
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassifiableItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var ClassifiableItem $this */
        $data = [
            'avg_classification'   => round($this->classifications()->avg(Classification::column('value')) ?? 0, 2),
            'total_classification' => $this->classifications()->count(),
        ];

        return array_merge(parent::toArray($request), $data);
    }
}
