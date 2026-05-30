@extends('admin.layouts.master')

@section('content')
<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- Heading -->
        <div class="page-heading d-flex justify-content-between align-items-center mb-4">
            <div class="page-heading-copy">
                <span class="page-icon">
                    <i class="bi bi-bookmark-fill"></i>
                </span>
                <div>
                    <p class="eyebrow mb-1">Master Data</p>
                    <h1 class="h3 mb-1">Kategori Buku</h1>
                    <p class="text-muted mb-0">
                        Kelola seluruh kategori buku perpustakaan.
                    </p>
                </div>
            </div>

            <!-- Button Add -->
            <button
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#createCategoryModal">
                <i class="bi bi-plus-circle"></i>
                Tambah Kategori
            </button>
        </div>

        <!-- Table Card -->
        <section class="panel">
            <div class="panel-header d-flex justify-content-between align-items-center">

                <div>
                    <h2 class="h5 mb-1 section-title">
                        <i class="bi bi-table"></i>
                        <span>Daftar Kategori</span>
                    </h2>
                    <p class="text-muted mb-0">
                        Data kategori buku yang tersedia.
                    </p>
                </div>

                <input
                    class="form-control form-control-sm table-search"
                    type="search"
                    placeholder="Cari kategori..."
                    data-table-search="categoryTable">
            </div>

            <div class="table-responsive">
                <table
                    class="table align-middle mb-0"
                    id="categoryTable">

                    <thead>
                        <tr>
                            <th width="80">#</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Dibuat</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        {{-- Loop Laravel --}}
                        @foreach($categories as $category)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $category->name }}</strong>
                            </td>

                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $category->slug }}
                                </span>
                            </td>

                            <td>
                                {{ $category->created_at->format('d M Y') }}
                            </td>

                            <td class="text-end">

                                <!-- View -->
                                <button
                                    class="btn btn-sm btn-info text-white"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewCategory{{ $category->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>

                                <!-- Edit -->
                                <button
                                    class="btn btn-sm btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editCategory{{ $category->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <!-- Delete -->
                                <button
                                    class="btn btn-sm btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteCategory{{ $category->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                            </td>
                        </tr>

                        <!-- ========================= -->
                        <!-- VIEW MODAL -->
                        <!-- ========================= -->
                        <div class="modal fade"
                            id="viewCategory{{ $category->id }}"
                            tabindex="-1">

                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Detail Kategori
                                        </h5>

                                        <button
                                            class="btn-close"
                                            data-bs-dismiss="modal">
                                        </button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label class="fw-bold">
                                                Nama
                                            </label>

                                            <p>{{ $category->name }}</p>
                                        </div>

                                        <div class="mb-3">
                                            <label class="fw-bold">
                                                Slug
                                            </label>

                                            <p>{{ $category->slug }}</p>
                                        </div>

                                        <div>
                                            <label class="fw-bold">
                                                Dibuat
                                            </label>

                                            <p>
                                                {{ $category->created_at->format('d M Y H:i') }}
                                            </p>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- ========================= -->
                        <!-- EDIT MODAL -->
                        <!-- ========================= -->
                        <div class="modal fade"
                            id="editCategory{{ $category->id }}"
                            tabindex="-1">

                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form
                                        action="{{ route('categories.update',$category->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Edit Kategori
                                            </h5>

                                            <button
                                                class="btn-close"
                                                data-bs-dismiss="modal">
                                            </button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label>Nama Kategori</label>

                                                <input
                                                    type="text"
                                                    name="name"
                                                    class="form-control"
                                                    value="{{ $category->name }}"
                                                    required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Slug</label>

                                                <input
                                                    type="text"
                                                    name="slug"
                                                    class="form-control"
                                                    value="{{ $category->slug }}"
                                                    required>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal">
                                                Batal
                                            </button>

                                            <button
                                                type="submit"
                                                class="btn btn-warning">
                                                Update
                                            </button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- ========================= -->
                        <!-- DELETE MODAL -->
                        <!-- ========================= -->
                        <div class="modal fade"
                            id="deleteCategory{{ $category->id }}"
                            tabindex="-1">

                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form
                                        action="{{ route('categories.destroy',$category->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Hapus Kategori
                                            </h5>
                                        </div>

                                        <div class="modal-body">

                                            Yakin ingin menghapus kategori

                                            <strong>
                                                {{ $category->name }}
                                            </strong> ?

                                        </div>

                                        <div class="modal-footer">

                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal">
                                                Batal
                                            </button>

                                            <button
                                                type="submit"
                                                class="btn btn-danger">
                                                Hapus
                                            </button>

                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

<!-- ========================= -->
<!-- CREATE MODAL -->
<!-- ========================= -->
<div class="modal fade"
    id="createCategoryModal"
    tabindex="-1">

    <div class="modal-dialog">
        <div class="modal-content">

            <form
                action="{{ route('categories.store') }}"
                method="POST">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">
                        Tambah Kategori
                    </h5>

                    <button
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Nama Kategori</label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Slug</label>

                        <input
                            type="text"
                            name="slug"
                            class="form-control"
                            required>
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">
                        Simpan
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
@endsection
