<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Tampilkan daftar pengguna.
     */
    public function index()
    {
        // Pakai withCount & withSum kalau relasi pesanan & kolom total_harga ada
        $users = User::withCount('pesanan')
            ->withSum('pesanan as total_belanja', 'total_harga')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pengguna.index', compact('users'));
    }

    /**
     * Form tambah pengguna.
     */
    public function create()
    {
        return view('admin.pengguna.create');
    }

    /**
     * Simpan pengguna baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string',
            'role'     => 'required|in:admin,customer',
            'status'   => 'required|in:active,inactive',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'address'  => $request->address,
            'role'     => $request->role,
            'status'   => $request->status,
        ]);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Detail pengguna.
     */
    public function show($id)
    {
        $user = User::with(['pesanan' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->findOrFail($id);

        return view('admin.pengguna.show', compact('user'));
    }

    /**
     * Form edit pengguna.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pengguna.edit', compact('user'));
    }

    /**
     * Update data pengguna.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $user->id,
            'phone'  => 'nullable|string|max:20',
            'address'=> 'nullable|string',
            'role'   => 'required|in:admin,customer',
            'status' => 'required|in:active,inactive',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'address'=> $request->address,
            'role'   => $request->role,
            'status' => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Hapus pengguna.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Optional: cegah hapus diri sendiri
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
