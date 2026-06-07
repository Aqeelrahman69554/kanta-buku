@extends('admin.layouts.master')

@section('content')
    <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">

            <div class="page-heading">
                <div class="page-heading-copy">
                    <span class="page-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
                    <div>
                        <p class="eyebrow mb-1">Overview</p>
                        <h1 class="h3 mb-1">Dashboard Admin</h1>
                        <p class="text-muted mb-0">
                            Ringkasan statistik data master dan katalog koleksi Kanta-buku.
                        </p>
                    </div>
                </div>
                <div class="heading-actions">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-file-earmark-plus" aria-hidden="true"></i>
                        Tambah Buku Baru
                    </a>
                </div>
            </div>

            <section class="row g-3 mt-1" aria-label="Dashboard metrics">

                <div class="col-12 col-sm-6 col-xl-4">
                    <article class="metric-card metric-primary">
                        <div class="metric-top">
                            <span class="metric-label">Total Koleksi Buku</span>
                            <span class="metric-icon"><i class="bi bi-book" aria-hidden="true"></i></span>
                        </div>
                        <div class="metric-value">{{ number_format($totalBooks) }}</div>
                        <div class="metric-meta">
                            <span>Judul buku terdaftar</span>
                        </div>
                    </article>
                </div>

                <div class="col-12 col-sm-6 col-xl-4">
                    <article class="metric-card metric-success">
                        <div class="metric-top">
                            <span class="metric-label">Kategori / Subjek</span>
                            <span class="metric-icon"><i class="bi bi-tags" aria-hidden="true"></i></span>
                        </div>
                        <div class="metric-value">{{ number_format($totalCategories) }}</div>
                        <div class="metric-meta">
                            <span>Klasifikasi topik bervariasi</span>
                        </div>
                    </article>
                </div>

                <div class="col-12 col-sm-6 col-xl-4">
                    <article class="metric-card metric-warning">
                        <div class="metric-top">
                            <span class="metric-label">Penerbit Buku</span>
                            <span class="metric-icon"><i class="bi bi-building" aria-hidden="true"></i></span>
                        </div>
                        <div class="metric-value">{{ number_format($totalPublishers) }}</div>
                        <div class="metric-meta">
                            <span>Mitra penerbit terintegrasi</span>
                        </div>
                    </article>
                </div>

            </section>

            <section class="row g-3 mt-1">

                <div class="col-12 col-xl-8">
                    <div class="panel h-100">
                        <div class="panel-header">
                            <div>
                                <h2 class="h5 mb-1 section-title">
                                    <i class="bi bi-journal-bookmark-fill" aria-hidden="true"></i><span>Koleksi Buku Terbaru</span>
                                </h2>
                                <p class="text-muted mb-0">
                                    Daftar judul buku yang baru saja ditambahkan ke dalam sistem OPAC.
                                </p>
                            </div>
                            <a class="btn btn-light btn-sm" href="{{ route('admin.books.index') }}">Lihat Semua Buku</a>
                        </div>

                        <div class="table-responsive px-3 pb-3">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Judul Buku</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Penerbit</th>
                                        <th scope="col" class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($latestBooks as $book)
                                        <tr>
                                            <td>
                                                <div class="fw-semibold text-truncate" style="max-width: 250px;">
                                                    {{ $book->title }}
                                                </div>
                                                <small class="text-muted">ISBN: {{ $book->isbn ?? '-' }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $book->category->name ?? 'Tanpa Kategori' }}</span>
                                            </td>
                                            <td>{{ $book->publisher->name ?? 'Tanpa Penerbit' }}</td>
                                            <td class="text-end">
                                                <a class="btn btn-light btn-sm" href="{{ route('admin.books.index') }}?search={{ urlencode($book->title) }}">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">Belum ada koleksi buku yang diinput.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="panel h-100">
                        <div class="panel-header">
                            <div>
                                <h2 class="h5 mb-1 section-title">
                                    <i class="bi bi-activity" aria-hidden="true"></i><span>Status Operasional</span>
                                </h2>
                                <p class="text-muted mb-0">
                                    Informasi status peladen katalog saat ini.
                                </p>
                            </div>
                        </div>

                        <div class="activity-list p-3">
                            <div class="activity-item pb-3">
                                <span class="activity-dot bg-success"></span>
                                <div>
                                    <p class="mb-1 fw-semibold">Sistem OPAC Aktif</p>
                                    <p class="text-muted small mb-0">Katalog dapat diakses publik dengan aman.</p>
                                </div>
                            </div>
                            <div class="activity-item pb-3">
                                <span class="activity-dot bg-primary"></span>
                                <div>
                                    <p class="mb-1 fw-semibold">Sinkronisasi Database</p>
                                    <p class="text-muted small mb-0">Data master terhubung stabil menggunakan MySQL.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </main>
@endsection
