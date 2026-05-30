@extends('user.layouts.master')

@section('content')
    <section class="hero">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <p class="text-primary fw-semibold mb-2">Katalog Perpustakaan</p>
                    <h1 class="display-6 fw-bold mb-3">Selamat datang di KantaBuku.</h1>
                    <p class="lead text-muted mb-0">
                        Halaman user sudah siap. Bagian daftar buku bisa kamu isi nanti sesuai kebutuhan.
                    </p>
                </div>
                <div class="col-lg-5">
                    <div class="search-panel p-3">
                        <div class="d-flex align-items-center gap-3">
                            <span class="brand-icon"><i class="bi bi-book-half" aria-hidden="true"></i></span>
                            <div>
                                <h2 class="h5 mb-1">KantaBuku</h2>
                                <p class="text-muted mb-0">Area konten user.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
