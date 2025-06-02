<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Sesi;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //menampilkan list data dari tabel jadwal
    {
        //panggil model Jadwal menggunakan eloquent
        $jadwal = Jadwal::all(); // perintah select * from jadwal (panggil model lalu panggil all)
        //dd($jadwal); //dump and die
        return view('jadwal.index')->with('jadwal', $jadwal); //mengirim data ke view fakultas.index
        //selain compact bisa menggunakan with()
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() //menampilkan formulis tambah data fakultas
    {
        $sesi = Sesi::all(); // ambil semua data sesi
        $mataKuliah = MataKuliah::all(); // ambil semua data mata kuliah
        $dosen = User::where('role', 'dosen')->get(); 
        return view('jadwal.create', compact('sesi', 'mataKuliah', 'dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //memproses penyimpanan data fakultas
    {
        // validasi input
        $input = $request->validate([
            'tahun_akademik' => 'required',
            'kode_smt' => 'required',
            'kelas' => 'required',
            'mata_kuliah_id' => 'required',
            'dosen_id' => 'required',
            'sesi_id' => 'required'
        ]);

        // simpan data ke tabel fakultas
        Jadwal::create($input);

        // redirect ke route fakultas.index
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show( Jadwal $jadwal) //menampilkan detail data jadwal
    {
        // dd($jadwal); //dump and die 
        return view('jadwal.show', compact('jadwal')); //mengirim data ke view jadwal.show
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal) //menampilkan formulir edit data jadwal
    {
        // dd($jadwal);
        $sesi = Sesi::all(); // ambil semua data sesi
        $mataKuliah = MataKuliah::all(); // ambil semua data mata kuliah
        $dosen = User::where('role', 'dosen')->get(); 
        return view('jadwal.edit', compact('jadwal', 'sesi', 'mataKuliah', 'dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal) //memproses penyimpanan perubahan data yg ada pada formulir edit tadi
    {
        // validasi input
        $input = $request->validate([
            'tahun_akademik' => 'required',
            'kode_smt' => 'required',
            'kelas' => 'required',
            'mata_kuliah_id' => 'required',
            'dosen_id' => 'required',
            'sesi_id' => 'required'
        ]);
        $jadwal->update($input); //update data jadwal dengan input yang sudah divalidasi
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.'); //redirect ke route jadwal.index
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal$jadwal) //menghapus data jadwal
    {
        $jadwal = Jadwal::findOrFail($jadwal->id); //mencari data jadwal berdasarkan id
        // dd($jadwal);
        $jadwal->delete(); //menghapus data jadwal
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.'); //redirect ke route jadwal.index
    }
}