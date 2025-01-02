<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category): \Illuminate\Http\JsonResponse
    {
        $deleted = $category->delete();

        return response()->json([
            'message' => $deleted ? 'Categoria deletada' : 'Erro ao deletar a categoria',
        ], $deleted ? 200 : 500);
    }
}
