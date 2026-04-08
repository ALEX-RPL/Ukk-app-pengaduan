<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAspirasiRequest;
use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    public function index()
    {
        $aspirasis = Aspirasi::with(['user.kelas', 'latestResponse', 'kategoriModel'])
            ->byUser(Auth::id())
            ->latest()
            ->paginate(10);

        return view('siswa.index', compact('aspirasis'));
    }

    public function create()
    {
        $kategoris = Kategori::active()->get();

        return view('siswa.create', compact('kategoris'));
    }

    public function store(StoreAspirasiRequest $request)
    {
        $imagePaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $path = $image->store('aspirasi', 'public');
                $imagePaths[] = $path;
            }
        }

        $user = Auth::user();

        Aspirasi::create([
            'user_id' => Auth::id(),
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'konten' => $request->konten,
            'lokasi' => $request->lokasi,
            'gambar' => $imagePaths,
            'status' => Aspirasi::STATUS_PENDING,
            'nis_pelapor' => $user->nis,
            'kelas_pelapor' => $user->kelas ? $user->kelas->nama_kelas : null,
        ]);

        return redirect()->route('siswa.aspirasi.index')
            ->with('success', 'Aspirasi berhasil dikirim!');
    }

    public function show(Aspirasi $aspirasi)
    {
        if ($aspirasi->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $aspirasi->load([
            'responses.admin' => function ($query) {
                $query->orderBy('created_at', 'asc');
            },
            'user.kelas',
        ]);

        return view('siswa.show', compact('aspirasi'));
    }

    public function histori()
    {
        $aspirasis = Aspirasi::with(['latestResponse'])
            ->byUser(Auth::id())
            ->latest()
            ->get();

        return view('siswa.histori', compact('aspirasis'));
    }
}
