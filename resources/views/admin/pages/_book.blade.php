@extends('admin.layouts.master')

@section('content')
    @php
        $bookItems = $books ?? collect();
        $authorItems = $authors ?? collect();
        $categoryItems = $categories ?? collect();
        $publisherItems = $publishers ?? collect();
    @endphp

    <style>
        .book-action {
            width: 36px;
            height: 36px;
            display: inline-grid;
            place-items: center;
            padding: 0;
        }

        .book-pagination .page-link {
            min-width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: .25rem .55rem;
            font-size: .875rem;
            line-height: 1;
        }
    </style>

    <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
            <div class="page-heading">
                <div class="page-heading-copy">
                    <span class="page-icon"><i class="bi bi-book" aria-hidden="true"></i></span>
                    <div>
                        <p class="eyebrow mb-1">Data Buku</p>
                        <h1 class="h3 mb-1">Daftar Buku</h1>
                        <p class="text-muted mb-0">Kelola data buku berdasarkan judul, kategori, penulis, dan stok.</p>
                    </div>
                </div>
                <div class="heading-actions">
                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal"
                        data-bs-target="#addBookModal">
                        <i class="bi bi-plus-lg" aria-hidden="true"></i>
                        Tambah
                    </button>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <section class="panel">
                <div class="panel-header align-items-start">
                    <div>
                        <h2 class="h5 mb-1 section-title">
                            <i class="bi bi-journal-text" aria-hidden="true"></i>
                            <span>Tabel Buku</span>
                        </h2>
                        <p class="text-muted mb-0">Gunakan filter kategori untuk menseleksi buku yang ditampilkan.</p>
                    </div>
                    <form class="d-flex flex-column flex-md-row gap-2" action="{{ route('daftarbuku') }}" method="GET">
                        <select class="form-select form-select-sm" name="category" aria-label="Filter kategori">
                            <option value="">Semua Kategori</option>
                            @foreach ($categoryItems as $category)
                                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <input class="form-control form-control-sm table-search" type="search" name="search"
                            value="{{ request('search') }}" placeholder="Cari buku" aria-label="Cari buku">
                        <button class="btn btn-outline-secondary btn-sm" type="submit" title="Filter">
                            <i class="bi bi-funnel" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0" id="booksTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th>Stok</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookItems as $book)
                                <tr>
                                    <td class="fw-semibold">
                                        {{ method_exists($bookItems, 'firstItem') ? $bookItems->firstItem() + $loop->index : $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="table-media">
                                            <span class="product-thumb d-inline-grid bg-light">
                                                <i class="bi bi-book-half" aria-hidden="true"></i>
                                            </span>
                                            <span>{{ $book->title }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge text-bg-primary">{{ $book->category->name ?? '-' }}</span>
                                    </td>
                                    <td>{{ $book->author->name ?? '-' }}</td>
                                    <td>{{ $book->publisher->name ?? '-' }}</td>
                                    <td>{{ $book->publish_year ?? '-' }}</td>
                                    <td>{{ $book->stock ?? '0' }}</td>
                                    <td class="text-end">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Aksi buku">
                                            <button class="btn btn-light book-action" type="button" data-bs-toggle="modal"
                                                data-bs-target="#viewBookModal{{ $book->id }}" title="View">
                                                <i class="bi bi-eye" aria-hidden="true"></i>
                                            </button>
                                            <button class="btn btn-light book-action" type="button" data-bs-toggle="modal"
                                                data-bs-target="#editBookModal{{ $book->id }}" title="Edit">
                                                <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                            </button>
                                            <button class="btn btn-light book-action text-danger" type="button"
                                                data-bs-toggle="modal" data-bs-target="#deleteBookModal{{ $book->id }}"
                                                title="Delete">
                                                <i class="bi bi-trash" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">Data buku belum tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (method_exists($bookItems, 'lastPage') && $bookItems->lastPage() > 1)
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mt-3">
                        <p class="text-muted small mb-0">
                            Menampilkan {{ $bookItems->firstItem() }} sampai {{ $bookItems->lastItem() }} dari
                            {{ $bookItems->total() }} buku
                        </p>
                        <nav aria-label="Pagination buku">
                            <ul class="pagination pagination-sm book-pagination mb-0">
                                <li class="page-item {{ $bookItems->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $bookItems->previousPageUrl() ?? '#' }}"
                                        aria-label="Previous">
                                        <i class="bi bi-chevron-left" aria-hidden="true"></i>
                                    </a>
                                </li>
                                @foreach ($bookItems->getUrlRange(1, $bookItems->lastPage()) as $page => $url)
                                    <li class="page-item {{ $bookItems->currentPage() === $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item {{ $bookItems->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $bookItems->nextPageUrl() ?? '#' }}" aria-label="Next">
                                        <i class="bi bi-chevron-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                @endif
            </section>
        </div>
    </main>

    <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <form class="modal-content" action="{{ route('admin.books.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h2 class="modal-title h5" id="addBookModalLabel">Tambah Buku</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('admin.pages._book_form', ['book' => null])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($bookItems as $book)
        <div class="modal fade" id="viewBookModal{{ $book->id }}" tabindex="-1"
            aria-labelledby="viewBookModalLabel{{ $book->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title h5" id="viewBookModalLabel{{ $book->id }}">{{ $book->title }}</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Kategori</dt>
                            <dd class="col-sm-8">{{ $book->category->name ?? '-' }}</dd>
                            <dt class="col-sm-4">Penulis</dt>
                            <dd class="col-sm-8">{{ $book->author->name ?? '-' }}</dd>
                            <dt class="col-sm-4">Penerbit</dt>
                            <dd class="col-sm-8">{{ $book->publisher->name ?? '-' }}</dd>
                            <dt class="col-sm-4">Tahun</dt>
                            <dd class="col-sm-8">{{ $book->publish_year ?? '-' }}</dd>
                            <dt class="col-sm-4">Bahasa</dt>
                            <dd class="col-sm-8">{{ $book->language ?? '-' }}</dd>
                            <dt class="col-sm-4">Lokasi</dt>
                            <dd class="col-sm-8">{{ $book->location ?? '-' }}</dd>
                            <dt class="col-sm-4">Call Number</dt>
                            <dd class="col-sm-8">{{ $book->call_number ?? '-' }}</dd>
                            <dt class="col-sm-4">ISBN</dt>
                            <dd class="col-sm-8">{{ $book->isbn ?? '-' }}</dd>
                            <dt class="col-sm-4">Halaman</dt>
                            <dd class="col-sm-8">{{ $book->pages ?? '-' }}</dd>
                            <dt class="col-sm-4">Edisi</dt>
                            <dd class="col-sm-8">{{ $book->edition ?? '-' }}</dd>
                            <dt class="col-sm-4">Stok</dt>
                            <dd class="col-sm-8">{{ $book->stock ?? '0' }}</dd>
                            <dt class="col-sm-4">Deskripsi</dt>
                            <dd class="col-sm-8">{{ $book->description ?? '-' }}</dd>
                        </dl>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editBookModal{{ $book->id }}" tabindex="-1"
            aria-labelledby="editBookModalLabel{{ $book->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <form class="modal-content" action="{{ route('admin.books.update', $book->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h2 class="modal-title h5" id="editBookModalLabel{{ $book->id }}">Edit Buku</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('admin.pages._book_form', ['book' => $book])
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="deleteBookModal{{ $book->id }}" tabindex="-1"
            aria-labelledby="deleteBookModalLabel{{ $book->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" action="{{ route('admin.books.destroy', $book->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h2 class="modal-title h5" id="deleteBookModalLabel{{ $book->id }}">Hapus Buku</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0">Yakin ingin menghapus buku <strong>{{ $book->title }}</strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
