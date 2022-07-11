@extends('Index2')

@section('Title')
    Produk
    @if (Session::get('Level') == 'Mitra')
    <a href="{{ route('Kecamatan') }}" class="float-right font-normal text-sm px-3 py-2 rounded-full bg-[#EEBA39] text-white">Panel Kecamatan</a>
    <a href="{{ route('Ongkir') }}" class="float-right font-normal text-sm px-3 py-2 rounded-full bg-[#EEBA39] text-white mr-5">Panel Ongkir</a><br><br>
    <a href="{{ route('TambahProduk') }}" class="float-right font-normal text-sm px-3 py-2 rounded-full bg-[#519259] text-white">Tambah Produk</a>
    @endif
@endsection

@section('Main')
<br>
<div class="grid grid-cols-4 gap-10 mt-10">
    @foreach ($Produk as $dt)
    <div class="bg-[#F4EEA9] w-full rounded-3xl overflow-hidden">
        <div class="bg-[url('foot-produk/{{ $dt->gambar }}')] bg-cover h-40 rounded-3xl overflow-hidden"></div>
        <p style="font-size:24px;" class="text-center text-[#064635] my-5"><a href="{{ url('LihatProduk'.'/'.$dt->id) }}">{{ $dt->nama_produk }}</a></p>
        <p class="text-center text-[#0AE617] my-5"><a href="{{ url('LihatProduk'.'/'.$dt->id) }}">Rp {{ number_format($dt->harga)}}</a></p>
        <p class="text-center text-[#064635] my-5"><a href="{{ url('LihatProduk'.'/'.$dt->id) }}">{{$dt->berat}} ml</a></p>
        @if (Session::get('Level') == 'Mitra')
        <div class="float-right mr-5 mb-5">
            <a href="#" class="text-[#262A53] hover:text-[#064635] font-bold text-xl ml-2" onclick="confirmDelete('{{ url('HapusProduk'.'/'.$dt->id) }}')"><i class="fa-solid fa-trash"></i></a>
            <a href="{{ url('EditProduk'.'/'.$dt->id) }}" class="text-[#262A53] hover:text-[#064635] font-bold text-xl ml-2"><i class="fa-solid fa-pen-to-square"></i></a>
        </div>
        @endif
    </div>
    @endforeach
</div>
@endsection

@section('Script')
<script>
    function confirmDelete(getLink) {
        Swal.fire({
            width: 350,
            icon: 'warning',
            text: 'Yakin Hapus Produk Ini ? ',
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