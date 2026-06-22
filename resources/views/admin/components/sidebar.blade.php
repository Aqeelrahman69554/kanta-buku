<aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
    <div class="sidebar-header">
        <a class="brand-mark" href="index.html" aria-label="adminHMD dashboard">
            <span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
            <span class="brand-copy">
                <span class="brand-title">Admin KantaBuku📘</span>
                <span class="brand-subtitle">Admin</span>
            </span>
        </a>
    </div>

    <nav class="sidebar-nav">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            href="{{ route('admin.dashboard') }}" @if (request()->routeIs('admin.dashboard')) aria-current="page" @endif>
            <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
            <span class="nav-text">Dashboard</span>
        </a>

        <a class="nav-link {{ request()->routeIs('admin.categories.*', 'admin.category.*') ? 'active' : '' }}"
            href="{{ route('admin.categories.index') }}"
            @if (request()->routeIs('admin.categories.*', 'admin.category.*')) aria-current="page" @endif>
            <span class="nav-icon"><i class="bi bi-journals me-2" aria-hidden="true"></i></span>
            <span class="nav-text">Daftar Kategori</span>
        </a>
        <a class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}"
            href="{{ route('admin.books.index') }}" @if (request()->routeIs('admin.books.*')) aria-current="page" @endif>
            <span class="nav-icon"><i class="bi bi-book me-2" aria-hidden="true"></i></span>
            <span class="nav-text">Daftar Buku</span>
        </a>



        <a class="nav-link {{ request()->routeIs('admin.publishers.*') ? 'active' : '' }}"
            href="{{ route('admin.publishers.index') }}"
            @if (request()->routeIs('admin.publishers.*')) aria-current="page" @endif>
            <span class="nav-icon"><i class="bi bi-window-stack" aria-hidden="true"></i></span>
            <span class="nav-text">Penerbit</span>
        </a>
        <a class="nav-link" {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}
            href="{{ route('admin.contact') }}" @if (request()->routeIs('admin.contact.*')) @endif>
            <span class="nav-icon"><i class="bi bi-envelope-fill" aria-hidden="true"></i></span>
            <span class="nav-text">Contact</span>
        </a>
    </nav>



    <div class="sidebar-footer">
        <span class="status-dot"></span>
        <span class="sidebar-footer-text">System running smoothly</span>
    </div>
</aside>
