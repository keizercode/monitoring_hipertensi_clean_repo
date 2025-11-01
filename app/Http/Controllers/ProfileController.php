<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProfileController extends Controller
{   
    use AuthorizesRequests;
    public function show()
    {
        return view('profile.show');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nip' => 'nullable|string|unique:users,nip,' . $user->id,
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'nip']);

        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $user->update($data);

        return redirect()->route('profile.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}