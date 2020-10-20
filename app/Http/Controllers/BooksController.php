<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Validator;
use Auth;

class BooksController extends Controller
{
    /*
    * 初期表示
    */
    public function index(Request $request)
    {
        $books = Book::orderBy('created_at', 'asc')->get();
        return view('books', [
            'books' => $books
        ]);
    }

    /*
    * 本の削除 
    */
    public function delete(Book $book)
    {
        $book->delete(); 
        return redirect('/'); 
    }

    /*
    * 更新画面の表示 
    */
    public function booksedit(Book $books)
    {
        return view('booksedit',['book' => $books]);  
    }

    /*
    * 更新処理 
    */
    public function update(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
        'id' => 'required',
        'item_name' => 'required| min:3 | max:255',
        'item_number' => 'required| min:1 | max:3',
        'item_amount' => 'required| max:6',
        'published' => 'required',
        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }

        // Eloquentモデル
        $books = Book::find($request->id);
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save(); 
        return redirect('/');

        }

    /*
    * 本の追加
    */
    public function store(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
        'item_name' => 'required| min:3 | max:255',
        'item_number' => 'required| min:1 | max:3',
        'item_amount' => 'required| max:6',
        'published' => 'required',
    ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        // Eloquentモデル
        $books = new Book;
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save(); 
        return redirect('/');
    }
}
