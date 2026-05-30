<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        return view('user.pages.books');
    }
}
