@extends('Index2')

@section('Title')
Produk
@endsection

@section('Main')
<br><br>
@if (Session::get('Level') == 'Mitra')
<div class="grid grid-cols-2">
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl"><img src="{{ asset('foot-produk/'.$Produk->gambar) }}" height="100%" width="100%" class="mb-5"></div>
    </div>
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl">
            <p style="font-size:30px;" class="text-[#000000] text-lg mb-5"><b>{{ $Produk->nama_produk }}</b></p>
            <p style="font-size:14px;" class="text-justify">Varian : {{ $Produk->berat }} ml</p>
            <p style="font-size:14px;" class="text-justify">Stok : {{ $Produk->stok }}</p>
            <p style="font-size:24px;" class="text-[#017707] text-lg mb-10"><b>Rp {{number_format($Produk->harga)}}</b></p>
            <br><br><br><br><br>
            <p style="font-size:12px;" class="text-[#000000] text-lg"><i class="fa-solid fa-map-marker text-[#017707]"></i> Dikirim dari Jember</p>
            <p style="font-size:12px;" class="text-[#000000] text-lg"><i class="fa-solid fa-truck text-[#017707]"></i> Akan diterima -+ 30 menit</p>
        </div>
    </div>
</div>
@endif
@if (Session::get('Level') == 'Customer')
<div class="grid grid-cols-3">
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl"><img src="{{ asset('foot-produk/'.$Produk->gambar) }}" height="100%" width="100%" class="mb-5"></div>
    </div>
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl">
            <p style="font-size:30px;" class="text-[#000000] text-lg mb-5"><b>{{ $Produk->nama_produk }}</b></p>
            <p style="font-size:14px;" class="text-justify">Varian : {{ $Produk->berat }} ml</p>
            <p style="font-size:14px;" class="text-justify">Stok : {{ $Produk->stok }}</p>
            <p style="font-size:24px;" class="text-[#017707] text-lg mb-10"><b>Rp {{number_format($Produk->harga)}}</b></p>
            <br><br><br><br><br>
            <p style="font-size:12px;" class="text-[#000000] text-lg"><i class="fa-solid fa-map-marker text-[#017707]"></i> Dikirim dari Jember</p>
            <p style="font-size:12px;" class="text-[#000000] text-lg"><i class="fa-solid fa-truck text-[#017707]"></i> Akan diterima -+ 30 menit</p>
        </div>
    </div>
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl">
            <div class="card mt-2">
                <div class="container-fluid">
                    <b>Pilih Varian</b>
                    <br><br>
                    <b>Ukuran :</b>
                    <p class="text-justify" data-harga>{{ $Produk->berat }} ml</p>
                    <br><br><b>
                        Atur Jumlah Pembelian</b>
                    <form action="/AuthPemesananProduk/{{$Produk->id}}" method="post">
                        @csrf
                        <div class="w-full">
                            <input type="number" name="jumlah_pembelian" min="0" placeholder="Jumlah Pembelian" class="w-full px-3 py-2 rounded-xl" max="{{$Produk->stok}}" required><br><br><b>
                                Tanggal Pengiriman</b>
                            <input type="date" id="datefield" name="tanggal_pengantaran" placeholder="Jumlah Pembelian" class="w-full px-3 py-2 rounded-xl" min="1899-01-01" max="2000-13-13" required><br><br><b>
                                Metode Pembayaran</b>
                            <select class="form-select" name="metode_pembayaran" class="w-full px-3 py-2 rounded-xl" required>
                                <option value="">---Pilih Metode Pembayaran---</option>
                                <option value="cod">Cash on Delivery</option>
                            </select><br><br>
                            <b>Ongkos Kirim</b>
                            <select name="ongkir_id" class="w-full px-3 py-2 rounded-xl" required>
                                <option value="">---Pilih Ongkos Kirim---</option>
                                @foreach($Ongkir as $ong)
                                <option value="{{$ong->id}}">{{$ong->kecamatan}} - Rp. {{number_format($ong->harga_ongkir)}}</option>
                                @endforeach
                            </select><br><br>
                            <b>Catatan</b>
                            <textarea name="catatan" class="w-full px-3 py-2 rounded-xl" rows="3" placeholder="Tambahkan Catatan Pembelian"></textarea>
                        </div>
                        <br><br>
                        <input type="hidden" name="produk_id" value="{{$Produk->id}}">
                        <input type="hidden" name="customer_id" value="{{$data->id}}">
                        <input type="hidden" name="total_pembayaran" value="">
                        <input type="hidden" name="status" value="Belum Dikirim">
                        <div class="text-center">
                            <button type="submit" class="float-center font-normal text-sm px-10 py-2 rounded-full bg-[#519259] text-white">Beli</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<a href="/UlasanProduk/{{$Produk->id}}" class="float-center font-normal text-sm px-10 py-2 rounded-full bg-[#519259] text-white">Ulasan Produk</a>
<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("datefield").setAttribute("min", today);
</script>
@endsection