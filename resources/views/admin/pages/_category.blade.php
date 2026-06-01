@extends('admin.layouts.master')

@section('content') {{-- Perbaikan: Menggunakan @section --}}
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Manajemen Kategori Buku</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                + Tambah Kategori
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-bordered table-striped align-middle">
            <thead class="text-center">
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Nama Kategori</th>
                    <th>Slug</th>
                    <th style="width: 20%">Aksi</th> {{-- Judul kolom aksi ikut ke tengah --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <div class="text-center">
                            <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                        </div>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>

                        <td class="text-center"> {{-- 4. Tombol edit dan hapus di dalam td ini akan berjejer rapi di tengah --}}
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $category->id }}">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $category->id }}">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog"> {{-- Perbaikan: Ditambahkan div modal-dialog agar tidak merusak layout --}}
                            <div class="modal-content">
                                <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                                    {{-- Perbaikan: Menggunakan route tunggal .category.update --}}
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Kategori</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $category->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Slug</label>
                                            <input type="text" name="slug" class="form-control"
                                                value="{{ $category->slug }}" required>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST">
                                    {{-- Perbaikan: Menggunakan route tunggal .category.destroy --}}
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus kategori <strong>{{ $category->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-3">
            {{ $categories->links() }}
        </div>
    </div>

    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.category.store') }}" method="POST"> {{-- Perbaikan: Menggunakan route tunggal .category.store --}}
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kategori Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" name="name" class="form-control" placeholder="Contoh: Pemrograman"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" placeholder="contoh-pemrograman"
                                required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection {{-- Perbaikan: Menggunakan @endsection --}}
<script>
    // Tunggu sampai seluruh dokumen selesai dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen alert berdasarkan ID yang sudah kita buat tadi
        const successAlert = document.getElementById('success-alert');

        if (successAlert) {
            // Set waktu tunggu: 3000 milidetik = 3 detik
            setTimeout(function() {
                // Menggunakan class bawaan Bootstrap untuk transisi fade out (menghilang halus)
                successAlert.classList.remove('show');

                // Hapus elemen sepenuhnya dari layar setelah efek fade out selesai (opsional)
                setTimeout(function() {
                    successAlert.remove();
                }, 150); // 150ms adalah durasi standar animasi fade Bootstrap

            }, 4500);
        }
    });
</script>
