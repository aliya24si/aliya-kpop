<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
                                       // Kolom yang bisa difilter (sesuaikan kebutuhan)
        $filterableColumns = ['role']; // Filter berdasarkan role

        // Kolom yang bisa dicari
        $searchableColumns = ['name', 'email'];

        $data['dataUser'] = User::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->withQueryString();

        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required|in:admin,staff,user',
            'password' => 'required|min:6|confirmed',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data             = $request->only('name', 'email', 'role');
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Perubahan UTAMA: Paksa menggunakan disk 'public'
            $file->storePubliclyAs('photo', $filename, 'public');

            $data['photo'] = $filename;
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Penambahan data user berhasil!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);
        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => 'required',
            'password' => 'nullable|confirmed',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika password diisi, update, kalau tidak diabaikan
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Proses foto
        if ($request->hasFile('photo')) {

            // Hapus foto lama jika ada
            if ($user->photo && file_exists(storage_path('app/public/photo/' . $user->photo))) {
                unlink(storage_path('app/public/photo/' . $user->photo));
            }

            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Perubahan UTAMA: Paksa menggunakan disk 'public'
            $file->storePubliclyAs('photo', $filename, 'public');

            $validated['photo'] = $filename;
        }

        // Update data
        $user->update($validated);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus!');
    }
}
