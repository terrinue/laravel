<?php

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

use App\Book;
use Illuminate\Http\Request;

/**
* 本のダッシュボード表示(books.blade.php)
*/
Route::get('/', 'BooksController@index');

/**
* 新「本」を追加 
*/
Route::post('/books', 'BooksController@store'); 

/**
* 本を削除 
*/
Route::delete('/book/{book}', 'BooksController@delete'); 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//更新画面を開く
Route::post('/booksedit/{books}', 'BooksController@booksedit'); 

// 更新処理
Route::post('/books/update', 'BooksController@update');
