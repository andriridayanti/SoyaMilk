@extends('Index2')

@section('Title')
Kecamatan
@endsection

@section('Main')
<a href="{{ route('TambahKecamatan') }}" class="float-right font-normal text-sm px-3 py-2 rounded-full bg-[#519259] text-white">Tambah Kecamatan</a>
<div class="px-3 py-2 rounded-xl border mt-3 mb-7 w-[50%]">
</div>

@foreach ($Kecamatan as $dt)
<div class="grid grid-cols-2 gap-1 px-12 py-5 rounded-xl border mb-3">
    <div>
        <p>{{ $dt->kecamatan }}</p>
    </div>
    <div><a href="{{ url('DetailKecamatan'.'/'.$dt->id) }}" class="px-5 py-1 rounded-full border">LIHAT DETAIL</a></div>
</div>
@endforeach
@endsection