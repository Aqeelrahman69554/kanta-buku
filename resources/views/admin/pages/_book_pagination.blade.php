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
