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
        #grid1 {
            @apply absolute w-[50%] h-full left-0;
        }
        #grid2 {
            @apply absolute w-[50%] h-full right-0;
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
                <div id="grid1" class="bg-white">
                    <div class="absolute w-full grid grid-cols-5 gap-4 m-5">
                        <img src="{{ asset('img/logo.png') }}" alt="">
                        <div class="grid grid-cols-1 place-content-center"><a href="{{ route('Landing') }}">
                                <p>Beranda</p>
                            </a></div>
                        <div class="grid grid-cols-1 place-content-center"><a href="#">
                                <p>Produk</p>
                            </a></div>
                        <div class="grid grid-cols-1 place-content-center"><a href="#">
                                <p>Belanja</p>
                            </a></div>
                        <div class="grid grid-cols-1 place-content-center"><a href="#">
                                <p>Hubungi</p>
                            </a></div>
                    </div>
                    @yield('Grid1')
                </div>
                <div id="grid2" class="bg-white">
                    @yield('Grid2')
                </div>
                @yield('Main')
                @php
                echo "
                <script>
                    function alertSuccess() {
                        Swal.fire({
                            width: 350,
                            icon: 'success',
                            title: 'Sukses',
                            text: '".Session::get('
                            alertSuccess ')."',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }

                    function alertInfo() {
                        Swal.fire({
                            width: 350,
                            icon: 'info',
                            title: 'Info',
                            text: '".Session::get('
                            alertInfo ')."',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }

                    function alertError() {
                        Swal.fire({
                            width: 350,
                            icon: 'error',
                            title: 'Gagal',
                            text: '".Session::get('
                            alertError ')."',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                </script>";
                @endphp
            </body>

</html>