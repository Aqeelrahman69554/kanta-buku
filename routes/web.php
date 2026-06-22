<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\User\BookController as UserBookController;

Route::get('/', function () {
    return view('admin.layouts.master');
});
Route::get('/books', [UserBookController::class, 'index']);





Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::get('/books', [AdminBookController::class, 'index'])->name('books.index');


    //Route for table Daftar Buku
    Route::get('/books/create', [AdminBookController::class, 'create'])->name('books.create');
    Route::post('/books', [AdminBookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}', [AdminBookController::class, 'show'])->name('books.show');
    Route::get('/books/{book}/edit', [AdminBookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [AdminBookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [AdminBookController::class, 'destroy'])->name('books.destroy');

    // Route untuk table Category Book (Menggunakan nama akhir .categories.*)
    Route::get('/category', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::post('/category', [AdminCategoryController::class, 'store'])->name('category.store');
    Route::put('/category/{category}', [AdminCategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{category}', [AdminCategoryController::class, 'destroy'])->name('category.destroy');

    //Route untuk publisher
    Route::get('/publishers', [PublisherController::class, 'index'])->name('publishers.index');
    Route::post('/publishers', [PublisherController::class, 'store'])->name('publishers.store');
    Route::get('/publishers/{id}/edit', [PublisherController::class, 'edit'])->name('publishers.edit');
    Route::put('/publishers/{id}', [PublisherController::class, 'update'])->name('publishers.update');
    Route::delete('/publishers/{id}', [PublisherController::class, 'destroy'])->name('publishers.destroy');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact/{id}/reply', [ContactController::class, 'reply'])->name('contact.reply');
    Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');

    Route::get('/profile', function(){
        return view('admin.pages._profile');
    })->name('profile');
});


//Route for user/frontend
