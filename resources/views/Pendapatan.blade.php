@extends('Index2')

@section('Title')
Pendapatan
@endsection

@section('Main')
<br>
<div class="grid grid-cols-1 rounded-xl">
    <div class="px-3 py-2 rounded-xl border mr-2 mt-3 mb-2 w-[100%]">
        <form action="/Pendapatan" method="get">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" name="search" placeholder="Cari Nama Produk....">
        </form>
    </div>
</div>
<a href="{{ route('Keuangan') }}" class="float-right font-normal text-sm px-3 py-2 rounded-full bg-[#519259] text-white">Menu Keuangan</a>
<div class="px-3 py-2 rounded-xl mt-3 mb-7 w-[50%]">
</div>

@foreach ($Pendapatan as $dt)
<div class="grid grid-cols-5 gap-1 px-12 py-5 rounded-xl border mb-3">
    <div class="w-full">
        <p><b>{{ $dt->nama_produk }}</b></p>
    </div>
    <div class="w-full">
        <p>{{ date_format(new DateTime($dt->created_at), 'd M Y'  )}}</p>
    </div>
    <div class="w-full">
        <p>Stok: {{ $dt->jumlah_transaksi }}</p>
    </div>
    <div class="w-full">
        <p>Rp. {{number_format($dt->total_pembayaran + $dt->harga_ongkir)}}</p>
    </div>
    <div><a href="{{ url('DetailPendapatan'.'/'.$dt->id) }}" class="px-5 py-1 rounded-full border bg-[#0D9290]">LIHAT DETAIL</a></div>
</div>
@endforeach

@endsection