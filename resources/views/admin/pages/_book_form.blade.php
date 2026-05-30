@php
    $bookData = $book ?? null;
@endphp

<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="title{{ $bookData->id ?? 'New' }}">Judul</label>
        <input class="form-control" id="title{{ $bookData->id ?? 'New' }}" name="title" type="text"
            value="{{ old('title', $bookData->title ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label" for="author{{ $bookData->id ?? 'New' }}">Penulis</label>
        <select class="form-select" id="author{{ $bookData->id ?? 'New' }}" name="author_id" required>
            <option value="">Pilih Penulis</option>
            @foreach ($authorItems as $author)
                <option value="{{ $author->id }}" @selected(old('author_id', $bookData->author_id ?? '') == $author->id)>
                    {{ $author->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label" for="publisher{{ $bookData->id ?? 'New' }}">Penerbit</label>
        <select class="form-select" id="publisher{{ $bookData->id ?? 'New' }}" name="publisher_id" required>
            <option value="">Pilih Penerbit</option>
            @foreach ($publisherItems as $publisher)
                <option value="{{ $publisher->id }}" @selected(old('publisher_id', $bookData->publisher_id ?? '') == $publisher->id)>
                    {{ $publisher->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label" for="category{{ $bookData->id ?? 'New' }}">Kategori</label>
        <select class="form-select" id="category{{ $bookData->id ?? 'New' }}" name="category_id" required>
            <option value="">Pilih Kategori</option>
            @foreach ($categoryItems as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $bookData->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label" for="publishYear{{ $bookData->id ?? 'New' }}">Tahun</label>
        <input class="form-control" id="publishYear{{ $bookData->id ?? 'New' }}" name="publish_year" type="number"
            value="{{ old('publish_year', $bookData->publish_year ?? '') }}" required>
    </div>

    <div class="col-md-3">
        <label class="form-label" for="language{{ $bookData->id ?? 'New' }}">Bahasa</label>
        <input class="form-control" id="language{{ $bookData->id ?? 'New' }}" name="language" type="text"
            value="{{ old('language', $bookData->language ?? '') }}" required>
    </div>

    <div class="col-md-3">
        <label class="form-label" for="location{{ $bookData->id ?? 'New' }}">Lokasi</label>
        <input class="form-control" id="location{{ $bookData->id ?? 'New' }}" name="location" type="text"
            value="{{ old('location', $bookData->location ?? '') }}" required>
    </div>

    <div class="col-md-3">
        <label class="form-label" for="stock{{ $bookData->id ?? 'New' }}">Stok</label>
        <input class="form-control" id="stock{{ $bookData->id ?? 'New' }}" name="stock" type="text"
            value="{{ old('stock', $bookData->stock ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label" for="callNumber{{ $bookData->id ?? 'New' }}">Call Number</label>
        <input class="form-control" id="callNumber{{ $bookData->id ?? 'New' }}" name="call_number" type="text"
            value="{{ old('call_number', $bookData->call_number ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label" for="isbn{{ $bookData->id ?? 'New' }}">ISBN</label>
        <input class="form-control" id="isbn{{ $bookData->id ?? 'New' }}" name="isbn" type="text"
            value="{{ old('isbn', $bookData->isbn ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label" for="pages{{ $bookData->id ?? 'New' }}">Halaman</label>
        <input class="form-control" id="pages{{ $bookData->id ?? 'New' }}" name="pages" type="text"
            value="{{ old('pages', $bookData->pages ?? '') }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label" for="edition{{ $bookData->id ?? 'New' }}">Edisi</label>
        <input class="form-control" id="edition{{ $bookData->id ?? 'New' }}" name="edition" type="text"
            value="{{ old('edition', $bookData->edition ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label" for="coverImage{{ $bookData->id ?? 'New' }}">Cover Image</label>
        <input class="form-control" id="coverImage{{ $bookData->id ?? 'New' }}" name="cover_image" type="text"
            value="{{ old('cover_image', $bookData->cover_image ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label" for="description{{ $bookData->id ?? 'New' }}">Deskripsi</label>
        <textarea class="form-control" id="description{{ $bookData->id ?? 'New' }}" name="description" rows="3">{{ old('description', $bookData->description ?? '') }}</textarea>
    </div>
</div>
