<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoyaMilk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/01ab9e1577.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
        * {
            cursor: url(https://cur.cursors-4u.net/cursors/cur-2/cur220.cur), auto !important;
        }
        body {
            font-family: 'Poppins', sans-serif;
        }
        #akun:checked ~ div.akun {
            @apply translate-y-[28rem];
        }
        #grid1 {
            width: 15rem;
            height: 6rem;
            @apply fixed transition-all duration-1000 bg-[#fcfbeb];
        }
        #grid2 {
            width: calc(100% - 15rem);
            height: 6rem;
            left: 15rem;
            @apply fixed transition-all duration-1000 bg-[#fcfbeb];
        }
        #grid3 {
            width: 15rem;
            height: calc(100% - 6rem);
            top: 6rem;
            @apply fixed transition-all duration-1000 bg-[#f6f7ff];
        }
        #grid4 {
            width: calc(100% - 15rem);
            height: calc(100% - 6rem);
            left: 15rem;
            top: 6rem;
            @apply fixed transition-all duration-1000 bg-[#f6f7ff];
        }
        ::-webkit-scrollbar {
            @apply w-3 h-3;
        }
        ::-webkit-scrollbar-track {     
            @apply bg-transparent; 
        }
        ::-webkit-scrollbar-thumb {
            @apply bg-[#F0BB62];
        }
    </style>
</head>
@if (Session::has('alertSuccess'))
<body onpageshow="alertSuccess()">
@elseif (Session::has('alertInfo'))
<body onpageshow="alertInfo()">
@elseif (Session::has('alertError'))
<body onpageshow="alertError()">
@else
<body>
@endif
    <input type="checkbox" id="akun" class="hidden">
    <div id="grid1">
        <div class="grid grid-cols-1 place-content-center h-full w-full">
            <center>
                <img src="{{ asset('img/logo.png') }}" alt="" class="h-full">
            </center>
        </div>
    </div>
    <div id="grid2">
        <label for="akun" class="px-3 py-2 font-medium text-[#064635] float-right m-6 text-lg"><i class="fa-solid fa-user text-xl"></i> Akun <i class="fa-solid fa-angle-down"></i></label>
    </div>
    <div id="grid3">
        <div class="grid grid-cols-1 place-content-center h-full mx-10 gap-10">
            <label for="" class="text-center text-[#064635] text-lg"><a href="{{ route('Beranda') }}"><i class="fa-solid fa-house text-xl"></i><br>Beranda</a></label>
            <label for="" class="text-center text-[#064635] text-lg"><a href="{{ route('Produk') }}"><i class="fa-solid fa-store text-xl"></i><br>Produk</a></label>
            <label for="" class="text-center text-[#064635] text-lg"><a href="/Pemesanan"><i class="fa-solid fa-cart-shopping text-xl"></i><br>Pemesanan</a></label>
            @if (Session::get('Level') == 'Mitra')
            <label for="" class="text-center text-[#064635] text-lg"><a href="/Keuangan"><i class="fa-solid fa-wallet text-xl"></i><br>Keuangan</a></label>
            @endif
        </div>
    </div>
    <div id="grid4">
        <div class="relative w-full h-full rounded-tl-3xl bg-white px-20 py-10 overflow-y-scroll">
            <h1 class="font-bold text-lg">@yield('Title')</h1>
            @yield('Main')
        </div>
    </div>
    <div class="akun fixed right-5 -top-96 transition duration-1000">
        <ul class="rounded-md shadow-lg overflow-hidden">
            @if (Session::get('Level') == 'Mitra')
            <a href="{{ route('BiodataDiri') }}">
                <li class="px-20 py-5 font-medium bg-white text-lg text-center hover:text-[#599013]">Pemilik Mitra</li>
            </a>
            <hr class="mx-auto w-[80%]">
            <a href="{{ route('AkunCustomer') }}">
                <li class="px-20 py-5 font-medium bg-white text-lg text-center hover:text-[#599013]">Customer</li>
            </a>
            <hr class="mx-auto w-[80%]">
            @else
            <a href="{{ route('BiodataDiri') }}">
                <li class="px-20 py-5 font-medium bg-white text-lg text-center hover:text-[#599013]">Kelola</li>
            </a>
            <hr class="mx-auto w-[80%]">
            @endif
            <a href="{{ route('Logout') }}">
                <li class="px-20 py-5 font-medium bg-white text-lg text-center hover:text-[#901313]">Keluar</li>
            </a>
        </ul>
    </div>
    @yield('Script')
    @php
    echo "
    <script>
        function alertSuccess() {
            Swal.fire({
                width: 350,
                icon: 'success',
                title: 'Sukses',
                text: '".Session::get('alertSuccess')."',
                showConfirmButton: false,
                timer: 3000
            });
        }
        function alertInfo() {
            Swal.fire({
                width: 350,
                icon: 'info',
                title: 'Info',
                text: '".Session::get('alertInfo')."',
                showConfirmButton: false,
                timer: 3000
            });
        }
        function alertError() {
            Swal.fire({
                width: 350,
                icon: 'error',
                title: 'Gagal',
                text: '".Session::get('alertError')."',
                showConfirmButton: false,
                timer: 3000
            });
        }
    </script>";
    @endphp
</body>
</html>