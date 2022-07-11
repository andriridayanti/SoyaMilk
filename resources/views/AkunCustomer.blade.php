@extends('Index2')

@section('Title')
    Akun Customer
@endsection

@section('Main')
    <div class="px-3 py-2 rounded-xl border mt-3 mb-7 w-[50%]">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="" id="" placeholder="Cari Customer....">
    </div>
    @foreach ($Customer as $dt)
        
    @endforeach
    <div class="grid grid-cols-4 gap-1 px-12 py-5 rounded-xl border mb-3">
        <div><p>{{ $dt->nama }}</p></div>
        <div><p>{{ $dt->email }}</p></div>
        <div><p>{{ $dt->alamat }}</p></div>
        <div><a href="{{ url('BiodataCustomer'.'/'.$dt->id) }}" class="px-5 py-1 rounded-full border">LIHAT DETAIL</a></div>
    </div>
@endsection