<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
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

// Route untuk table Category Book (Menggunakan nama akhir .categories.*)
Route::get('/admin/category', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
Route::post('/admin/category', [AdminCategoryController::class, 'store'])->name('admin.category.store');
Route::put('/admin/category/{category}', [AdminCategoryController::class, 'update'])->name('admin.category.update');
Route::delete('/admin/category/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.category.destroy');


//Route for user/frontend
Route::get('/books', [UserBookController::class, 'index']);
