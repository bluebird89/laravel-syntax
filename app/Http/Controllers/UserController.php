<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  User  $user
     *
     * @return View
     */
    public function show(User $user)
    {
        Log::info('Showing user profile for user: '.$id);
        return view('user.profile', ['user' => $user]);
    }
}
