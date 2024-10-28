@extends('layouts.master')

@section('content')
    <div class="container pt-5">
        <div class="d-flex justify-content-between align-items-center">
            <div class="col-md-6">
                <form action="/dashboard/book-management/search" method="GET">
                    <div class="input-group mb-3 mt-2">
                        <input class="i-search" type="text" name="keyword" placeholder="Cari judul buku / penulis / penerbit" value="{{ request()->input('keyword') }}">
                        <input type="submit" class="btn btn-outline-secondary" value="Cari" style="border: 1px solid #D0D0D0;"/>
                    </div>
                </form>
            </div>
            <div>
            <a href="/dashboard/book-management/create"><button class="btn btn-success">Tambah Buku</button></a>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Jumlah Halaman</th>
                        <th scope="col">Stok</th>
                        <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $key=>$book)
                        <tr>
                            <td class="align-middle">{{ $book['title'] }}</td>
                            <td class="align-middle">{{ $book['author'] }}</td>
                            <td class="align-middle">{{ $book['publisher'] }}</td>
                            <td class="align-middle">{{ $book['total_pages'] }}</td>
                            <td class="align-middle">{{ $book['stock'] }}</td>
                            <td class="text-center">
                                <a href="/dashboard/book-management/delete/{{ $book['id'] }}"><button class="btn btn-danger">Delete</button></a>
                                <a href="/dashboard/book-management/{{ $book['id'] }}"><button class="btn btn-primary">Edit</button></a>
                            </td>
                        </tr>
                        @endforeach
                        @if(count($books) < 1) 
                        <tr>
                            <td colspan=8 class="text-center align-middle pt-5 pb-5"><h5>Buku Tidak Ditemukan</h5></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center" style="background: none;">
                {{$books->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>
@endsection
