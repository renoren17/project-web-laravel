<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $genres = Genre::all();

        return view('profile.show', compact('user', 'genres'));
    }

    public function edit()
    {
        $user = Auth::user();
        $genres = Genre::all();

        return view('profile.edit', compact('user', 'genres'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'umur' => ['required', 'integer', 'min:1', 'max:120'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'alamat' => ['nullable', 'string', 'max:255'],
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $validated['name'],
        ]);

        $user->profile()->firstOrFail()->update([
            'umur' => $validated['umur'],
            'bio' => $validated['bio'] ?? '',
            'alamat' => $validated['alamat'] ?? '',
        ]);

        return redirect()->route('profile')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
