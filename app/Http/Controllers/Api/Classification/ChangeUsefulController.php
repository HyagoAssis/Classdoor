<?php

namespace App\Http\Controllers\Api\Classification;

use App\Http\Controllers\Controller;
use App\Models\{Classification, UsefulUser};
use Illuminate\Http\Request;

class ChangeUsefulController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Classification $classification, Request $request)
    {
        $user = auth()->user();

        $usefulUser = UsefulUser::where('classification_id', $classification->id)->where('user_id', $user->id)->first();

        if (!$usefulUser) {
            $classification->useful_count += 1;
            $liked = 1;

            UsefulUser::create([
                'classification_id' => $classification->id,
                'user_id'           => $user->id,
            ]);
        } else {
            $classification->useful_count -= 1;
            $liked = 0;

            $usefulUser->delete();
        }

        $classification->save();

        return response()->json([
            'message' => 'Salvo com sucesso',
            'count'   => $classification->useful_count,
            'liked'   => $liked,
        ]);
    }
}
