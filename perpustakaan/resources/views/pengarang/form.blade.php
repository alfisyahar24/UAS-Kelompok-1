@extends('layouts.index')
@section('content')
<h3>Form Pengarang</h3>
<form method="POST" action="{{ route('pengarang.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Nama Pengarang</label>
        <input type="text" name="nama" class="form-control">
    </div>
    <div class="form-group">
        <label>Email Pengarang</label>
        <input type="text" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label>HP Pengarang</label>
        <input type="text" name="hp" class="form-control">
    </div>
    <div class="form-group">
        <label>Foto Pengarang</label>
        <input type="file" name="foto" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary" name="proses">Simpan</button>
    <button type="reset" class="btn btn-warning" name="unproses">Batal</button>
</form>
@endsection