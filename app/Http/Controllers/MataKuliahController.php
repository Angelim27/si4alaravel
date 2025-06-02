<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengambil semua data mata kuliah
        $mataKuliah = MataKuliah::with('prodi')->get();

        // mengirim data mata kuliah ke view index
        return view('mata_kuliah.index', compact('mataKuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all();
        return view('mata_kuliah.create', compact('prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        // validasi input
        $input = $request->validate([
            'kode_mk' => 'required|unique:mata_kuliah',
            'nama' => 'required',
            'prodi_id' => 'required'
        ]);

        // simpan data ke tabel mata_kuliah
        MataKuliah::create($input);

        // redirect ke route mataKuliah.index
        return redirect()->route('mata_kuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataKuliah $mataKuliah)
    {
        //dd($mataKuliah);
        // BENAR: $mataKuliah sesuai dengan parameter fungsi
        return view('mata_kuliah.show', compact('mataKuliah'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliah $mataKuliah)
    {
        // dd($mataKuliah);
        $prodi = Prodi::all(); // ambil semua data prodi
        return view('mata_kuliah.edit', compact('mataKuliah', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $input = $request->validate([
            'kode_mk' => 'required',
            'nama' => 'required',
            'prodi_id' => 'required'
        ]);

        $mataKuliah->update($input);

        return redirect()->route('mata_kuliah.index')->with('success', 'Mata Kuliah berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliah $mataKuliah)
    {

        // Menemukan data mata kuliah berdasarkan ID
        $mataKuliah = MataKuliah::findOrFail($mataKuliah->id);
        // dd($mataKuliah);
        // Menghapus data mata kuliah
        $mataKuliah->delete();
        // redirect ke route mataKuliah.index
        return redirect()->route('mata_kuliah.index')->with('success', 'Mata Kuliah berhasil dihapus.');
    }
}
