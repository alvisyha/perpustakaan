<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        $books = Book::orderBy('title', 'ASC')->paginate(8);

        return view('admin.books.list', compact('books'));
    }

    public function destroy(Request $request) {
        $book_id = $request->book_id;

        Book::find($book_id)->delete();
        return redirect('/dashboard/book-management');
    }

    public function create() {
        return view('admin.books.create');
    }

    public function store(Request $request) {
        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['cover_image'] = "/images/$profileImage";
        }

        Book::create($input);
        return redirect('/dashboard/book-management');
    }

    public function edit(Request $request) {
        $book_id = $request->book_id;
        $book = Book::where('id', '=', $book_id)->first();

        return view('admin.books.edit', compact('book'));
    }


    public function update(Request $request) {
        $book_id = $request->book_id;
        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['cover_image'] = "/images/$profileImage";
        } else {
            unset($input['cover_image']);
        }

        Book::find($book_id)->update($input);
        return redirect("/dashboard/book-management");
    }

    public function search(Request $request) {
		$keyword = $request->keyword;
        $books = Book::paginate(8);

        if($keyword) {
            $books = Book::where('title', 'LIKE', "%".$keyword."%")->orWhere('author', 'LIKE', "%".$keyword."%")->orWhere('publisher', 'LIKE', "%".$keyword."%")->paginate(8);
        }

        return view('admin.books.list', compact('books'));
	}

    public function searchPublic(Request $request) {
		$keyword = $request->keyword;
        $books = Book::paginate(8);

        if($keyword) {
            $books = Book::where('title', 'LIKE', "%".$keyword."%")->orWhere('author', 'LIKE', "%".$keyword."%")->orWhere('publisher', 'LIKE', "%".$keyword."%")->paginate(8);
        }

        return view('search', compact('books'));
	}
}
