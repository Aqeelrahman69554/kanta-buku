@extends('admin.layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="mb-1">Pesan Masuk</h2>
                <p class="text-muted mb-0">Kelola dan respons semua pesan atau pertanyaan dari pengguna dengan cepat.</p>
            </div>
            <div style="width: 250px;">
                <input class="form-control" type="search" placeholder="Cari pesan..." data-table-search="ordersTable"
                    aria-label="Search">
            </div>
        </div>

        <table class="table table-bordered table-striped align-middle" id="ordersTable" data-searchable-table>
            <thead class="text-center">
                <tr>
                    <th style="width: 20%">Nama</th>
                    <th style="width: 20%">Email</th>
                    <th>Pesan</th>
                    <th style="width: 25%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $msg)
                    <tr>
                        <td class="fw-semibold">{{ $msg->name }}</td>
                        <td>{{ $msg->email }}</td>
                        <td>
                            {{ Str::limit($msg->pesan, 60, '...') }}
                        </td>
                        <td class="text-center">
                            <div class="gap-1">
                                <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal"
                                    data-bs-target="#viewModal{{ $msg->id }}">
                                    <i class="bi bi-eye"></i> Detail
                                </button>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#replyModal{{ $msg->id }}">
                                    <i class="bi bi-reply"></i> Balas
                                </button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $msg->id }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="viewModal{{ $msg->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Pesan Resmi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="fw-bold text-muted small d-block mb-1">PENGIRIM</label>
                                        <p class="mb-0 fw-semibold text-white">{{ $msg->name }} ({{ $msg->email }})</p>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <label class="fw-bold text-muted small d-block mb-1">ISI PESAN UTUH</label>
                                        <p class="mb-0 text-secondary" style="white-space: pre-line;">{{ $msg->pesan }}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="replyModal{{ $msg->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('admin.contact.reply', $msg->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Balas Pesan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label text-muted small fw-bold">Kepada:</label>
                                            <input type="text" class="form-control" value="{{ $msg->email }}"
                                                disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small fw-bold">Isi Balasan Pesan</label>
                                            <textarea class="form-control" name="reply_message" rows="4" placeholder="Tulis jawaban Anda di sini..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Kirim Balasan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteModal{{ $msg->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('admin.contact.destroy', $msg->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus pesan dari <strong>{{ $msg->name }}</strong>?
                                        Tindakan ini tidak bisa dibatalkan.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus Permanen</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-3">
            <div class="text-muted small">
                Menampilkan <strong>{{ $messages->firstItem() }}</strong> - <strong>{{ $messages->lastItem() }}</strong> dari
                <strong>{{ $messages->total() }}</strong> total pesan.
            </div>

            <div class="pagination-wrapper">
                {{ $messages->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <style>
        /* Menghilangkan seluruh elemen text penjelas bawaan nav Laravel di dalam wrapper */
        .pagination-wrapper nav div:first-child,
        .pagination-wrapper .small.text-muted,
        .pagination-wrapper p.text-muted {
            display: none !important;
        }

        /* Memastikan margin flex penentu pagination bawaan bersih */
        .pagination-wrapper flex-1 {
            display: none !important;
        }
    </style>
@endsection
