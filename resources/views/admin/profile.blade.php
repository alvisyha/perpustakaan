@extends('layouts.master')

@section('content')
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
        <title>Perpustakaan Digital</title>
        <style>
            body {
                font-family: 'Inter', sans-serif;
                        }

            nav {
                box-shadow: 4px 4px 50px rgba(145, 145, 145, 0.2);
                padding-bottom: 20px !important;
                padding-top: 20px !important;
                z-index: 99 !important;
                background: white;
            }

            .navbar-nav > li{
                margin-left: 30px;
            }

            .title-text {
                font-family: 'Playfair Display', serif;
                font-size: 3rem;
            }
            .title-desc {
                color: #848484;
                font-size: 1.1em;
            }
        </style>
    </head>
    <div class="container col-4 pt-5">

        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="mb-3">
                        <label for="id" class="form-label">ID User</label>
                        <input type="text" class="form-control" id="id" value="{{ $user['id'] }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" id="fullName" value="{{ $user['name'] }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $user['email'] }}" disabled>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="phone" class="form-label">No HP</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="{{ $user['phone'] }}" disabled>
                    </div> -->
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" id="role" value="{{ $user['role'] }}" disabled>
                    </div>
                </form>
                <a href="/dashboard/profile/edit?id={{ $user['id'] }}"><button class="btn btn-outline-success">Edit</button></a>

            </div>
        </div>
    </div>
@endsection
