@extends('Index2')

@section('Title')
Ongkir
@endsection

@section('Main')
<a href="{{ route('TambahOngkir') }}" class="float-right font-normal text-sm px-3 py-2 rounded-full bg-[#519259] text-white">Tambah Ongkir</a>
<div class="px-3 py-2 rounded-xl border mt-3 mb-7 w-[50%]">
</div>

@foreach ($Ongkir as $dt)
<div class="grid grid-cols-2 gap-1 px-12 py-5 rounded-xl border mb-3">
    <div>
        <p style="font-size:20px;"><b>{{ $dt->kecamatan }}</b></p>
        <p>Rp. {{ number_format($dt->harga_ongkir) }}</p>
    </div>
    <div><a href="{{ url('DetailOngkir'.'/'.$dt->id) }}" class="px-5 py-1 rounded-full border">LIHAT DETAIL</a></div>
</div>
@endforeach
@endsection