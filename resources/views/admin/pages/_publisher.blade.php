@extends('admin.layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="row align-items-center mb-3 g-3">
            <div class="col-md-4">
                <h2>Daftar Penerbit</h2>
            </div>
            <div class="col-md-8">
                <div class="d-flex flex-column flex-md-row gap-2 justify-content-md-end">
                    <form action="{{ route('admin.publishers.index') }}" method="GET" id="form-search" class="d-flex align-items-center bg-transparent m-0">
    <div class="input-group">
        <span class="input-group-text bg-transparent border-end-0">
            <i class="bi bi-search text-muted"></i>
        </span>
        <input type="text" name="search" id="input-search" class="form-control border-start-0"
               placeholder="Ketik untuk mencari..." value="{{ request('search') }}" autocomplete="off">
        @if(request('search'))
            <a href="{{ route('admin.publishers.index') }}" class="btn btn-outline-secondary" type="button">
                <i class="bi bi-x-circle"></i> Clear
            </a>
        @endif
    </div>
</form>

                    <button type="button" class="btn btn-primary text-nowrap" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="bi bi-plus-circle"></i> Tambah Penerbit
                    </button>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-sukses">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-error">
                <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="8%">No</th>
                            <th>Nama Penerbit</th>
                            <th>Kota</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-penerbit">
                        @include('admin.pages._publisher_rows')
                    </tbody>
                </table>
            </div>

            <div id="pagination-container" class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center py-3 px-4">
                {{ $publishers->links() }}
            </div>
        </div>
    </div>
    @foreach ($publishers as $pub)
        <div class="modal fade" id="modalEdit{{ $pub->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Penerbit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.publishers.update', $pub->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Penerbit</label>
                                <input type="text" name="name" class="form-control" value="{{ $pub->name }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <input type="text" name="city" class="form-control" value="{{ $pub->city }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalDelete{{ $pub->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        Apakah kamu yakin ingin menghapus penerbit <strong>{{ $pub->name }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('admin.publishers.destroy', $pub->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Penerbit Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.publishers.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Penerbit</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Masukkan nama penerbit" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kota</label>
                            <input type="text" name="city" class="form-control"
                                placeholder="Masukkan nama kota (opsional)">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <script>
        document.addEventListener("DOMContentLoaded", function() {
            // --- TIMER ALERT BERHASIL ---
            const alertSukses = document.getElementById('alert-sukses');
            if (alertSukses) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alertSukses);
                    bsAlert.close();
                }, 3000);
            }

            // --- AJAX LIVE SEARCH TANPA REFRESH ---
            const inputSearch = document.getElementById('input-search');
            const tabelPenerbit = document.getElementById('tabel-penerbit');
            const paginationContainer = document.getElementById('pagination-container');
            let timerPencarian;

            if (inputSearch) {
                inputSearch.addEventListener('input', function() {
                    clearTimeout(timerPencarian);

                    const keyword = this.value;

                    timerPencarian = setTimeout(function() {
                        // Lakukan request diam-diam ke server menggunakan Fetch API
                        fetch(`{{ route('admin.publishers.index') }}?search=${encodeURIComponent(keyword)}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            // 1. Ganti isi baris tabel secara instan
                            tabelPenerbit.innerHTML = data.html;

                            // 2. Ambil elemen pagination baru dari data JSON, pindahkan ke footer card
                            const newPagination = document.getElementById('ajax-pagination-data');
                            if (newPagination) {
                                paginationContainer.innerHTML = newPagination.innerHTML;
                            } else {
                                paginationContainer.innerHTML = '';
                            }
                        })
                        .catch(error => console.error('Error saat memuat data:', error));
                    }, 300); // 300ms jeda ketik (lebih responsif)
                });
            }
        });
    </script>
@endsection
