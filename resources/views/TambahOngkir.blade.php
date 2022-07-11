@extends('Index2')

@section('Title')
    Ongkir
@endsection

@section('Main')
<form action="{{ route('AuthTambahOngkir') }}" method="post">
    @csrf
    <div class="grid grid-cols-2 gap-5 mt-10 justify-items-center bg-[#FFFCDA] px-20 py-10 rounded-3xl">
        <div class="w-full col-span-2">
            <select name="kecamatan_id" class="w-full px-3 py-2 rounded-xl mb-5">
                <option value="">---Silahkan Pilih Kecamatan---</option>
                @foreach($Kecamatan as $dt)
                <option value="{{$dt->id}}">{{$dt->kecamatan}}</option>
                @endforeach
            </select>
            <input type="number" name="harga_ongkir" placeholder="Harga Ongkir" class="w-full px-3 py-2 rounded-xl" required>
        </div>
    <button type="submit" class="float-right mt-5 ml-5 font-normal text-sm px-3 py-2 rounded-full bg-[#519259] text-white">Tambah</button>
    <a href="{{ route('Beranda') }}" class="float-right mt-5 ml-5 font-normal text-sm px-3 py-2 rounded-full bg-[#9F9F9F] text-white">Batal</a>
</form>
@endsection