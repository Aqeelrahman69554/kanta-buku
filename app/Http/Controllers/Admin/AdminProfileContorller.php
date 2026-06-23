<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Sekarang akan terbaca "used" jika logika password diaktifkan
use App\Models\Admin; // <-- Sudah diperbaiki dari MOdels ke Models
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // 1. Menampilkan halaman profil admin
    public function index()
    {
        // Mengambil data admin yang sedang login
        $admin = auth()->guard('admin')->user();
        return view('admin.pages.profile', compact('admin'));
    }

    // 2. Memproses update data profil & foto
    public function update(Request $request)
    {
        $admin = Admin::find(auth()->guard('admin')->id());

        // Validasi input form
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'bio' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed', // Aturan validasi jika ingin ganti password
        ]);

        // Update data text biasa
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->bio = $request->bio;

        // Logika Penggantian Password (Hanya di-update jika form password diisi)
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // Logika jika admin mengupload foto baru
        if ($request->hasFile('image')) {
            // Hapus foto lama di storage jika ada (agar tidak memenuhi server)
            if ($admin->image && Storage::disk('public')->exists($admin->image)) {
                Storage::disk('public')->delete($admin->image);
            }

            // Simpan foto baru ke folder storage/app/public/avatars
            $path = $request->file('image')->store('avatars', 'public');
            $admin->image = $path; // Simpan path nya ke kolom 'image'
        }

        $admin->save(); // Menyimpan semua perubahan di atas ke database

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
