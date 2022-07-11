@extends('Index')

@section('Grid1')
<div class="grid grid-cols-1 place-content-center h-full mx-40">
    <img src="{{ asset('img/petani2.png') }}" alt="">
</div>
@endsection

@section('Grid2')
<div class="h-full w-full bg-[#FFFCDA]">
    <form action="{{ route('AuthRegistrasi') }}" method="post" class="h-full">
        @csrf
        <div class="grid grid-cols-1 place-content-center h-full mx-40">
            <label for="" class="text-center font-bold text-lg mb-7">REGISTRASI</label>
            <input type="text" name="nama" placeholder="Nama" class="px-3 py-2 rounded-lg mb-4" required>
            <input type="text" name="email" placeholder="Email" class="px-3 py-2 rounded-lg mb-4" required>
            <input type="password" name="password" placeholder="Password" class="px-3 py-2 rounded-lg mb-4" required>
            <input type="text" name="noTelp" placeholder="No Telpon" class="px-3 py-2 rounded-lg mb-4" required>
            <input type="text" name="alamat" placeholder="Alamat" class="px-3 py-2 rounded-lg mb-4" required>
            <input type="text" name="kecamatan" placeholder="Kecamatan" class="px-3 py-2 rounded-lg mb-4" required>
            <input type="text" name="desa" placeholder="Desa" class="px-3 py-2 rounded-lg mb-4" required>
            <div class="text-center mb-7">
                <input type="radio" name="kelamin" id="kelamin1" value="Laki-Laki" checked>
                <label for="kelamin1">Laki-Laki</label>
                <input type="radio" name="kelamin" id="kelamin2" value="Perempuan" class="ml-7">
                <label for="kelamin2">Perempuan</label>
            </div>
            <div class="text-center">
                <button class="px-12 py-3 text-slate-50 bg-[#F0BB62] rounded-3xl mb-7">Registrasi</button>
            </div>
            <p class="text-sm text-center text-[#519259]">Sudah memiliki akun? <a href="{{ route('Login') }}"><b>Login</b></a></p>
        </div>
    </form>
</div>
@endsection