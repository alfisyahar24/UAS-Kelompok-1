@php
$no = 1;
// ARRAY SCALAR
$s1 = ['nama'=>'Alfi', 'nilai'=>85];
$s2 = ['nama'=>'Syahar', 'nilai'=>58];
$s3 = ['nama'=>'Yasser', 'nilai'=>95];
$s4 = ['nama'=>'Lukman', 'nilai'=>30];
$judul = ['No', 'Nama', 'Nilai', 'Keterangan'];

// ARRAY ASSOCIATION
$siswa = [$s1, $s2, $s3, $s4];
@endphp

<h3 style="text-align: center;">Daftar Nilai Siswa</h3>
<table border="1" align="center" cellpadding="10">
    <thead>
        <tr bgcolor="blue">
            @foreach($judul as $jdl)
            <th>{{ $jdl }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($siswa as $sis)
        {{-- LOGIC KELULUSAN DAN WARNA WARNI DENGAN TERNARY --}}
        @php
        $ket = ($sis['nilai'] >= 60) ? 'Lulus' : 'Gagal';
        $warna = ($no %2 == 0) ? 'greenyellow' : 'yellow';
        @endphp
        <tr bgcolor="{{ $warna }}">
            <td>{{ $no++ }}</td>
            <td>{{ $sis['nama'] }}</td>
            <td>{{ $sis['nilai'] }}</td>
            <td>{{ $ket }}</td>
        </tr>
        @endforeach
    </tbody>
</table>