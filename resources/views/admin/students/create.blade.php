@extends('layouts.master') @section('content')

<head>
    <div class="container pt-5">
        <div class="d-flex justify-content-between align-items-center">
            <div class="title">
                <a href="/dashboard/student-management" class="btn btn-outline-danger mb-3">
                    <- Kembali</a>
            </div>
        </div>
        <form method="POST" action="/dashboard/student-management/store" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input required type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN</label>
                            <input required type="text" name="nisn" class="form-control" id="nisn">
                        </div>
                        <div class="mb-3">
                            <label for="class" class="form-label">Kelas</label>
                            <div class="d-flex col-4">
                                <select name="class" id="type-class" class="px-1 me-2 rounded form-control" required>
                                    <option value="">Pilih Kelas</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>

                                </select>
                                {{-- <input required type="text" name="type-class" class="form-control" id="class"> --}}
                            </div>
                        </div>
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