@extends('layouts.master')

@section('content')
<div class="container pt-5">

    <div class="d-flex justify-content-between align-items-center">
        <div class="col-md-6">
            <form action="/dashboard/student-management/search" method="GET">
                <div class="input-group mb-3 mt-2">
                    <input class="i-search" type="text" name="keyword" placeholder="Cari nama / nisn"
                        value="{{ request()->input('keyword') }}">
                    <input type="submit" class="btn btn-outline-secondary" value="Cari"
                        style="border: 1px solid #D0D0D0;" />
                </div>
            </form>
            <a href="/dashboard/student-management/create"><button class="btn btn-success">Tambah Siswa</button></a>
            <a href="/dashboard/student-management/deleteGraduated"><button class="btn btn-danger">Hapus Siswa yang
                    Telah
                    Lulus</button></a>

        </div>
        <div>
            <form method="post" action="/dashboard/student-management/import" enctype="multipart/form-data">
                @csrf

                <input required class="form-control" type="file" accept=".xls,.xlsx" id="file" name="file">
                <button type="submit" class=" mt-3 btn btn-outline-success">Import Excel</button>
            </form>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Status</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $key=>$student)
                    <tr>
                        <td class="align-middle">{{ $student['name'] }}</td>
                        <td class="align-middle">{{ $student['nisn'] }}</td>
                        <td class="align-middle">{{ $student['class'] }}</td>
                        <td class="align-middle">{{ $student['status'] }}</td>
                        <td class="text-center">
                            <a href="/dashboard/student-management/delete/{{ $student['id'] }}"><button
                                    class="btn btn-danger">Delete</button></a>
                            <a href="/dashboard/student-management/{{ $student['id'] }}"><button
                                    class="btn btn-primary">Edit</button></a>
                        </td>
                    </tr>
                    @endforeach
                    @if(count($students) < 1) <tr>
                        <td colspan=8 class="text-center align-middle pt-5 pb-5">
                            <h5>Siswa Tidak Ditemukan</h5>
                        </td>
                        </tr>
                        @endif
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center" style="background: none;">
            {{$students->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>
@endsection