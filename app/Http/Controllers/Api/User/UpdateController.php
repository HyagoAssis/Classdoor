<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user, Request $request)
    {
        $user->name  = $request->get('name');
        $user->email = $request->get('email');

        $oldPassword = $request->get('old_password');
    }
}
