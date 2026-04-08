<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\KritikSaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KritikSaranController extends Controller
{
    public function index()
    {
        $kritikSaran = KritikSaran::with('user.kelas')
            ->byUser(Auth::id())
            ->latest()
            ->paginate(10);

        return view('siswa.kritik-saran.index', compact('kritikSaran'));
    }

    public function create()
    {
        return view('siswa.kritik-saran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe' => ['required', 'in:kritik,saran'],
            'judul' => ['required', 'string', 'max:255'],
            'pesan' => ['required', 'string', 'min:10'],
            'lokasi' => ['required', 'string', 'max:255'],
            'gambar.*' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg,gif'],
        ]);

        $imagePaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $path = $image->store('kritik-saran', 'public');
                $imagePaths[] = $path;
            }
        }

        KritikSaran::create([
            'user_id' => Auth::id(),
            'tipe' => $validated['tipe'],
            'judul' => $validated['judul'],
            'pesan' => $validated['pesan'],
            'lokasi' => $validated['lokasi'],
            'gambar' => ! empty($imagePaths) ? $imagePaths : null,
        ]);

        return redirect()->route('siswa.kritik-saran.index')
            ->with('success', 'Kritik dan saran berhasil dikirim!');
    }

    public function show(KritikSaran $kritikSaran)
    {
        if ($kritikSaran->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $kritikSaran->load('user');

        return view('siswa.kritik-saran.show', compact('kritikSaran'));
    }

    public function semuaAspirasi()
    {
        $aspirasis = Aspirasi::with(['user', 'latestResponse'])
            ->latest()
            ->paginate(10);

        return view('siswa.semua-aspirasi', compact('aspirasis'));
    }
}
