@extends('layouts.app')

@section('content')
<div class="container pt-5">
  {{-- {{dd($books);}} --}}
  <div class="row justify-content-between align-items-center mt-3">
    <div class="col-md-3"></div>
    <div class="col-md-6 justify-content-center">
      <a href="/">
        < Kembali</a>
          <h2>{{$books[0]['title']}}</h2>
          <div class="card" style="border-radius: 10px">
            <img style="border-radius: 10px" src="{{ $books[0]['cover_image']}}" alt="">
          </div>
          <table class="card mt-3 table table-striped">
            <thead>
              <tr>
                <th scope="row">Penulis</th>
                <td scope="row">{{$books[0]['author']}}</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Penerbit</th>
                <td scope="row">{{$books[0]['publisher']}}</td>
              </tr>
              <tr>
                <th scope="row">Total Halaman</th>
                <td scope="row">{{$books[0]['total_pages']}}</td>
              </tr>
              <tr>
                <th scope="row">Stok</th>
                <td scope="row">{{$books[0]['stock']}}</td>
              </tr>
              <tr>
                <th scope="row">Kategori</th>
                <td scope="row">{{$books[0]['category']}}</td>
              </tr>
              <tr>
                <th scope="row">Deskripsi</th>
                <td scope="row">{{$books[0]['description']}}</td>
              </tr>
            </tbody>
          </table>
    </div>
    <div class="col-md-3"></div>

  </div>
</div>
@endsection