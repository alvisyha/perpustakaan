@extends('layouts.master')

@section('content')
<div class="container pt-5">

    <div class="d-flex justify-content-between align-items-center">
        <div class="col-md-6">
            <form action="/dashboard/loan-management/search" method="GET">
                <div class="input-group mb-3 mt-2">
                    <input class="i-search" type="text" name="keyword" placeholder="Cari nama / nisn"
                        value="{{ request()->input('keyword') }}">
                    <input type="submit" class="btn btn-outline-secondary" value="Cari"
                        style="border: 1px solid #D0D0D0;" />
                </div>
            </form>
        </div>
        <div>
            <a href="/dashboard/loan-management/download"><button class="btn btn-primary">Download Excel</button></a>
            <a href="/dashboard/loan-management/create"><button class="btn btn-success">Tambah</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered mt-3" id="table">
                <thead>
                    <tr>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col" class="text-center">NISN</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Judul</th>
                        <th scope="col" class="text-center">Jangka Waktu</th>
                        <th scope="col" class="text-center">Denda</th>
                        <th scope="col" class="text-center">Tanggal Pengembalian</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $loan)
                    <tr>
                        <td class="align-middle">{{ $loan['student']['name'] }}</td>

                        <td class="align-middle text-center">{{ $loan['student']['nisn'] }}</td>
                        @if($loan['status'] == 'Telah Dikembalikan')
                        <td class="align-middle"><button disabled class="btn btn-outline-success">{{ $loan['status']
                                }}</button></td>
                        @else
                        <td class="align-middle"><button disabled class="btn btn-outline-danger">{{ $loan['status']
                                }}</button></td>
                        @endif
                        <td class="align-middle text-center">{{ $loan['book']['title']; }}</td>


                        <td id="loan-{{ $loan['id'] }}" class="align-middle text-center">{{ $loan['selisih'] }}</td>
                        <td class="align-middle text-center">{{ $loan['denda'] }}</td>
                        <td class="align-middle text-center">{{ $loan['return_date'] }}</td>
                        <td class="">
                            @if($loan['status'] == 'Sedang Dipinjam')
                            <a href="/dashboard/loan-management/{{ $loan['id'] }}"><button class="btn btn-primary">Lihat
                                    Detail</button></a>
                            <a href="/dashboard/loan-management/approve/{{ $loan['id'] }}"><button
                                    class="btn btn-danger">Kembalikan</button></a>
                            @else
                            <a href="/dashboard/loan-management/{{ $loan['id'] }}"><button class="btn btn-primary">Lihat
                                    Detail</button></a>
                            <button disabled class="btn btn-danger">Kembalikan</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @if(count($loans) < 1) <tr>
                        <td colspan=8 class="text-center align-middle pt-5 pb-5">
                            <h5>Tidak Ada Peminjaman</h5>
                        </td>
                        </tr>
                        @endif
                </tbody>
            </table>

        </div>
        <div class="d-flex justify-content-center" style="background: none;">
            {{$loans->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>
<script>
    // Get the reference to the table
        // const table = document.getElementById('table');

        // // Loop through each row of the table
        // for (let i = 0; i < table.rows.length; i++) {
        //     const row = table.rows[i];

        //     // Loop through each cell in the row
        //     for (let j = 0; j < row.cells.length; j++) {
        //         const cell = row.cells[3];
        //         // const createdDate = row.cells[4];

        //         const createdDate = new Date("2023-06-01T10:00:00"); // Contoh tanggal dan waktu yang telah dibuat
        //         // Menghitung selisih waktu dalam milidetik
        //         const currentDate = new Date();
        //         const timeDifference = currentDate.getTime() - createdDate.getTime();

        //         // Mengonversi selisih waktu ke dalam format yang diinginkan (misalnya, menit, jam, hari)
        //         const minutes = Math.floor(timeDifference / (1000 * 60));
        //         const hours = Math.floor(timeDifference / (1000 * 60 * 60));
        //         const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));

        //         console.log("Selisih waktu: ");
        //         if (days > 0) {
        //             cell.innerText = days + " hari "

        //             console.log(days + " hari ");
        //         }
        //         if (hours > 0) {
        //             console.log(hours % 24 + " jam ");
        //             cell.innerText = hours % 24 + " jam "

        //         }
        //         if (minutes > 0) {
        //             console.log(minutes % 60 + " menit ");
        //             cell.innerText = minutes % 60 + " menit "

        //         }
        //         console.log(timeDifference % 60 + " detik");
        //         cell.innerText = timeDifference % 60 + " detik"

        //         // Retrieve the data from the cell
        //         // const data = cell.innerText;
        //         // cell.innerText = "askdna"

        //         // Do something with the data
        //         // console.log(data);
        //     }
        // }
</script>
@endsection