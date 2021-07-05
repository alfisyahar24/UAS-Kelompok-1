@php
$nama = "Renaldi Alfi Syahar";
$nilai = 69.99;
@endphp

{{-- STRUKTUR KENDALI IF --}}
@if($nilai >= 60) @php $ket = "Lulus"; @endphp
@else @php $ket = "Gagal"; @endphp
@endif

Nama Siswa : {{$nama}}
<br>
Nilai : {{$nilai}}
<br>
Keterangan : {{$ket}}