@extends('Index2')

@section('Title')
Pengeluaran
@endsection

@section('Main')
<br>
<div class="grid grid-cols-1 rounded-xl">
    <div class="px-3 py-2 rounded-xl border mr-2 mt-3 mb-2 w-[100%]">
        <form action="/Pengeluaran" method="get">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" name="search" placeholder="Cari Nama Transaksi....">
        </form>
    </div>
</div>
<a href="{{ route('Keuangan') }}" class="float-right font-normal text-sm px-3 py-2 rounded-full bg-[#519259] text-white">Menu Keuangan</a>
<div class="px-3 py-2 rounded-xl mt-3 mb-7 w-[50%]">
</div>

@foreach ($Pengeluaran as $dt)
<div class="grid grid-cols-6 gap-1 px-12 py-5 rounded-xl border mb-3">
    <div class="w-full">
        <p><b>{{ $dt->transaksi }}</b></p>
    </div>
    <div class="w-full">
        <p>{{ date_format(new DateTime($dt->created_at), 'd M Y'  )}}</p>
    </div>
    <div class="w-full">
        <p>{{ $dt->jumlah_transaksi }}</p>
    </div>
    <div class="w-full">
        <p>Rp. {{number_format($dt->harga_satuan)}}</p>
    </div>
    <div class="w-full">
        <p>Rp. {{number_format($dt->total_transaksi)}}</p>
    </div>
    <div><a href="{{ url('DetailPengeluaran'.'/'.$dt->id) }}" class="px-2 py-1 rounded-full border bg-[#0D9290]">LIHAT DETAIL</a></div>
</div>
@endforeach

@endsection