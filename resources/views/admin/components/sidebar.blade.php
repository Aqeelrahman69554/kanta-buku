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
        <a class="nav-link active" href="{{ route('admin.dashboard') }}" aria-current="page">
            <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
            <span class="nav-text">Dashboard</span>
        </a>

        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <span class="nav-icon"><i class="bi bi-journals me-2" aria-hidden="true"></i></span>
            <span class="nav-text">Daftar Kategori</span>
        </a>
        <a class="nav-link" href="{{ route('admin.books.index') }}">
            <span class="nav-icon"><i class="bi bi-book me-2" aria-hidden="true"></i></span>
            <span class="nav-text">Daftar Buku</span>
        </a>


        <a class="nav-link" href="{{ route('admin.publishers.index') }}">
            <span class="nav-icon"><i class="bi bi-window-stack" aria-hidden="true"></i></span>
            <span class="nav-text">Penerbit</span>
        </a>
        <a class="nav-link" href="settings.html">
            <span class="nav-icon"><i class="bi bi-gear" aria-hidden="true"></i></span>
            <span class="nav-text">Settings</span>
        </a>
        <a class="nav-link" href="blank.html">
            <span class="nav-icon"><i class="bi bi-file-earmark" aria-hidden="true"></i></span>
            <span class="nav-text">Blank Page</span>
        </a>
    </nav>

    <div class="sidebar-user">
        <img class="avatar-img avatar-md sidebar-user-avatar" src="../assets/images/avatar/avatar.jpg"
            alt="Admin Hasan" />
        <strong>Admin Hasan</strong>
        <small>Active Workspace</small>
    </div>

    <div class="sidebar-footer">
        <span class="status-dot"></span>
        <span class="sidebar-footer-text">System running smoothly</span>
    </div>
</aside>
