@extends('admin.layouts.master')

@section('content')
    @php
        $bookItems = $books ?? collect();
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
            <div class="page-heading d-flex justify-content-between align-items-center mb-4">
                <div class="page-heading-copy d-flex align-items-center gap-3">
                    <span class="page-icon fs-3"><i class="bi bi-book" aria-hidden="true"></i></span>
                    <div>
                        <p class="eyebrow mb-1 text-uppercase fw-bold text-muted small">Data Buku</p>
                        <h1 class="h3 mb-1">Daftar Buku</h1>
                        <p class="text-muted mb-0">Kelola data buku berdasarkan judul, kategori, penulis, dan stok.</p>
                    </div>
                </div>
                <div class="heading-actions">
                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal"
                        data-bs-target="#addBookModal">
                        <i class="bi bi-plus-lg" aria-hidden="true"></i>
                        Tambah Buku
                    </button>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <section class="panel card border-0 shadow-sm p-4">
                <div
                    class="panel-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
                    <div>
                        <h2 class="h5 mb-1 section-title d-flex align-items-center gap-2">
                            <i class="bi bi-journal-text" aria-hidden="true"></i>
                            <span>Tabel Buku</span>
                        </h2>
                        <p class="text-muted small mb-0">Gunakan filter kategori atau pencarian untuk menyeleksi buku.</p>
                    </div>
                    <form class="d-flex gap-2 w-100 w-md-auto" action="{{ route('daftarbuku') }}" method="GET">
                        <select class="form-select form-select-sm" name="category" aria-label="Filter kategori">
                            <option value="">Semua Kategori</option>
                            @foreach ($categoryItems as $category)
                                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <input class="form-control form-control-sm" type="search" name="search"
                            value="{{ request('search') }}" placeholder="Cari buku..." aria-label="Cari buku">
                        <button class="btn btn-outline-secondary btn-sm" type="submit" title="Filter">
                            <i class="bi bi-funnel" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle mb-0" id="booksTable">
                        <thead class="table-dark text-center">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th style="width: 8%">Tahun</th>
                                <th style="width: 8%">Stok</th>
                                <th style="width: 15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookItems as $book)
                                <tr>
                                    <td class="fw-semibold text-center">
                                        {{ method_exists($bookItems, 'firstItem') ? $bookItems->firstItem() + $loop->index : $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="p-2 bg-light rounded text-secondary">
                                                <i class="bi bi-book-half" aria-hidden="true"></i>
                                            </span>
                                            <span class="fw-medium">{{ $book->title }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary">{{ $book->category->name ?? '-' }}</span>
                                    </td>
                                    <td>{{ $book->author}}</td>
                                    <td>{{ $book->publisher->name ?? '-' }}</td>
                                    <td class="text-center">{{ $book->publish_year ?? '-' }}</td>
                                    <td class="text-center fw-bold">{{ $book->stock ?? '0' }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Aksi buku">
                                            <button class="btn btn-outline-secondary book-action" type="button"
                                                data-bs-toggle="modal" data-bs-target="#viewBookModal{{ $book->id }}"
                                                title="Detail">
                                                <i class="bi bi-eye" aria-hidden="true"></i>
                                            </button>
                                            <button class="btn btn-outline-warning book-action" type="button"
                                                data-bs-toggle="modal" data-bs-target="#editBookModal{{ $book->id }}"
                                                title="Edit">
                                                <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                            </button>
                                            <button class="btn btn-outline-danger book-action" type="button"
                                                data-bs-toggle="modal" data-bs-target="#deleteBookModal{{ $book->id }}"
                                                title="Hapus">
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
                                    <a class="page-link" href="{{ $bookItems->nextPageUrl() ?? '#' }}"
                                        aria-label="Next">
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
                <div class="modal-header bg-primary text-white">
                    <h2 class="modal-title h5" id="addBookModalLabel"><i class="bi bi-plus-circle me-2"></i>Tambah Buku
                        Baru</h2>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Judul Buku</label>
                            <input type="text" name="title" class="form-control" placeholder="Masukkan judul buku"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categoryItems as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="author" class="form-label fw-semibold">Penulis</label>
                            <input type="text" name="author" id="author"
                                class="form-control @error('author') is-invalid @enderror"
                                placeholder="Masukkan nama penulis (contoh: Pramoedya Ananta Toer)"
                                value="{{ old('author') }}" required>
                            @error('author')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Penerbit</label>
                            <select name="publisher_id" class="form-select" required>
                                <option value="">Pilih Penerbit</option>
                                @foreach ($publisherItems as $publisher)
                                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Tahun Terbit</label>
                            <input type="number" name="publish_year" class="form-control" placeholder="Contoh: 2024">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Stok</label>
                            <input type="number" name="stock" class="form-control" value="0" min="0">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Bahasa</label>
                            <input type="text" name="language" class="form-control"
                                placeholder="Indonesia / Inggris">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Lokasi Rak</label>
                            <input type="text" name="location" class="form-control" placeholder="Contoh: Rak A1">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Call Number</label>
                            <input type="text" name="call_number" class="form-control" placeholder="Contoh: 813 UPT">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">ISBN</label>
                            <input type="text" name="isbn" class="form-control" placeholder="Masukkan nomor ISBN">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Jumlah Halaman</label>
                            <input type="number" name="pages" class="form-control" placeholder="Halaman">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Edisi</label>
                            <input type="text" name="edition" class="form-control"
                                placeholder="Contoh: Cetakan ke-1">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Buku</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($bookItems as $book)
        <div class="modal fade" id="viewBookModal{{ $book->id }}" tabindex="-1"
            aria-labelledby="viewBookModalLabel{{ $book->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h2 class="modal-title h5" id="viewBookModalLabel{{ $book->id }}"><i
                                class="bi bi-info-circle me-2"></i>Detail Informasi Buku</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-secondary py-2 mb-3 fw-bold fs-5 text-primary bg-white border">
                            <i class="bi bi-book me-2"></i>{{ $book->title }}
                        </div>
                        <dl class="row mb-0 g-2">
                            <dt class="col-sm-4 text-muted">Kategori</dt>
                            <dd class="col-sm-8 fw-semibold">: {{ $book->category->name ?? '-' }}</dd>
                            <dt class="col-sm-4 text-muted">Penulis</dt>
                            <dd class="col-sm-8">: {{ $book->author->name ?? '-' }}</dd>
                            <dt class="col-sm-4 text-muted">Penerbit</dt>
                            <dd class="col-sm-8">: {{ $book->publisher->name ?? '-' }}</dd>
                            <dt class="col-sm-4 text-muted">Tahun</dt>
                            <dd class="col-sm-8">: {{ $book->publish_year ?? '-' }}</dd>
                            <dt class="col-sm-4 text-muted">Bahasa</dt>
                            <dd class="col-sm-8">: {{ $book->language ?? '-' }}</dd>
                            <dt class="col-sm-4 text-muted">Lokasi</dt>
                            <dd class="col-sm-8">: {{ $book->location ?? '-' }}</dd>
                            <dt class="col-sm-4 text-muted">Call Number</dt>
                            <dd class="col-sm-8">: {{ $book->call_number ?? '-' }}</dd>
                            <dt class="col-sm-4 text-muted">ISBN</dt>
                            <dd class="col-sm-8">: {{ $book->isbn ?? '-' }}</dd>
                            <dt class="col-sm-4 text-muted">Halaman</dt>
                            <dd class="col-sm-8">: {{ $book->pages ?? '-' }} hlm</dd>
                            <dt class="col-sm-4 text-muted">Edisi</dt>
                            <dd class="col-sm-8">: {{ $book->edition ?? '-' }}</dd>
                            <dt class="col-sm-4 text-muted">Stok Tersedia</dt>
                            <dd class="col-sm-8 fw-bold text-success">: {{ $book->stock ?? '0' }} eks</dd>
                        </dl>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
                    <div class="modal-header bg-warning text-dark">
                        <h2 class="modal-title h5" id="editBookModalLabel{{ $book->id }}"><i
                                class="bi bi-pencil-square me-2"></i>Ubah Data Buku</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Judul Buku</label>
                                <input type="text" name="title" class="form-control" value="{{ $book->title }}"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kategori</label>
                                <select name="category_id" class="form-select" required>
                                    @foreach ($categoryItems as $category)
                                        <option value="{{ $category->id }}" @selected($book->category_id == $category->id)>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="author" class="form-label fw-semibold">Penulis</label>
                                <input type="text" name="author" id="author"
                                    class="form-control @error('author') is-invalid @enderror"
                                    placeholder="Masukkan nama penulis" value="{{ old('author', $book->author) }}"
                                    required>
                                @error('author')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Penerbit</label>
                                <select name="publisher_id" class="form-select" required>
                                    @foreach ($publisherItems as $publisher)
                                        <option value="{{ $publisher->id }}" @selected($book->publisher_id == $publisher->id)>
                                            {{ $publisher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Tahun Terbit</label>
                                <input type="number" name="publish_year" class="form-control"
                                    value="{{ $book->publish_year }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Stok</label>
                                <input type="number" name="stock" class="form-control" value="{{ $book->stock }}"
                                    min="0">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Bahasa</label>
                                <input type="text" name="language" class="form-control"
                                    value="{{ $book->language }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Lokasi Rak</label>
                                <input type="text" name="location" class="form-control"
                                    value="{{ $book->location }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Call Number</label>
                                <input type="text" name="call_number" class="form-control"
                                    value="{{ $book->call_number }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">ISBN</label>
                                <input type="text" name="isbn" class="form-control" value="{{ $book->isbn }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Jumlah Halaman</label>
                                <input type="number" name="pages" class="form-control" value="{{ $book->pages }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Edisi</label>
                                <input type="text" name="edition" class="form-control" value="{{ $book->edition }}">
                            </div>
                        </div>
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
            <div class="modal-dialog modal-dialog-centered">
                <form class="modal-content" action="{{ route('admin.books.destroy', $book->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header bg-danger text-white">
                        <h2 class="modal-title h5" id="deleteBookModalLabel{{ $book->id }}"><i
                                class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus</h2>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center py-4">
                        <i class="bi bi-trash text-danger display-4 d-block mb-3"></i>
                        <p class="mb-0 fs-5">Apakah Anda yakin ingin menghapus buku ini?</p>
                        <p class="text-muted fw-bold mt-2 mb-0">"{{ $book->title }}"</p>
                        <small class="text-danger d-block mt-2">*Tindakan ini tidak dapat dibatalkan</small>
                    </div>
                    <div class="modal-footer justify-content-center border-0">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(function() {
                    successAlert.classList.remove('show');
                    setTimeout(function() {
                        successAlert.remove();
                    }, 150);
                }, 7000); // Pesan sukses akan menghilang otomatis setelah 7 detik
            }
        });
    </script>
@endsection
