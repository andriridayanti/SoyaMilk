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
    <div class="w-full">
        <div class="w-full px-3 py-2 rounded-xl">
            <a href="#" class="text-[#262A53] hover:text-[#064635] font-bold text-xl ml-2" onclick="confirmDelete('{{ url('HapusUlasan'.'/'.$dt->id) }}')"><i class="fa-solid fa-trash"></i></a>
        </div>
    </div>
</div>
@endforeach

@endsection
@section('Script')
<script>
    function confirmDelete(getLink) {
        Swal.fire({
            width: 350,
            icon: 'warning',
            text: 'Yakin Hapus Ulasan Ini ? ',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(result => {
            if(result.isConfirmed){
                window.location.href = getLink
            }
        })
        return false;
    }
</script>
@endsection