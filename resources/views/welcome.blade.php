@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-between align-items-center mt-3">
        <div class="col-md-6">
            <h2>Buku Paling Sering Dipinjam</h2>
            <div class="row">
                @foreach ($mostLoanedBook as $key=>$book)
                <div class="col-md-4 mt-4">
                    <div class="card" style="border-radius: 20px">
                        <img style="border-radius: 20px" height="200" src="{{ $book['cover_image']}}" alt="">
                    </div>
                    <div class="card-body">
                        <a href="/book/{{$book['title']}}">
                            <h5 class="mt-2">{{ $book['title']}}</h5>
                        </a>
                        <h6>Dipinjam sebanyak: {{ $book['loan_count'] }}</h6>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <form action="/search" method="GET">
                <div class="input-group mb-3 mt-2">
                    <input class="i-search" type="text" name="keyword" placeholder="Cari judul buku / penulis / penerbit" value="{{ request()->input('keyword') }}">
                    <input type="submit" class="btn btn-outline-secondary" value="Cari" style="border: 1px solid #D0D0D0;height: 50px !important; width: 70px;" />
                </div>
            </form>
            <h2>Cari Buku Favorit Kamu</h2>
            <p style="font-family: 'Inter'; font-size: 18px">Buku adalah jendela dunia <br> Semua buku terbaik ada disini. Yuk mulai baca sekarang</p>
            <br>
            <img width="60%" src="https://res.cloudinary.com/sarjanalidi/image/upload/v1697855383/illus_zeukdj.png" alt="">

        </div>
    </div>
    <div class="row justify-content-between mt-3">
        <div class="col-md-6">
            <h2>Buku Terbaru</h2>
            <div class="row">
                @foreach ($newBooks as $key=>$book)
                <div class="col-md-4 mt-4">
                    <div class="card" style="border-radius: 20px">
                        <img style="border-radius: 20px" height="200" src="{{ $book['cover_image']}}" alt="">
                    </div>
                    <div class="card-body">
                        <a href="/book/{{$book['title']}}">
                            <h5 class="mt-2">{{ $book['title']}}</h5>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <br><br>
            <h5 style="font-style: italic; line-height: 32px;">"Buku adalah cara unik manusia untuk memandang dunia. Buku menjelajahi semua bagian kehidupan, mengubah kehidupan, dan memungkinkan untuk melihat berbagai hal secara berbeda. Buku dapat mengubah hidupmu"</h5>
        </div>
    </div>
</div>
@endsection