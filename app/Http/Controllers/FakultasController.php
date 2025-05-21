<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // menampilkan list data fakultas
    {
        //panggil model fakultas menggunakan eloquent
        $fakultas = Fakultas::all(); // perinta SQL select * from Fakultas
        //dd($fakultas); // dump and die
        return view('fakultas.index', compact('fakultas')); //selain compact, bisa menggunakan with()
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() // menambahkan formulir tambah data fakultas
    {   
        $fakultas = Fakultas::all(); 
        return view ('fakultas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // memproses penyimpanan data fakultas
    {
        // validasi input
        $input = $request->validate([
            'nama' => 'required|unique:fakultas',
            'singkatan' => 'required|max:5',
            'dekan' => 'required',
            'wakil_dekan' => 'required',
        ]);
            
        // simpan data ke tabel fakultas
        Fakultas::create($input);

        // redirect ke route fakultas.index
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Fakultas $fakultas) // menampilkan detail fakultas
    {
        $fakultas = Fakultas::findOrFail($fakultas);
        dd($fakultas); // dump and die

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fakultas $fakultas) // menampilkan formulir bagian edit
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fakultas $fakultas) // memproses penyimpanan perubahan data fakultas
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fakultas $fakultas) // menghapus data fakultas
    {
        //
    }
}
