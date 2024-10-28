<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css"
        integrity="sha256-R91pD48xW+oHbpJYGn5xR0Q7tMhH4xOrWn1QqMRINtA=" crossorigin="anonymous">
    <title>Perpustakaan Digital</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .nav:first-child {
            box-shadow: 4px 4px 50px rgba(145, 145, 145, 0.2);
            padding-bottom: 20px !important;
            padding-top: 10px !important;
            background: white;
        }

        .navbar-nav>li {
            margin-left: 30px;
        }

        .title-text {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: bold;
        }

        .title-desc {
            color: #848484;
            font-size: 1.1em;
        }

        .bordered {
            width: 100%;
            border: 0.3px solid #dadada !important;
            margin-bottom: 8px;
        }

        h5 {
            background: '#29291e';
            color: 'white';
        }
    </style>
</head>

<body>
    <nav class="nav navbar fixed-top navbar-expand-lg">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex flex-column flex-wrap collapse navbar-collapse" id="navbarText">
                @if (Route::has('login'))
                @auth
                <ul class="navbar-nav row mb-3">
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{ url('/dashboard') }}"><img width=80
                                src="https://smpn1jatinegara.sch.id/wp-content/uploads/2020/10/logo-kemdikbud-ori-300x300.png"
                                alt="logo"></a>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link">
                            <h5>SISTEM INFORMASI PERPUSTAKAAN SD NEGERI 2 WLAHAR</h5>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto bordered">
                    <li class="nav-item">
                        <!-- <a class="nav-link"><h5>SISTEM INFORMASI PERPUSTAKAAN SD NEGERI 2 WLAHAR</h5></a> -->
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('book-management') ? 'active' : ''}} "
                            aria-current="page" href="{{ url('/dashboard/book-management') }}">MANAJEMEN BUKU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('student-management') ? 'active' : ''}}"
                            href="/dashboard/student-management">MANAJEMEN SISWA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('loan-management') ? 'active' : ''}}"
                            href="/dashboard/loan-management">MANAJEMEN PEMINJAMAN</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('profile-admin') ? 'active' : ''}}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                            style="text-transform: uppercase;">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ request()->routeIs('profile-admin') ? 'active' : ''}}"
                                    href="/dashboard/profile">PROFIL</a></li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <form class="nav-link" id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input type="submit" value="KELUAR" class="dropdown-item">
                        </form>
                    </li>
                </ul>

                @else
                <div class="ms-auto">
                    <a style="text-decoration: none; margin-right: 20px; color: black;"
                        href="{{ url('/register') }}"><button class="btn-secondary">REGISTER</button></a>
                    <a href="{{ url('/login') }}"><button class="btn-primary-new">LOGIN</button></a>
                </div>
                @endauth
                @endif
            </div>
        </div>
    </nav>


    <main class="break-nav">
        @yield('content')
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"
        integrity="sha256-Hgwq1OBpJ276HUP9H3VJkSv9ZCGRGQN+JldPJ8pNcUM=" crossorigin="anonymous"></script>
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