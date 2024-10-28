@extends('layouts.master')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <div class="title">
            <a href="/dashboard/loan-management" class="btn btn-outline-danger mb-3">
                <- Kembali</a>
                    <!-- <h1 class="title-text">Edit Peminjaman</h1>
            <p class="title-desc mt-1">Mengedit Peminjaman di SMPN 1 Nasional</p> -->
        </div>
        <div>
            @if($loans['status'] == 'Sedang Dipinjam')
            <button disabled class="btn btn-outline-danger">{{$loans['status']}}</button>
            <a href="/dashboard/loan-management/approve/{{ $loans['id'] }}"><button class="btn btn-success">Telah
                    Dikembalikan</button></a>
            @else
            <a><button disabled class="btn btn-success">{{$loans['status']}}</button></a>
            @endif
        </div>
    </div>

    <form>
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="class" class="form-label">Nama Siswa</label>
                        <input required type="text" name="return_date" class="form-control" id="class"
                            value="{{$loans['student']['name']}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="class" class="form-label">Kelas</label>
                        <input required type="text" name="return_date" class="form-control" id="class"
                            value="{{$loans['student']['class']}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="class" class="form-label">NISN</label>
                        <input required type="text" name="return_date" class="form-control" id="class"
                            value="{{$loans['student']['nisn']}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="class" class="form-label">Tanggal Peminjaman</label>
                        <input required type="date" name="return_date" class="form-control" id="class"
                            value="{{ date('Y-m-d', strtotime($loans['created_at'])) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="class" class="form-label">Tanggal Pengembalian</label>
                        <input required type="date" name="return_date" class="form-control" id="class"
                            value="{{ date('Y-m-d', strtotime($loans['return_date'])) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="class" class="form-label">Catatan</label>
                        <input required type="text" name="note" class="form-control" id="class"
                            value="{{$loans['note']}}" disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <h3 class="fw-bold ">Daftar Buku Yang Dipinjam</h3>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Cover Buku</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loan_items as $key=>$loan_item)
                            <tr>
                                <td class="align-middle text-center">{{$key + 1}}</td>
                                <td class="align-middle">{{ $loans['book']['title'] }}</td>
                                <td class="align-middle"><img width="150px"
                                        src="{{ $loan_item['book']['cover_image'] }}" alt="cover image"></td>
                                <td class="align-middle">{{ $loans['status'] }}</td>
                            </tr>
                            @endforeach
                            @if(count($loan_items) < 1) <tr>
                                <td colspan=8 class="text-center align-middle pt-5 pb-5">
                                    <h5>Tidak Ada Peminjaman</h5>
                                </td>
                                </tr>
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection