@extends('Index2')

@section('Title')
Pendapatan
@endsection

@section('Main')
<br><br>
@if (Session::get('Level') == 'Mitra')
<div class="grid grid-cols-3">
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl"><img src="{{ asset('foot-produk/'.$Pendapatan->gambar) }}" height="100%" width="100%" class="mb-5"></div>
    </div>
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl">
            <p style="font-size:30px;" class="text-[#000000] text-lg mb-5"><b>{{ $Pendapatan->nama_produk }}</b></p>
            <p style="font-size:14px;" class="text-justify">Jumlah Pemesanan: <b>{{ $Pendapatan->jumlah_transaksi}}</b></p>
            <p style="font-size:14px;" class="text-justify">Harga: <b>Rp. {{number_format($Pendapatan->harga)}}</b></p>
            <p style="font-size:14px;" class="text-justify">Ongkos Kirim: <b>Rp. {{number_format($Pendapatan->harga_ongkir)}}</b></p>
            <p style="font-size:14px;" class="text-justify">Metode Pembayaran: <b>{{ $Pendapatan->metode_pembayaran}}</b></p><br><br>
            <p>Total Pembayaran</p>
            <p style="font-size:24px;" class="text-[#017707] text-lg mb-10"><b>Rp {{number_format($total_pembayaran)}}</b></p>
        </div>
    </div>
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl">
            <p style="font-size:24;" class="text-[#000000] text-lg mb-5">Pembeli: <b>{{ $Pendapatan->nama }}</b></p>
            <p style="font-size:14px;" class="text-justify">No HP: <b>{{ $Pendapatan->no_telp }}</b></p>
            <p style="font-size:14px;" class="text-justify">Alamat: <b>{{$Pendapatan->alamat}}</b>, Desa <b>{{$Pendapatan->desa}}</b>, Kecamatan <b>{{$Pendapatan->kecamatan}}</b></p>
        </div>
    </div>
</div>
@endif
@endsection