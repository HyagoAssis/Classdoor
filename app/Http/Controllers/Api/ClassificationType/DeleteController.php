<?php

namespace App\Http\Controllers\Api\ClassificationType;

use App\Http\Controllers\Controller;
use App\Models\ClassificationType;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ClassificationType $classificationType): \Illuminate\Http\JsonResponse
    {
        $deleted = $classificationType->delete();

        return response()->json([
            'message' => $deleted ? 'Tipo deletado' : 'Erro ao deletar o tipo',
        ], $deleted ? 200 : 500);
    }
}
