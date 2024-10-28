@extends('layouts.master')
@section('content')
<div class="container pt-5">
    <div class="d-flex justify-content-between align-items-center">
        <div class="title">
            <a href="/dashboard/book-management" class="btn btn-outline-danger mb-3"> <- Kembali</a>
            <!-- <h1 class="title-text">Edit Buku</h1>
            <p class="title-desc mt-1">Mengedit Buku di SMPN 1 Nasional</p> -->
        </div>
    </div>
    <form method="POST" action="/dashboard/book-management/update/{{ $book->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Buku</label>
                        <input required type="text" name="title" class="form-control" id="title" value="{{ $book->title }}" >
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok</label>
                        <input required type="number" name="stock" class="form-control" id="stock" value="{{ $book->stock }}">
                    </div>
                    <div class="mb-3">
                        <label for="total_pages" class="form-label">Total Halaman</label>
                        <input required type="number" name="total_pages" class="form-control" id="total_pages" value="{{ $book->total_pages }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea required style="height: 200px" type="text" name="description" class="form-control" id="description">{{ $book->description }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <select required class="form-select" name="category" id="category">
                        <option value="">Pilih Kategori</option>
                        <option value="pelajaran" {{ $book->category == "pelajaran" ? "selected": "" }}>Buku Pelajaran</option>
                        <option value="fiksi" {{ $book->category == "fiksi" ? "selected": "" }}>Buku Fiksi</option>
                        <option value="nonfiksi" {{ $book->category == "nonfiksi" ? "selected": "" }}>Buku Non Fiksi</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Penulis</label>
                    <input required type="text" name="author" class="form-control" id="author" value="{{ $book->author }}">
                </div>
                <div class="mb-3">
                    <label for="publisher" class="form-label">Penerbit</label>
                    <input required type="text" name="publisher" class="form-control" id="publisher" value="{{ $book->publisher }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                    <img width="180px" src="{{ $book->cover_image }}" alt="cover image">
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <button type="submit" class="btn btn-success">Edit</button>
            </div>
        </div>
    </form>
</div>
@endsection