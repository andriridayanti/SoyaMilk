@extends('Index2')

@section('Title')
    Artikel
@endsection

@section('Main')
<form action="{{ route('AuthTambahArtikel') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-2 gap-5 mt-10 justify-items-center bg-[#FFFCDA] px-20 py-10 rounded-3xl">
        <div class="w-full col-span-2">
            <input type="text" name="judul" placeholder="Judul" class="w-full px-3 py-2 rounded-xl" required>
        </div>
        <div class="w-full">
            <input type="text" name="penulis" placeholder="Penulis" class="w-full px-3 py-2 rounded-xl" required>
        </div>
        <div class="w-full">
            <input type="text" name="penerbit" placeholder="Penerbit" class="w-full px-3 py-2 rounded-xl" required>
        </div>
        <div class="w-full col-span-2">
            <textarea name="isi" placeholder="Isi" rows="2" class="w-full px-3 py-2 rounded-xl"></textarea>
        </div>
        <div class="w-full col-span-2">
            <input type="file" name="file" class="w-full px-3 py-2 rounded-xl bg-white" required>
        </div>
    </div>
    <button type="submit" class="float-right mt-5 ml-5 font-normal text-sm px-3 py-2 rounded-full bg-[#519259] text-white">Tambah</button>
    <a href="{{ route('Beranda') }}" class="float-right mt-5 ml-5 font-normal text-sm px-3 py-2 rounded-full bg-[#9F9F9F] text-white">Batal</a>
</form>
@endsection