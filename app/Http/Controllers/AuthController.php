<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthRequest;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class AuthController extends Controller
{
    public function login(StoreAuthRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if (Gate::forUser($user)->allows('admin')) {
            return redirect()->route('dashboard.admin');
        }

        if (Gate::forUser($user)->allows('user')) {
            return redirect()->route('dashboard.user');
        }

        Auth::logout();

        throw ValidationException::withMessages([
            'email' => 'Akun tidak memiliki role yang valid.',
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $role = Role::where('name', 'user')->first();

        if (! $role) {
            throw new RuntimeException('The user role is missing. Seed roles before registering users.');
        }

        $user = DB::transaction(function () use ($validated, $role) {
            $profile = Profile::create([
                'umur' => 17,
                'bio' => '',
                'alamat' => '',
            ]);

            return User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'profile_id' => $profile->id,
                'role_id' => $role->id,
            ]);
        });

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('dashboard.user');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
