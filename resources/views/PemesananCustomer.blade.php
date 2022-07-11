@extends('Index2')

@section('Title')
Pemesanan
@endsection

@section('Main')
@foreach($Pemesanan as $data)
<div class="grid grid-cols-3 gap-1 px-12 py-5 rounded-xl border mb-3">
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl"><img src="{{ asset('foot-produk/'.$data->gambar) }}" height="40%" width="40%" class="mb-5"></div>
    </div>
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl">
            <p>{{ $data->nama_produk }}</p>
            <p>Varian : {{ $data->berat }} ml</p><p style="font-size:24px;" class="text-[#017707] text-lg mb-2"><b>Rp. {{ number_format($data->harga)}}</b></p>
            @if($data->status == 'Belum Dikirim')
            <p style="font-size:16px;" class="text-[#DA1006] text-lg mb-2"><b>{{$data->status}}</b></p>
            @elseif($data->status == 'Dikirim')
            <p style="font-size:16px;" class="text-[#0E4D99] text-lg mb-2"><b>Proses Pengiriman</b></p>
            @else($data->status == 'Selesai')
            <p style="font-size:16px;" class="text-[#16AC01] text-lg mb-2"><b>Telah Diterima</b></p>
            @endif
        </div>
    </div>
    <div><br><br><a href="{{ url('DetailPemesanan'.'/'.$data->id) }}" class="px-5 py-1 rounded-full border bg-[#519259]"><b>LIHAT DETAIL</b></a></div>
</div>
@endforeach
@endsection