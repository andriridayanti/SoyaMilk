@extends('Index2')

@section('Title')
Pemesanan
@endsection

@section('Main')
@if(Session::get('Level') == 'Mitra')
<div class="grid grid-cols-1 rounded-xl">
    <div class="px-3 py-2 rounded-xl border mr-2 mt-3 mb-2 w-[100%]">
        <form action="/Pemesanan" method="get">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" name="search" placeholder="Cari Customer....">
        </form>
    </div>
</div>
<form action="/SearchPemesanan" method="post">
    @csrf
    <div class="border  rounded-xl mb-5">
        <div class="text-center">
            <b>Filter Tanggal</b>
        </div>
        <div class="grid grid-cols-2">
            <div class="w-full text-center">
                <b>Dari Tanggal</b><br>
                <input type="date" name="dari" required>
            </div>
            <div class="w-full text-center">
                <b>Sampai Tanggal</b><br>
                <input type="date" name="sampai" required>
            </div>
        </div>
        <div class="grid grid-cols-1 rounded-xl mb-3">
            <div class="w-full text-center">
                <button type="submit" class="float-center mt-5 ml-5 font-normal text-sm px-2 py-1 rounded-full bg-[#EEBA39] text-white">Cari <i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
    </div>
</form>
@foreach ($Pemesanan as $dt)
<div class="grid grid-cols-3 gap-1 px-12 py-5 rounded-xl border mb-3">
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl"><img src="{{ asset('foot-produk/'.$dt->gambar) }}" height="40%" width="40%" class="mb-5"></div>
    </div>
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl">
            <p style="font-size:20px;"><b>{{ $dt->nama_produk }}</b></p>
            <p>Varian : {{ $dt->berat }} ml</p>
            <p style="font-size:24px;" class="text-[#017707] text-lg mb-2"><b>Rp {{ number_format($dt->harga)}}</b></p>
            @if($dt->status == 'Belum Dikirim')
            <p style="font-size:16px;" class="text-[#DA1006] text-lg mb-2"><b>{{$dt->status}}</b></p>
            @elseif($dt->status == 'Dikirim')
            <p style="font-size:16px;" class="text-[#0E4D99] text-lg mb-2"><b>Proses Pengiriman</b></p>
            @else($dt->status == 'Selesai')
            <p style="font-size:16px;" class="text-[#16AC01] text-lg mb-2"><b>Telah Diterima</b></p>
            @endif
        </div>
    </div>
    <div><br>
        <p>Customer : <b>{{ $dt->nama }}</b></p><br>
        <a href="{{ url('DetailPemesanan'.'/'.$dt->id) }}" class="px-5 py-1 rounded-full border bg-[#519259]"><b>LIHAT DETAIL</b></a>
    </div>
</div>
@endforeach
@endif

@endsection