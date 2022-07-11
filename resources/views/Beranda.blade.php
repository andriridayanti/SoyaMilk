@extends('Index2')

@section('Title')
    Artikel
    @if (Session::get('Level') == 'Mitra')
    <a href="{{ route('TambahArtikel') }}" class="float-right font-normal text-sm px-3 py-2 rounded-full bg-[#519259] text-white">Tambah Artikel</a>
    @endif
@endsection

@section('Main')
<div class="grid grid-cols-4 gap-10 mt-10">
    @foreach ($Artikel as $dt)
    <div class="bg-[#F4EEA9] w-full rounded-3xl overflow-hidden">
        <div class="bg-[url('artikel/{{ $dt->gambar }}')] bg-cover h-40 rounded-3xl overflow-hidden"></div>
        <p class="text-center text-[#064635] my-5"><a href="{{ url('LihatArtikel'.'/'.$dt->id) }}">{{ $dt->judul }}</a></p>
        @if (Session::get('Level') == 'Mitra')
        <div class="float-right mr-5 mb-5">
            <a href="#" class="text-[#262A53] hover:text-[#064635] font-bold text-xl ml-2" onclick="confirmDelete('{{ url('HapusArtikel'.'/'.$dt->id) }}')"><i class="fa-solid fa-trash"></i></a>
            <a href="{{ url('EditArtikel'.'/'.$dt->id) }}" class="text-[#262A53] hover:text-[#064635] font-bold text-xl ml-2"><i class="fa-solid fa-pen-to-square"></i></a>
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
            text: 'Yakin Hapus Artikel Ini ? ',
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