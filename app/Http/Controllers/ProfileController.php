<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = User::find(auth()->user());
        return inertia('Profile', ['user' => $user[0]]);
    }
}
