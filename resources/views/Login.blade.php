@extends('Index')

@section('Grid1')
<div class="grid grid-cols-1 place-content-center h-full mx-32">
    <img src="{{ asset('img/petani1.png') }}" alt="">
</div>
@endsection

@section('Grid2')
<div class="h-full w-full bg-[#FFFCDA]">
    <form action="{{ route('AuthLogin') }}" method="post" class="h-full">
        @csrf
        <div class="grid grid-cols-1 place-content-center h-full mx-40">
            <label for="" class="text-center font-bold text-lg mb-7">MASUK</label>
            <input type="text" name="email" placeholder="Username" class="px-3 py-2 rounded-lg mb-4" required>
            <input type="password" name="password" placeholder="Password" class="px-3 py-2 rounded-lg mb-7" required>
            <div class="text-center">
                <button class="px-12 py-3 text-slate-50 bg-[#F0BB62] rounded-3xl mb-7">Masuk</button>
            </div>
            <p class="text-sm text-center text-[#519259]">Belum memiliki akun? <a href="{{ route('Registrasi') }}"><b>Registrasi</b></a></p>
        </div>
    </form>
</div>
@endsection