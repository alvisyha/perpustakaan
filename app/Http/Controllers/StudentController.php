<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;

class StudentController extends Controller
{

    public function index() {
        $students = Student::orderBy('name', 'ASC')->paginate(8);
        
          
          $tahunSekarang = Carbon::now()->year;
          //$tahunSekarang = 2025;
   
        foreach ($students as $student) {
          
            if($student['graduation'] > $tahunSekarang)
            {
              $student['status'] = 'Belum Lulus';
            } else {
              $student['status'] = 'Sudah Lulus';
            }

            
        }

       

        return view('admin.students.list', compact('students'));
    }

    public function destroy(Request $request) {
        $student_id = $request->student_id;

        Student::find($student_id)->delete();
        return redirect('/dashboard/student-management');
    }

    public function create() {
        return view('admin.students.create');
    }

    public function store(Request $request) {
        // $input = $request->all();

        // Student::create($input);
        // return redirect('/dashboard/student-management');

        $validated = $request->validate([
            'name' => 'required',
            'nisn' => 'required',
            'class' => 'required',
            'type-class' => 'required',
        ]);
        // Menghitung tahun kelulusan berdasarkan kelas
        $name = $validated['name'];
        $nisn = $validated['nisn'];
        $class = $validated['class'];
        $type_class = $validated['type-class'];

        $nowYear = Carbon::now()->year;
        $graduation = null;

        if($request->class == '10')
        {
            $graduation = $nowYear + 3;
        }elseif($request->class == '11')
        {
            $graduation = $nowYear + 2;
        }
        elseif($request->class == '12')
        {
            $graduation = $nowYear + 1;
        }

        Student::create([
            'name' => $name,
            'nisn' => $nisn,
            'class' => $class . $type_class ,
            'graduation' => $graduation,
        ]);    

        return redirect('/dashboard/student-management');    
    }

    public function deleteGraduated()
    {
       $tahunSekarang = Carbon::now()->year;
       //$tahunSekarang = 2025;


        // Menghapus siswa yang tahun kelulusannya sama dengan tahun sekarang
        Student::where('graduation','=' ,$tahunSekarang)->delete();
        return redirect("/dashboard/student-management");
    }

    public function edit(Request $request) {
        $student_id = $request->student_id;
        $student = Student::where('id', '=', $student_id)->first();

        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request) {
        $student_id = $request->student_id;
        $input = $request->all();

        Student::find($student_id)->update($input);
        return redirect("/dashboard/student-management");
    }

    public function search(Request $request) {
		$keyword = $request->keyword;
        $students = Student::paginate(8);

        if($keyword) {
            $students = Student::where('name', 'LIKE', "%".$keyword."%")->orWhere('nisn', 'LIKE', "%".$keyword."%")->paginate(8);
        }

        return view('admin.students.list', compact('students'));
	}

    public function import(Request $request) {
        $file = $request->file('file');
        // dd($file->getClientOriginalName());
        		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_siswa', $nama_file);

        $users = (new FastExcel)->import(public_path('/file_siswa/'.$nama_file), function ($line) {
            return Student::create([
                'name' => $line['nama'],
                'nisn' => $line['nisn'],
                'class' => $line['kelas']
            ]);
        });

        return redirect("/dashboard/student-management");
    }
}