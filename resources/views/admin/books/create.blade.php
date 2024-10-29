@extends('layouts.master') @section('content')

<head>
    <div class="container pt-5">
        <div class="d-flex justify-content-between align-items-center">
            <div class="title">
                <a href="/dashboard/book-management" class="btn btn-outline-danger mb-3">
                    <- Kembali</a>
            </div>
        </div>
        <form method="POST" action="/dashboard/book-management/store" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Buku</label>
                            <input required type="text" name="title" class="form-control" id="title">
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok</label>
                            <input required type="text" name="stock" class="form-control" id="stock">
                        </div>
                        <div class="mb-3">
                            <label for="total_pages" class="form-label">Total Halaman</label>
                            <input required type="text" name="total_pages" class="form-control" id="total_pages">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea required style="height: 200px" type="text" name="description" class="form-control"
                                id="description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select required class="form-select" name="category" id="category">
                            <option value="">Pilih Kategori</option>
                            <option value="pelajaran">Buku Pelajaran</option>
                            <option value="fiksi">Buku Fiksi</option>
                            <option value="nonfiksi">Buku Non Fiksi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Penulis</label>
                        <input required type="text" name="author" class="form-control" id="author">
                    </div>
                    <div class="mb-3">
                        <label for="publisher" class="form-label">Penerbit</label>
                        <input required type="text" name="publisher" class="form-control" id="publisher">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input required type="file" name="image" class="form-control" id="image">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </div>
        </form>
    </div>
    @endsection