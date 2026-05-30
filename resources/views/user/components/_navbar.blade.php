<nav class="navbar navbar-expand-lg user-navbar sticky-top">
    <div class="container py-2">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ url('/books') }}">
            <span class="brand-icon"><i class="bi bi-book-half" aria-hidden="true"></i></span>
            <span>KantaBuku</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar"
            aria-controls="userNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="userNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/books') }}">Katalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#kategori">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary btn-sm" href="{{ url('/') }}">Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
