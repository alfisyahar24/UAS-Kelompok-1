<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Tambahan
use DB;
use App\Models\Buku;
use PDF;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_buku = DB::table('buku')
        ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
        ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
        ->join('kategori', 'kategori.id', '=', 'buku.idkategori')
        ->select('buku.*', 'pengarang.nama', 'penerbit.nama AS pen', 'kategori.nama AS kat')
        ->get();
        return view('buku.index', compact('ar_buku'));
    }

    public function bukuPDF()
    {
        $ar_buku = DB::table('buku')
        ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
        ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
        ->join('kategori', 'kategori.id', '=', 'buku.idkategori')
        ->select('buku.*', 'pengarang.nama', 'penerbit.nama AS pen', 'kategori.nama AS kat')
        ->get();
        $pdf = PDF::loadView('buku.daftarBuku', ['ar_buku'=>$ar_buku]);
    
        return $pdf->download('DaftarBuku.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mengarahkan ke halaman form
        return view('buku.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Proses validasi data
        $validasi = $request->validate(
            [
                'isbn'=>'required|unique:buku|max:100',
                'judul'=>'required',
                'tahun_cetak'=>'required|numeric',
                'stok'=>'required|numeric',
                'idpengarang'=>'required|numeric',
                'idpenerbit'=>'required|numeric',
                'idkategori'=>'required|numeric',
                'cover'=>'image|mimes:jpg,png,jpeg|max:2048'
            ],
            [
                'isbn.required'=>'ISBN Wajib Diisi!',
                'isbn.unique'=>'ISBN Tidak Boleh Sama!',
                'judul.required'=>'Judul Buku Wajib Diisi!',
                'tahun_cetak.required'=>'Tahun Cetak Wajib Diisi!',
                'tahun_cetak.numeric'=>'Tahun Cetak Harus Berupa Angka!',
                'stok.required'=>'Stok Wajib Diisi!',
                'stok.numeric'=>'Stok Harus Berupa Angka!',
                'idpengarang.required'=>'Pengarang Wajib Diisi!',
                'idpenerbit.required'=>'Penerbit Wajib Diisi!',
                'idkategori.required'=>'Kategori Buku Wajib Diisi!',
                'cover.image'=>'Format File Harus jpg, png, jpeg',
                'cover.max'=>'Ukuran File Tidak Boleh Melebihi 1024 Kb!'
            ],
        );

        // // Proses Upload Foto
        // if(!empty($request->cover)){
        //     $request->validate(
        //         ['foto' => 'image|mimes:jpg,png,jpeg|max:2048']
        //     );
        //     $fileName = $request->nama.'.'.$request->foto->extension();
        //     $request->foto->move(public_path('images'),$fileName);
        // }
        // else{
        //     $fileName = '';
        // }

        // Proses input data
        // 1. Tangkap request dari form input
        DB::table('buku')->insert(
            [
                'isbn'=> $request->isbn,
                'judul'=> $request->judul,
                'tahun_cetak'=> $request->tahun_cetak,
                'stok'=> $request->stok,
                'idpengarang'=> $request->idpengarang,
                'idpenerbit'=> $request->idpenerbit,
                'idkategori'=> $request->idkategori
                //'cover'=> $request->cover
            ]
            );

        // 2. Landing page
        return redirect('/buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Menampilkan detail buku
        $ar_buku = DB::table('buku')
        ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
        ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
        ->join('kategori', 'kategori.id', '=', 'buku.idkategori')
        ->select('buku.*', 'pengarang.nama', 'penerbit.nama AS pen', 'kategori.nama AS kat')
        ->where('buku.id', '=', $id)->get();
        return view('buku.show', compact('ar_buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Mengarahkan ke halaman form edit
        $data = DB::table('buku')
        ->where('id', '=', $id)->get();
        return view('buku.form_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Proses edit data lama
        // 1. Tangkap request dari form input
        DB::table('buku')->where('id', '=', $id)->update(
            [
                'isbn'=> $request->isbn,
                'judul'=> $request->judul,
                'tahun_cetak'=> $request->tahun_cetak,
                'stok'=> $request->stok,
                'idpengarang'=> $request->idpengarang,
                'idpenerbit'=> $request->idpenerbit,
                'idkategori'=> $request->idkategori
            ]
            );

        // 2. Landing page
        return redirect('/buku'.'/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Menghapus data
        DB::table('buku')->where('id', $id)->delete();
        return redirect('/buku');
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to Extension Generate PDF',
            'date' => date('m/d/Y')
        ];
        
        $pdf = PDF::loadView('buku.myPDF', $data);
    
        return $pdf->download('testPDF.pdf');
    }
}