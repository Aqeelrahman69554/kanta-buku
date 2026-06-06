<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publisher;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $publishers = Publisher::latest()
        ->when($search, function($query,$search){
            return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            })
            ->paginate(5)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.pages._publisher_rows', compact('publishers'))->render()
            ]);
        }

        return view('admin.pages._publisher', compact('publishers'));
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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:publishers,name'],
            'city' =>['nullable','string','max:255'],
            ['name.unique' => 'nama penerbit ini sudah terdaftar.',]
        ]);

        Publisher::create($validated);
        return redirect()->route('admin.publishers.index')->with('success', 'penerbit baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $publisher = Publisher::findOrFail($id);
        return view('admin.pages._publisher', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $publisher = Publisher::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:publishers,name,' . $id],
            'city' =>['required','string','max:255'],
            ['name.unique' => 'Nama penerbit ini sudah digunakan',]
        ]);

        $publisher->update($validated);
        return redirect()
            ->route('admin.publishers.index')
            ->with('success', 'Nama penerbit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publisher = Publisher::findOrFail($id);

        if($publisher->books()->exists()){
            return redirect()
            ->route('admin.publishers.index')
            ->with('error','penerbit tidak dapat dihapus karena masih terikat dengan beberapa buku');
        }
        $publisher->delete();

        return redirect()
        ->route('admin.publishers.index')
        ->with('success', 'data penerbit berhasil dihapus');
    }
}
