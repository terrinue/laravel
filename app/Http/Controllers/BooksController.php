<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Validator;
use Auth;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
    * 初期表示
    */
    public function index()
    {
        $books = Book::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(3);
        $auths=Auth::user();
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
    public function booksedit($book_id)
    {
        $books = Book::where('user_id',Auth::user()->id)->find($book_id);
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
        $books = Book::where('user_id',Auth::user()->id)->find($request->id);
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

        $file=$request->file('item_img');

        if( !empty($file)) {
            $filename=$file->getClientOriginalName();

            $move= $file->move('./upload/',$filename);
        }else{
            $filename="";
        }

        // Eloquentモデル
        $books = new Book;
        $books->user_id = Auth::user()->id;
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->item_img = $filename;
        $books->published = $request->published;
        $books->save(); 
        return redirect('/');
    }
}
