@php
$ar_judul = ['No', 'ISBN', 'Judul', 'Stok', 'Pengarang', 'Penerbit', 'Kategori'];
$no = 1;
@endphp
<h3 align="center">Daftar Buku</h3>
<table border="1" align="center" cellpadding="5">
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
        </tr>
        @endforeach
    </tbody>
</table>