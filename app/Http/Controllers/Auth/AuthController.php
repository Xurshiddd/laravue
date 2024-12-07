<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ImageUpload;
class AuthController extends Controller
{
    protected $imageUpload;

    public function __construct(ImageUpload $imageUpload)
    {
        $this->imageUpload = $imageUpload;
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($request->hasFile('avatar')) {
            $data['avatar'] = '/images/'. $this->imageUpload->oneImage($request->file('avatar'), '/images');;
        }
        $user = User::create($data);
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::logout();
        return redirect()->route('home');
    }
}
