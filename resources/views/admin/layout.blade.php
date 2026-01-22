<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Portal de Transparencia</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0ea5e9;
            --primary-hover: #0284c7;
            --secondary: #64748b;
            --success: #10b981; 
            --danger: #ef4444;
            --warning: #f59e0b;
            --bg-body: #f1f5f9;
            --bg-sidebar: #2850ae;
            --text-main: #334155;
            --text-light: #94a3b8;
            --white: #ffffff;
            --border: #e2e8f0;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            background-color: var(--bg-sidebar);
            color: var(--white);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: width 0.3s;
            z-index: 100;
        }

        .logo-container {
            padding: 1.5rem 1rem;
            text-align: center;
            background-color: rgba(0,0,0,0.2);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo-container h2 {
            font-size: 0.9rem;
            margin-top: 0.75rem;
            color: var(--white);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            line-height: 1.4;
        }

        .logo-img {
            width: 60px;
            height: 60px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: var(--white);
            border-radius: 50%;
            padding: 5px;
        }

        .logo-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .menu {
            list-style: none;
            padding: 1rem 0;
        }

        .menu li {
            margin: 2px 0;
        }

        .menu a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.2s;
            font-size: 0.95rem;
            border-left: 3px solid transparent;
        }

        .menu a:hover {
            background-color: rgba(255,255,255,0.05);
            color: var(--white);
        }

        .menu a.active {
            background-color: rgba(14, 165, 233, 0.15);
            color: var(--primary);
            border-left-color: var(--primary);
        }

        .menu-icon {
            margin-right: 0.75rem;
            font-size: 1.1rem;
            opacity: 0.8;
        }

        .main-content {
            margin-left: 240px;
            flex: 1;
            padding: 2rem;
            width: calc(100% - 240px);
        }

        .header {
            background-color: var(--white);
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border);
        }

        .header h1 {
            color: var(--text-main);
            font-size: 1.25rem;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-name {
            font-weight: bold;
            color: var(--text-main);
            font-size: 0.9rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-warning {
            background-color: var(--warning);
            color: white;
        }

        .btn-warning:hover {
            background-color: #d97706;
        }

        .btn-success {
            background-color: var(--success);
            color: var(--white);
        }

        .btn-secondary {
            background-color: var(--secondary);
            color: var(--white);
        }

        .content-box {
            background-color: var(--white);
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border);
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alert-success {
            background-color: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .alert-error {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-main);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 0.625rem 0.875rem;
            border: 1px solid var(--border);
            border-radius: 0.375rem;
            font-size: 0.9rem;
            transition: all 0.2s;
            background-color: #f8fafc;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(14, 165, 233, 0.1);
            background-color: var(--white);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .table th,
        .table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
            font-size: 0.9rem;
        }

        .table th {
            background-color: #f8fafc;
            color: var(--text-main);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        .table tr:hover {
            background-color: #f8fafc;
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-success {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="logo-container">
            <div class="logo-img">
                <img src="{{ asset('/imagenes/LOGO2-MDNCH.png') }}" alt="Logo MDNCH">
            </div>
            <h2>Municipalidad de<br>Nuevo Chimbote</h2>
        </div>
        <ul class="menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="menu-icon">📊</span> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.tipos.index') }}" class="{{ request()->routeIs('admin.tipos.*') ? 'active' : '' }}">
                    <span class="menu-icon">📁</span> Categorías
                </a>
            </li>
            <li>
                <a href="{{ route('admin.documentos.index') }}" class="{{ request()->routeIs('admin.documentos.*') ? 'active' : '' }}">
                    <span class="menu-icon">📄</span> Documentos
                </a>
            </li>
            <li>
                <a href="{{ route('admin.usuarios.index') }}" class="{{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
                    <span class="menu-icon">👤</span> Usuarios
                </a>
            </li>
        </ul>
    </aside>

    <main class="main-content">
        <header class="header">
            <h1>@yield('title', 'Dashboard')</h1>
            <div class="user-info">
                <span class="user-name">👤 {{ session('admin_username') }}</span>
                <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Cerrar Sesión</button>
                </form>
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                ✗ {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
