@extends('Index2')

@section('Title')
    Produk
@endsection

@section('Main')
<form action="{{ route('AuthEditProduk') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" value="{{ $Produk->id }}" class="hidden">
    <div class="grid grid-cols-2 gap-5 mt-10 justify-items-center bg-[#FFFCDA] px-20 py-10 rounded-3xl">
        <div class="w-full col-span-2">
            <input type="text" name="nama_produk" placeholder="Nama Produk" class="w-full px-3 py-2 rounded-xl"  value="{{$Produk->nama_produk}}" required>
            <input type="hidden" name="mitra_id">
        </div>
        <div class="w-full col-span-2">
            <input type="number" name="harga" placeholder="Harga" class="w-full px-3 py-2 rounded-xl"  value="{{$Produk->harga}}" required>
        </div>
        <div class="w-full">
            <input type="number" name="berat" placeholder="Berat" class="w-full px-3 py-2 rounded-xl"  value="{{$Produk->berat}}" required>
        </div>
        <div class="w-full">
            <input type="number" name="stok" placeholder="Stok" class="w-full px-3 py-2 rounded-xl"  value="{{$Produk->stok}}" required>
        </div>
    </div>
    <button type="submit" class="float-right mt-5 ml-5 font-normal text-sm px-3 py-2 rounded-full bg-[#519259] text-white">Ubah</button>
    <a href="{{ route('Produk') }}" class="float-right mt-5 ml-5 font-normal text-sm px-3 py-2 rounded-full bg-[#9F9F9F] text-white">Batal</a>
</form>
@endsection