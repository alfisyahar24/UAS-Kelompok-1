@extends('layouts.index')
@section('content')
@php
$ar_judul = ['No', 'ISBN', 'Judul', 'Stok', 'Pengarang', 'Penerbit', 'Kategori', 'Action'];
$no = 1;
@endphp
<h3>Daftar Buku</h3>
<br>
<a class="btn btn-primary btn-md" href="{{ route('buku.create') }}" role="button">Tambah</a>
<br>
<br>
<table class="table table-striped">
    <thead>
        <tr>
            @foreach($ar_judul as $jdl)
            <th>
                {{ $jdl }}
            </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($ar_buku as $b)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $b->isbn }}</td>
            <td>{{ $b->judul }}</td>
            <td>{{ $b->stok }}</td>
            <td>{{ $b->nama }}</td>
            <td>{{ $b->pen }}</td>
            <td>{{ $b->kat }}</td>
            <td>
                <form method="POST" action="{{ route('buku.destroy', $b->id) }}">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-info" href="{{ route('buku.show', $b->id) }}">Detail</a>
                    <a class="btn btn-warning" href="{{ route('buku.edit', $b->id) }}">Edit</a>
                    <button class="btn btn-danger"
                        onclick="return confirm('Anda Yakin Ingin Menghapus?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection