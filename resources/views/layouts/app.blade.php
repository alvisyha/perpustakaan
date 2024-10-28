<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" integrity="sha256-R91pD48xW+oHbpJYGn5xR0Q7tMhH4xOrWn1QqMRINtA=" crossorigin="anonymous">
    <title>Perpustakaan Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* .nav {
                box-shadow: 4px 4px 50px rgba(145, 145, 145, 0.2);
                padding-bottom: 20px !important;
                padding-top: 20px !important;
                background: white;
                width: 100%;
            }

            .navbar-nav > li{
                margin-left: 30px;
            }

            .header {
                box-shadow: 4px 4px 50px rgba(145, 145, 145, 0.2);
                padding-bottom: 20px !important;
                padding-top: 20px !important;
                background: white;
                width: 100%;
            } */
        input {
            border-radius: 4px;
            border: 1px solid grey;
            height: 40px;
            padding-left: 15px;
            width: 250px;
        }

        h4 {
            font-family: 'Dancing Script', cursive;
            font-size: 3rem;
        }

        p {
            font-family: 'Dancing Script', cursive;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>


    <!-- <div class="header text-center">
        <img width=80 src="https://smpn1jatinegara.sch.id/wp-content/uploads/2020/10/logo-kemdikbud-ori-300x300.png" alt="logo">
        <h4 class="text-center mt-4">SD Negeri 1 Wlahar</h4>
        <p class="text-center">Jalan Raya Wangon Utara</p>
    </div> -->
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a style="background: #0d6efd; border-radius: 10px; padding: 10px; padding-right: 16px; padding-left: 16px; color:white;" href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <img width=80 src="https://smpn1jatinegara.sch.id/wp-content/uploads/2020/10/logo-kemdikbud-ori-300x300.png" alt="logo">
                <span style="color: white; margin-left: 10px;" class="fs-4">Perpustakaan <br> SDN 2 Wlahar <br>
                    <p style="font-size: 14px; font-family: 'Inter">Jl. Desa Wlahar RT 01 RW 02. Kode Pos 53176</p>
                </span>
            </a>

            <ul class="nav nav-pills justify-content-center align-items-center">
                <!-- <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> -->
                <!-- <div class="input-group"> -->
                <!-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> -->
                <!-- <span id="eyePw" class="bi bi-eye-slash input-group-text" id="togglePassword" onclick="showPassword()"></span> -->
                <!-- </div> -->
                <li class="nav-item">
                    {{-- <form action="{{ route('login.custom') }}" method="post"> --}}
                    {{-- @csrf --}}
                    {{-- <input required placeholder="masukan email" type="text" name="email" id=""> --}}
                    {{-- <input required placeholder="masukan password" type="password" name="password" id=""> --}}
                    <a href="/login">
                        <button name="login" id="login" type="submit" class="btn btn-primary mb-1">Login</button>
                    </a>
                    {{-- </form> --}}
                </li>
            </ul>
        </header>
    </div>


    <main class="">
        @yield('content')
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js" integrity="sha256-Hgwq1OBpJ276HUP9H3VJkSv9ZCGRGQN+JldPJ8pNcUM=" crossorigin="anonymous"></script>
    <script>
        toastr.options = {
            "debug": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000
        }
        @if($message = Session::get('success'))
        toastr.success("{{ $message }}")
        @endif

        @if(Session::has('error'))
        toastr.error("{{ session('error') }}");
        @endif
    </script>
</body>

</html>