@extends('Index')

@section('Grid1')
<div class="grid grid-cols-1 place-content-center h-full mx-40">
    <p class="font-medium text-xl">Selamat Datang...</p>
    <p class="font-bold text-3xl my-3">SOYAMILK</p>
    <p class="">Perusahaan rumah yang menyajikan berbagai macam pilihan susu kedelai yang pastinya enak dan menyehatkan.</p>
    <div class="mt-5 ">
        <a href="{{ route('Login') }}"><label for="" class="px-12 py-3 text-slate-50 bg-[#F0BB62] rounded-3xl">Mulai</label></a>
    </div>
</div>
@endsection

@section('Grid2')
<div class="grid grid-cols-1 place-content-center h-full mx-20">
    <img src="{{ asset('img/garden.png') }}" alt="">
</div>
@endsection

@section('Main')
<img src="{{ asset('img/gradasi.png') }}" alt="" class="fixed w-full bottom-0">
@endsection