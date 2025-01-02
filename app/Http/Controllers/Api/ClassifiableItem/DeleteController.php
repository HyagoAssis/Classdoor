<?php

namespace App\Http\Controllers\Api\ClassifiableItem;

use App\Http\Controllers\Controller;
use App\Models\ClassifiableItem;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ClassifiableItem $classifiableItem): \Illuminate\Http\JsonResponse
    {
        $deleted = $classifiableItem->delete();

        return response()->json([
            'message' => $deleted ? 'Categoria deletada' : 'Erro ao deletar a categoria',
        ], $deleted ? 200 : 500);
    }
}
