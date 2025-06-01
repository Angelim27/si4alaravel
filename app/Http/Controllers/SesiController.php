<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sesi = Sesi::all(); // perinta SQL select * from Sesi
        //dd($sesi); // dump and die
        return view('sesi.index')->with('sesi', $sesi);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sesi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        //dd($request->all());
        $input = $request->validate([
            'nama' => 'required|unique:sesi' // validasi nama sesi harus diisi dan unik
        ]);

        // simpan data ke tabel sesi
        Sesi::create($input);

        //redirect ke route sesi.index
        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sesi $sesi)
    {
        //dd($sesi);
        return view('sesi.show', compact('sesi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sesi $sesi)
    { 
        $sesi = Sesi::findOrFail($sesi->id); // mencari sesi berdasarkan id 
        return view('sesi.edit', compact('sesi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sesi $sesi)
    {
        $sesi = Sesi::findOrFail($sesi->id); // mencari sesi berdasarkan id  
        // validasi input
        $input = $request->validate([
            'nama' => 'required|unique:sesi'// validasi nama sesi harus diisi dan unik kecuali untuk sesi yang sedang diedit
        ]);

        // update data sesi
        $sesi->update($input);

        // redirect ke route sesi.index
        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil diperbarui.');
     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sesi $sesi)
    {
        $sesi->delete(); // menghapus data sesi
        // redirect ke route sesi.index
        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil dihapus.');
    }
}
 