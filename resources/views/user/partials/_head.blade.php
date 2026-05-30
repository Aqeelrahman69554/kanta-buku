<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="KantaBuku digital library catalog" />
    <title>KantaBuku</title>

    <link rel="stylesheet" href="{{ asset('admin_user/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_user/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}" />
    <style>
        :root {
            --kb-bg: #f7f9fc;
            --kb-text: #1f2937;
            --kb-muted: #64748b;
            --kb-primary: #2563eb;
            --kb-success: #0f766e;
            --kb-border: #dbe4ef;
        }

        body {
            min-height: 100vh;
            background: var(--kb-bg);
            color: var(--kb-text);
            font-family: "Segoe UI", Arial, sans-serif;
        }

        .user-navbar {
            border-bottom: 1px solid var(--kb-border);
            background: #ffffff;
        }

        .brand-icon {
            width: 38px;
            height: 38px;
            display: inline-grid;
            place-items: center;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--kb-primary), var(--kb-success));
            color: #ffffff;
        }

        .hero {
            padding: 56px 0 32px;
            background: linear-gradient(180deg, #ffffff 0%, #eef5ff 100%);
            border-bottom: 1px solid var(--kb-border);
        }

        .search-panel,
        .book-card,
        .stat-card {
            border: 1px solid var(--kb-border);
            border-radius: 8px;
            background: #ffffff;
        }

        .book-cover {
            width: 72px;
            height: 96px;
            display: grid;
            place-items: center;
            flex: 0 0 auto;
            border-radius: 6px;
            background: #e8f0ff;
            color: var(--kb-primary);
            font-size: 1.65rem;
        }

        .book-meta {
            color: var(--kb-muted);
            font-size: .9rem;
        }

        .line-clamp {
            display: -webkit-box;
            overflow: hidden;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .footer {
            border-top: 1px solid var(--kb-border);
            background: #ffffff;
        }
    </style>
</head>
