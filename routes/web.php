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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('library', 'LibraryController@index');
Route::get('library/{book_id}', 'LibraryController@lookBook');


Route::group(
    ['middleware' => 'auth'], // quiere decir que todas las rutas dentro de este archivo van a requerir loguearse
    function(){
        Route::resource('books', 'BooksController');
        Route::get('book_add_author/{book_id}', 'LibraryController@addAuthor');
        Route::post('book_add_author/{book_id}', 'BooksController@addAuthor');
        Route::delete('book_delete_author/{id}', 'BooksController@deleteAuthor');
        Route::get('book_add_theme/{book_id}', 'LibraryController@addTheme');
        Route::post('book_add_theme/{book_id}', 'BooksController@addTheme');
        Route::delete('book_delete_theme/{id}', 'BooksController@deleteTheme');
    }
);
