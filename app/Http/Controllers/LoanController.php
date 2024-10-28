<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Book;
use App\Models\Loan;
use App\Models\LoanItem;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('student', 'loan_items')->orderBy('updated_at', 'DESC')->paginate(8);

        foreach ($loans as $loan) {
            $currentTimestamp = time();
            $createdTimestamp = strtotime($loan['return_date']);
            $timeDifference = $createdTimestamp - $currentTimestamp;

            // dd($loan['status']);
            if ($loan['status'] == 'Sedang Dipinjam') {
                $days = floor($timeDifference / 86400);
                $timeDifference = $days . " hari ";
                if ($days < 0) {
                    $timeDifference = "Telat " . abs($days) . " hari "; // Memperbaiki tanda kurung abs()
                }

                $loan['selisih'] = $timeDifference;

                if ($loan['status'] == 'Telah Dikembalikan') {
                    $loan['selisih'] = '-';
                }

                if ($days < 0) {
                    $loan['denda'] = "Rp. " . number_format(abs($days) * count($loan['loan_items']) * 2000, 0, ',', '.');
                }
            } else {
                // Chane Variabel Return Date 
                //$createdTimestamp = strtotime($loan['returned_date']);
                $createdTimestamp = strtotime($loan['return_date']);
                $timeDifference = $createdTimestamp - $currentTimestamp;
                $days = floor($timeDifference / 86400);
                $timeDifference = $days . " hari ";
                if ($days < 0) {
                    $timeDifference = "Telat " . abs($days) . " hari ";
                }

                $loan['selisih'] = $timeDifference;

                if ($days < 0 && $loan['penalty_price']) {
                    $loan['denda'] = "Rp. " . $loan['penalty_price'];
                } else {
                    $loan['selisih'] = "";
                }
            }
        }

        return view('admin.loans.list', compact('loans'));
    }


    public function destroy(Request $request)
    {
        $student_id = $request->student_id;

        Student::find($student_id)->delete();
        return redirect('/dashboard/student-management');
    }

    public function create()
    {
        $students = Student::orderBy('name', 'ASC')->get();
        $books = Book::where('stock', '>', '0')->orderBy('title', 'ASC')->get();

        return view('admin.loans.create', compact('students', 'books'));
    }

    public function store(Request $request)
    {
        $today = Carbon::now();
        $dateAfter7Days = $today->addDays(7);
        foreach ($request->book_id as $bookId) {
            $book = Book::find($bookId);
            $loan = Loan::create([
                'student_id' => $request->student_id,
                'book_id' => $bookId,
                'status' => 'Sedang Dipinjam',
                'note' => $request->note,
                'return_date' => $dateAfter7Days->format('d-m-Y'),
            ]);

        }
        // $loan = Loan::create([
        //     'student_id' => $request->student_id,
        //     'book_id' => $request->book_id,
        //     'status' => 'Sedang Dipinjam',
        //     'note' => $request->note,
        //     'return_date' => $dateAfter7Days->format('d-m-Y'),
        //     //'return_date' => $request->return_date,
        //     //'returned_date' => $request->return_date,
        //     //'penalty_price' => "0"
        // ]);

        // dd($request->book_id );
      
        foreach ($request->book_id as $bookId) {
            $book = Book::find($bookId);
            $loan = LoanItem::create([
                'student_id' => $request->student_id,
                'book_id' => $bookId,
                'book_title' => $book->title,
                'loan_id' => $loan->id,
                'quantity' => '1'
            ]);

            $book->update(['stock' => $book->stock - 1]);
        }

        return redirect('/dashboard/loan-management');
    }

    public function edit(Request $request)
    {
        $loan_id = $request->loan_id;
        $loans = Loan::with('student')->where('id', '=', $loan_id)->first();
        $loan_items = LoanItem::with('book')->where('loan_id', '=', $loan_id)->get();

        return view('admin.loans.edit', compact('loans', 'loan_items'));
    }

    public function update(Request $request)
    {
        $student_id = $request->student_id;
        $input = $request->all();

        Student::find($student_id)->update($input);
        return redirect("/dashboard/student-management");
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $loans = Loan::with('student', 'loan_items')->paginate(8);
        $users = Student::orderBy('created_at', 'DESC')->where('name', 'LIKE', "%" . $keyword . "%")->get();
        $user_id = $users->pluck('id')->toArray();

        if ($keyword) {
            $loans = Loan::whereIn('student_id', $user_id)->with('student', 'loan_items')->paginate(8);
            foreach ($loans as $loan) {
                $currentTimestamp = time();
                $createdTimestamp = strtotime($loan['return_date']);
                $timeDifference = $createdTimestamp - $currentTimestamp;

                $days = floor($timeDifference / 86400);
                $timeDifference = $days . " hari ";
                if ($days < 0) {
                    $timeDifference =  "Telat " . abs($days) . " hari ";
                }

                $loan['selisih'] = $timeDifference;

                if ($loan['status'] == 'Telah Dikembalikan') {
                    $loan['selisih'] = '-';
                }
            }
        }

        return view('admin.loans.list', compact('loans'));
    }

    public function approve(Request $request)
    {
        $loan_id = $request->loan_id;
        $loans = Loan::where('id', '=', $loan_id)->get();
        $loan_items = LoanItem::where('loan_id', '=', $loan_id)->get();

        foreach ($loan_items as $loan_item) {
            $book = Book::find($loan_item->book_id);
            $book->update(['stock' => $book->stock + 1]);
        }

        $currentTimestamp = time();
        $createdTimestamp = strtotime($loans[0]['return_date']);
        $timeDifference = $createdTimestamp - $currentTimestamp;

        $days = floor($timeDifference / 86400);

        $loans[0]['denda'] = ($days < 0) ? abs($days) * count($loan_items) * 2000 : 0;

        // Pastikan denda bukan null sebelum pembaruan
        $denda = $loans[0]['denda'] ?? 0;

        // Update pinjaman
        Loan::find($loan_id)->update([
            'status' => 'Telah Dikembalikan',
            'updated_at' => now(),
            'return_date' => now()->format('Y-m-d'),
            //'penalty_price' => $denda
        ]);

        return redirect('/dashboard/loan-management');
    }

    public function download()
    {
        $data = Loan::with('student', 'loan_items')->orderBy('updated_at', 'DESC')->get();

        foreach ($data as $loan) {
            $currentTimestamp = time();
            $createdTimestamp = strtotime($loan['return_date'] ?? 'now');

            if ($createdTimestamp === false) {
                $days = 0; // Handle logic if needed
            } else {
                $timeDifference = $createdTimestamp - $currentTimestamp;
                $days = floor($timeDifference / 86400);
            }

            if ($loan['status'] === 'Telah Dikembalikan') {
                $loan['selisih'] = '-';
            } else {
                $loan['selisih'] = ($days < 0) ? "Telat " . abs($days) . " hari " : $days . " hari ";
            }
        }

        $list = [];
        foreach ($data as $loan) {
            // Convert loan_items to array before using array_map
            $ids = array_map(fn($item) => $item['book_title'], $loan['loan_items']->toArray());

            $list[] = [
                'nama peminjam' => $loan['student']['name'],
                'buku yang dipinjam' => implode(', ', $ids),
                'nisn' => $loan['student']['nisn'],
                'status' => $loan['status'],
                'jangka waktu' => $loan['selisih'],
                'tanggal pengembalian' => $loan['return_date']
            ];
        }

        return (new FastExcel($list))->download('report.xlsx');
    }
}