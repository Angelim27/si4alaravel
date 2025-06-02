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
        $mataKuliah = MataKuliah::all(); // perinta SQL select * from MataKuliah
        //dd($mataKuliah); // dump and die
        return view('mata_kuliah.index')->with('mata_kuliah', $mataKuliah);
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
        return view('mata_kuliah.show', compact('mata_kuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliah $mataKuliah)
    {
        $prodi = Prodi::all();
        return view('mata_kuliah.edit', compact('mata_kuliah', 'prodi'));
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
