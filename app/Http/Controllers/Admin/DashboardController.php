<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;


class DashboardController extends Controller
{
    public function index(){

    // menghitung semua jumlah buku
    $totalBooks = Book::count();
    $totalCategories = Category::count();
    $totalPublishers = Publisher::count();


    $latestBooks = Book::with(['category','publisher'])->latest()->take(5)->get();

    return view('admin.pages._dashboard', compact('totalBooks','totalCategories','totalPublishers','latestBooks'));
    }
}
