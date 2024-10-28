<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('', [App\Http\Controllers\CustomAuthController::class, 'welcome'])->name('welcome');
Route::get('/book/{title}', [App\Http\Controllers\CustomAuthController::class, 'getDetail'])->name('getDetail');
Route::get('/search', [App\Http\Controllers\BookController::class, 'searchPublic'])->name('book-management');
Route::get('/login', [App\Http\Controllers\CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [App\Http\Controllers\CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::post('logout', [App\Http\Controllers\CustomAuthController::class, 'signOut'])->name('logout');

// admin route
// order management
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['role:admin']);

// book management
Route::get('/dashboard/book-management', [App\Http\Controllers\BookController::class, 'index'])->name('book-management')->middleware(['role:admin']);
Route::get('/dashboard/book-management/create', [App\Http\Controllers\BookController::class, 'create'])->name('book-management')->middleware(['role:admin']);
Route::post('/dashboard/book-management/store', [App\Http\Controllers\BookController::class, 'store'])->name('book-store')->middleware(['role:admin']);
Route::get('/dashboard/book-management/delete/{book_id}', [App\Http\Controllers\BookController::class, 'destroy'])->name('book-delete')->middleware(['role:admin']);
Route::get('/dashboard/book-management/search', [App\Http\Controllers\BookController::class, 'search'])->name('book-management')->middleware(['role:admin']);
Route::get('/dashboard/book-management/{book_id}', [App\Http\Controllers\BookController::class, 'edit'])->name('book-management')->middleware(['role:admin']);
Route::put('/dashboard/book-management/update/{book_id}', [App\Http\Controllers\BookController::class, 'update'])->name('book-management')->middleware(['role:admin']);

// user management
Route::get('/dashboard/student-management', [App\Http\Controllers\StudentController::class, 'index'])->name('student-management')->middleware(['role:admin']);
Route::post('/dashboard/student-management/import', [App\Http\Controllers\StudentController::class, 'import'])->name('student-management')->middleware(['role:admin']);
Route::get('/dashboard/student-management/create', [App\Http\Controllers\StudentController::class, 'create'])->name('student-management')->middleware(['role:admin']);
Route::post('/dashboard/student-management/store', [App\Http\Controllers\StudentController::class, 'store'])->name('student-store')->middleware(['role:admin']);
Route::get('/dashboard/student-management/delete/{student_id}', [App\Http\Controllers\StudentController::class, 'destroy'])->name('student-delete')->middleware(['role:admin']);
Route::get('/dashboard/student-management/deleteGraduated', [App\Http\Controllers\StudentController::class, 'deleteGraduated'])->name('deleteGraduated')->middleware(['role:admin']);
Route::get('/dashboard/student-management/search', [App\Http\Controllers\StudentController::class, 'search'])->name('student-management')->middleware(['role:admin']);
Route::get('/dashboard/student-management/{student_id}', [App\Http\Controllers\StudentController::class, 'edit'])->name('student-management')->middleware(['role:admin']);
Route::put('/dashboard/student-management/update/{student_id}', [App\Http\Controllers\StudentController::class, 'update'])->name('student-management')->middleware(['role:admin']);



// loan management
Route::get('/dashboard/loan-management', [App\Http\Controllers\LoanController::class, 'index'])->name('loan-management')->middleware(['role:admin']);
Route::get('/dashboard/loan-management/create', [App\Http\Controllers\LoanController::class, 'create'])->name('loan-management')->middleware(['role:admin']);
Route::post('/dashboard/loan-management/store', [App\Http\Controllers\LoanController::class, 'store'])->name('loan-store')->middleware(['role:admin']);
Route::get('/dashboard/loan-management/search', [App\Http\Controllers\LoanController::class, 'search'])->name('loan-management')->middleware(['role:admin']);
Route::get('/dashboard/loan-management/download', [App\Http\Controllers\LoanController::class, 'download'])->name('loan-management')->middleware(['role:admin']);
Route::get('/dashboard/loan-management/{loan_id}', [App\Http\Controllers\LoanController::class, 'edit'])->name('loan-management')->middleware(['role:admin']);
Route::put('/dashboard/loan-management/update/{loan_id}', [App\Http\Controllers\LoanController::class, 'update'])->name('loan-management')->middleware(['role:admin']);
Route::get('/dashboard/loan-management/approve/{loan_id}', [App\Http\Controllers\LoanController::class, 'approve'])->name('loan-approve')->middleware(['role:admin']);

// profile
Route::get('/dashboard/profile', [App\Http\Controllers\ProfileController::class, 'admin'])->name('profile-admin')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/profile/edit', [App\Http\Controllers\ProfileController::class, 'editProfile'])->name('profile-admin')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/profile/update/{user_id}', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('profile-admin')->middleware(['role:admin|karyawan']);