@extends('Index2')

@section('Title')
    Biodata Diri
@endsection

@section('Main')
<form action="{{ route('AuthBiodataDiri') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-2 gap-5 mt-10 justify-items-center px-20 py-10 rounded-3xl">
        <div class="w-full">
            <input type="text" name="nama" placeholder="Nama" class="w-full px-3 py-2 rounded-xl bg-[#F8F8F8]" value="{{ $Biodata->nama }}" required>
        </div>
        <div class="w-full">
            <input type="text" name="noTelp" placeholder="No Telpon" class="w-full px-3 py-2 rounded-xl bg-[#F8F8F8]" value="{{ $Biodata->no_telp }}" required>
        </div>
        <div class="w-full">
            <input type="text" name="email" placeholder="Email" class="w-full px-3 py-2 rounded-xl bg-[#F8F8F8]" value="{{ $Biodata->email }}" readonly>
        </div>
        <div class="w-full">
            <input type="password" name="password" placeholder="Password" class="w-full px-3 py-2 rounded-xl bg-[#F8F8F8]" value="{{ $Biodata->password }}" required>
        </div>
        <div class="w-full col-span-2">
            <input type="text" name="alamat" placeholder="Alamat" class="w-full px-3 py-2 rounded-xl bg-[#F8F8F8]" value="{{ $Biodata->alamat }}" required>
        </div>
        <div class="w-full">
            <input type="text" name="kecamatan" placeholder="Kecamatan" class="w-full px-3 py-2 rounded-xl bg-[#F8F8F8]" value="{{ $Biodata->kecamatan }}" required>
        </div>
        <div class="w-full">
            <input type="text" name="desa" placeholder="Desa" class="w-full px-3 py-2 rounded-xl bg-[#F8F8F8]" value="{{ $Biodata->desa }}" required>
        </div>
        <div class="w-full col-span-2">
            <center>
                <input type="radio" name="kelamin" id="kelamin1" value="Laki-Laki" <?php if ($Biodata->jenis_kelamin == 'Laki-Laki') { echo 'checked'; } ?>>
                <label for="kelamin1">Laki-Laki</label>
                <input type="radio" name="kelamin" id="kelamin2" value="Perempuan" class="ml-7" <?php if ($Biodata->jenis_kelamin == 'Perempuan') { echo 'checked'; } ?>>
                <label for="kelamin2">Perempuan</label>
            </center>
        </div>
    </div>
    <center>
        <button type="submit" class="font-normal text-sm px-3 py-2 rounded-full bg-[#519259] text-white">Ubah</button>
    </center>
</form>
@endsection