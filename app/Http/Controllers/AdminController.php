<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResponseRequest;
use App\Models\Aspirasi;
use App\Models\KritikSaran;
use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Aspirasi::with(['user.kelas', 'latestResponse']);

        if ($request->filled('kategori')) {
            $query->byCategory($request->kategori);
        }

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        if ($request->filled('date')) {
            $query->byDate($request->date);
        }

        if ($request->filled('month') && $request->filled('year')) {
            $query->byMonth($request->year, $request->month);
        }

        if ($request->filled('user_id')) {
            $query->byUser($request->user_id);
        }

        $aspirasis = $query->latest()->paginate(15);

        $users = User::byRole(User::ROLE_SISWA)
            ->withCount('aspirasis')
            ->orderBy('name')
            ->get();

        return view('admin.index', compact('aspirasis', 'users'));
    }

    public function kritikSaran(Request $request)
    {
        $query = KritikSaran::with('user.kelas');

        if ($request->filled('tipe')) {
            $query->byTipe($request->tipe);
        }

        if ($request->filled('user_id')) {
            $query->byUser($request->user_id);
        }

        $kritikSarans = $query->latest()->paginate(15);

        $users = User::byRole(User::ROLE_SISWA)
            ->orderBy('name')
            ->get();

        return view('admin.kritik-saran', compact('kritikSarans', 'users'));
    }

    public function show(Aspirasi $aspirasi)
    {
        $aspirasi->load([
            'responses.admin' => function ($query) {
                $query->orderBy('created_at', 'asc');
            },
            'user',
        ]);

        return view('admin.show', compact('aspirasi'));
    }

    public function storeResponse(StoreResponseRequest $request, Aspirasi $aspirasi)
    {
        \DB::transaction(function () use ($request, $aspirasi) {
            Response::create([
                'aspirasi_id' => $aspirasi->id,
                'admin_id' => Auth::id(),
                'response_text' => $request->response_text,
                'status_update' => $request->status_update,
            ]);

            $aspirasi->update([
                'status' => $request->status_update,
            ]);
        });

        return redirect()->route('admin.aspirasi.show', $aspirasi)
            ->with('success', 'Umpan balik berhasil diberikan!');
    }
}
