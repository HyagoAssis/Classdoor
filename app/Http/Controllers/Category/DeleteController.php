<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category)
    {
        $deleted = $category->delete();

        return response()->json([
            'message' => $deleted ? 'Categoria deletada' : 'Erro ao deletar a categoria',
        ], $deleted ? 200 : 500);
    }
}
