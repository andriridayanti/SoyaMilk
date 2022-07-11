@extends('Index2')

@section('Title')
    Artikel
@endsection

@section('Main')
<center>
    <h1 class="text-[#064635] text-lg mb-5">{{ $Artikel->judul }}</h1>
    <img src="{{ asset('artikel/'.$Artikel->gambar) }}" alt="" width="25%" class="mb-5">
</center>
<p class="text-justify">{{ $Artikel->isi }}</p>
@endsection