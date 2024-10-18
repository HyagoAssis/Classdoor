<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request): CategoryResource
    {
        $category = Category::create([
            'name'                   => $request->name,
            'classification_type_id' => $request->classification_type_id,
        ]);

        return CategoryResource::make($category);
    }
}
