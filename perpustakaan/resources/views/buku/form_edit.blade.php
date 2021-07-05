@extends('layouts.index')
@section('content')
@php
$rs1 = App\Models\Pengarang::all();
$rs2 = App\Models\Penerbit::all();
$rs3 = App\Models\Kategori::all();
@endphp
<h3>Form Edit Buku</h3>
@foreach($data as $rs)
<form method="POST" action="{{ route('buku.update', $rs->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>ISBN</label>
        <input type="text" name="isbn" value="{{ $rs->isbn }}" class="form-control">
    </div>
    <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" value="{{ $rs->judul }}" class="form-control">
    </div>
    <div class="form-group">
        <label>Tahun Cetak</label>
        <input type="text" name="tahun_cetak" value="{{ $rs->tahun_cetak }}" class="form-control">
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="text" name="stok" value="{{ $rs->stok }}" class="form-control">
    </div>
    <div class="form-group">
        <label>Pengarang</label>
        <select class="form-control" name="idpengarang">
            <option value="">--- Pilih Pengarang ---</option>
            @foreach($rs1 as $p)
            {{-- edit pengarang --}}
            @php
            $sel1 = ($p->id == $rs->idpengarang) ? 'selected' : '';
            @endphp
            <option value="{{ $p->id }}" {{ $sel1 }}>{{ $p->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Penerbit</label>
        <select class="form-control" name="idpenerbit">
            <option value="">--- Pilih Penerbit ---</option>
            @foreach($rs2 as $pen)
            {{-- edit penerbit --}}
            @php
            $sel2 = ($pen->id == $rs->idpenerbit) ? 'selected' : '';
            @endphp
            <option value="{{ $pen->id }}" {{ $sel2 }}>{{ $pen->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Kategori</label> <br>
        @foreach($rs3 as $k)
        {{-- edit kategori --}}
        @php
        $cek = ($k->id == $rs->idkategori) ? 'checked' : '';
        @endphp
        <input type="radio" name="idkategori" value="{{ $k->id }}" {{ $cek }}> {{ $k->nama }} &nbsp;
        @endforeach
    </div>
    <button type="submit" class="btn btn-primary" name="proses">Ubah</button>
    <button type="reset" class="btn btn-warning" name="unproses">Batal</button>
</form>
@endforeach
@endsection