<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Multipleuploads;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['gender'];
        $searchableColumns = ['first_name', 'last_name', 'email'];

        $data['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)->withQueryString();

        return view('admin.pelanggan.index', $data);
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['birthday'] = $request->birthday;
        $data['gender'] = $request->gender;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;

        $pelanggan = Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');
    }

    public function show(string $id)
{
    $pelanggan = Pelanggan::findOrFail($id);

    $files = Multipleuploads::where('ref_table', 'pelanggan')
                ->where('ref_id', $id)
                ->get();

    return view('admin.pelanggan.detail', compact('pelanggan', 'files'));
}


    public function edit(string $id)
    {
        $data['pelanggan'] = Pelanggan::findOrFail($id);

        $data['files'] = Multipleuploads::where('ref_table', 'pelanggan')
            ->where('ref_id', $id)
            ->get();

        return view('admin.pelanggan.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        // Update data utama
        $pelanggan->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Upload file (optional)
        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                $name = time() . "-" . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $name);

                Multipleuploads::create([
                    'filename' => $name,
                    'ref_table' => 'pelanggan',
                    'ref_id' => $pelanggan->pelanggan_id,
                ]);
            }
        }

        return redirect()->route('pelanggan.show', $id)
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data user berhasil dihapus!');
    }


    public function uploadFiles(Request $request)
    {
        $request->validate([
            'filename.*' => 'mimes:jpg,jpeg,png,pdf,doc,docx|max:2048'
        ]);

        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                $name = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $name);

                Multipleuploads::create([
                    'filename' => $name,
                    'ref_table' => $request->ref_table,
                    'ref_id' => $request->ref_id,
                ]);
            }
        }

        return back()->with('success', 'File berhasil diupload!');
    }

    public function deleteFile($id)
    {
        $file = Multipleuploads::findOrFail($id);

        $path = public_path('uploads/' . $file->filename);
        if (file_exists($path)) {
            unlink($path);
        }

        $file->delete();

        return back()->with('success', 'File berhasil dihapus!');
    }
}
