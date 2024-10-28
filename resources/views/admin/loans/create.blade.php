@extends('layouts.master') @section('content')
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<div class="container pt-5 ">
    <div class="d-flex justify-content-between align-items-center">
        <div class="title">
            <a href="/dashboard/loan-management" class="btn btn-outline-danger mb-3">
                <- Kembali</a>
        </div>
    </div>
    <form method="POST" action="/dashboard/loan-management/store" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="name" class="form-label">Cari Nama Siswa</label>
                        <!-- <select class="form-select" aria-label="Default select example" name="student_id">
                            @foreach ($students as $student)
                                <option value="{{$student->id}}">{{$student->name}} ({{$student->nisn}})</option>
                            @endforeach
                        </select> -->
                        <br>
                        <select name="student_id" class="form-select selectpicker" aria-label="Default select example"
                            data-live-search="true">
                            @foreach ($students as $student)
                            <option value="{{$student->id}}">{{$student->name}} ({{$student->nisn}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3" hidden>
                        <label for="class" class="form-label">Tanggal Pengembalian</label>
                        <input type="date" name="return_date" class="form-control" id="class">
                    </div>
                    <div class="mb-3">
                        <label for="class" class="form-label">Catatan</label>
                        <input required type="text" name="note" class="form-control" id="class">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nisn" class="form-label">Cari Nama Buku</label>
                    <!-- <select class="form-select" aria-label="Default select example" name="book_id">
                    @foreach ($books as $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select> -->
                    <br>
                    <select id="mySelect" name="book_id[]" onchange="limitSelection(this)"
                        class="form-select selectpicker" multiple data-max-options="2" multiple
                        aria-label="Default select example" data-live-search="true">
                        @foreach ($books as $book)
                        <option value="{{$book->id}}">{{$book->title}} {{$book->id}}</option>
                        @endforeach
                    </select>
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
<script>
    $('.selectpicker').val({limit:2});
</script>
@endsection