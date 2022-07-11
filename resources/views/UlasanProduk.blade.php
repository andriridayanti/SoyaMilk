@extends('Index2')

@section('Title')
Produk
@endsection

@section('Main')
<br><br>
<div class="grid grid-cols-2">
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl"><img src="{{ asset('foot-produk/'.$Produk->gambar) }}" height="100%" width="100%" class="mb-5"></div>
    </div>
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl">
            <p style="font-size:30px;" class="text-[#000000] text-lg mb-5"><b>{{ $Produk->nama_produk }}</b></p>
            <p style="font-size:14px;" class="text-justify">Varian : {{ $Produk->berat }} ml</p>
            <p style="font-size:24px;" class="text-[#017707] text-lg mb-10"><b>Rp {{number_format($Produk->harga)}}</b></p>
        </div>
        <div class="w-full px-3 py-2 rounded-xl">
            <div class="card mt-2">
                <div class="container-fluid">
                    @if(isset($bolehUlas))
                    <form action="/AuthUlasanProduk/{{$Produk->id}}" method="post">
                        @csrf
                        <div class="w-full">
                            <input type="hidden" name="produk_id" value="{{$Produk->id}}">
                            <input type="hidden" name="customer_id" value="{{$data->id}}">
                            <textarea class="w-full px-3 py-2 rounded-xl" name="deskripsi" rows="3" placeholder="Silahkan isi ulasan..." required></textarea>
                        </div>
                        <br><br>
                        <div class="text-center">
                            <button type="submit" class="float-center font-normal text-sm px-10 py-2 rounded-full bg-[#519259] text-white">Simpan</button>
                        </div>
                    </form>
                    @else
                    <div class="w-full px-3 py-2 rounded-xl">
                        <p style="font-size:24;" class="text-[#000000] text-lg text-center"><b>Tidak bisa memberikan Ulasan</b></p>
                        <p style="font-size:14px;" class="text-center mb-5">Silahkan melakukan transaksi pembelian terlebih dahulu!</p>
                        <div class="text-center">
                            <a href="/LihatProduk/{{$Produk->id}}" class="float-center font-normal text-sm px-10 py-2 rounded-full bg-[#519259] text-white">Kembali ke Halaman Pembelian</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br>
<b>Daftar Ulasan</b><br>
@foreach ($Ulasan as $dt)
<div class="grid grid-cols-3 gap-1 px-12 py-5 rounded-xl border mb-3">
    <div class="w-full">
        <p>{{ $dt->nama }}</p>
    </div>
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl">
            <p>{{ $dt->deskripsi }}</p>
        </div>
    </div>
</div>
@endforeach

@endsection