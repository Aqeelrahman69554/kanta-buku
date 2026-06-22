<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $categories = Category::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();

        $books = Book::with(['publisher', 'category'])
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('isbn', 'like', "%{$search}%")
                        ->orWhere('call_number', 'like', "%{$search}%")
                        ->orWhere('author','like',"%{$search}%")
                        ->orWhereHas('publisher', function ($publisher) use ($search) {
                            $publisher->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('category', function ($category) use ($search) {
                            $category->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.pages._book_rows', compact('books'))->render(),
                'pagination' => view('admin.pages._book_pagination', [
                    'bookItems' => $books,
                ])->render(),
            ]);
        }

        return view('admin.pages._book', compact('books', 'categories', 'publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Book::create($this->validatedBook($request));

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with(['author', 'publisher', 'category'])->findOrFail($id);

        return view('admin.pages._book-show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);

        return view('admin.pages._book-edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);
        $book->update($this->validatedBook($request));

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }

    private function validatedBook(Request $request): array
    {
        return $request->validate([
            'cover_image' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string','max:255'],
            'publisher_id' => ['required', 'exists:publishers,id'],
            'publish_year' => ['required', 'integer', 'digits:4'],
            'language' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'call_number' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:255'],
            'pages' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'edition' => ['nullable', 'string', 'max:255'],
            'stock' => ['required', 'string', 'max:255'],
        ]);
    }
}
