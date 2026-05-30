<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\User\BookController as UserBookController;

Route::get('/', function () {
    return view('admin.layouts.master');
});

Route::get('/dashboard',function(){
    return view('admin.pages._dashboard');
})->name('dashboard.admin');

//Route for table Daftar Buku
Route::get('/daftarbuku', [AdminBookController::class, 'index'])->name('daftarbuku');
Route::get('/admin/books/create', [AdminBookController::class, 'create'])->name('admin.books.create');
Route::post('/admin/books', [AdminBookController::class, 'store'])->name('admin.books.store');
Route::get('/admin/books/{book}', [AdminBookController::class, 'show'])->name('admin.books.show');
Route::get('/admin/books/{book}/edit', [AdminBookController::class, 'edit'])->name('admin.books.edit');
Route::put('/admin/books/{book}', [AdminBookController::class, 'update'])->name('admin.books.update');
Route::delete('/admin/books/{book}', [AdminBookController::class, 'destroy'])->name('admin.books.destroy');

// Route for tale Category Book
Route::get('/category', function(){
    return view('admin.pages._category');
})->name('admin.category');

//Route for user/frontend
Route::get('/books', [UserBookController::class, 'index']);
