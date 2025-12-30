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
            --celeste: #00A8E8;
            --amarillo: #F5E727;
            --rojo: #F53527;
            --gris-oscuro: #2C3E50;
            --gris-claro: #ECF0F1;
            --blanco: #FFFFFF;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--gris-claro);
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background-color: var(--gris-oscuro);
            color: var(--blanco);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .logo-container {
            padding: 20px;
            text-align: center;
            background-color: var(--gris-oscuro);
            border-bottom: 3px solid var(--amarillo);
        }

        .logo-container h2 {
            font-size: 16px;
            margin-top: 10px;
            color: var(--blanco);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .logo-img {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .logo-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .menu {
            list-style: none;
            padding: 20px 0;
        }

        .menu li {
            margin: 5px 0;
        }

        .menu a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: var(--blanco);
            text-decoration: none;
            transition: all 0.3s;
        }

        .menu a:hover {
            background-color: var(--celeste);
            border-left: 4px solid var(--amarillo);
        }

        .menu a.active {
            background-color: var(--celeste);
            border-left: 4px solid var(--amarillo);
        }

        .menu-icon {
            margin-right: 10px;
            font-size: 18px;
        }

        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 20px;
            width: calc(100% - 260px);
        }

        .header {
            background-color: var(--blanco);
            padding: 20px 30px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header h1 {
            color: var(--gris-oscuro);
            font-size: 28px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-name {
            font-weight: bold;
            color: var(--gris-oscuro);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: var(--celeste);
            color: var(--blanco);
        }

        .btn-primary:hover {
            background-color: #0087c1;
        }

        .btn-danger {
            background-color: var(--rojo);
            color: var(--blanco);
        }

        .btn-danger:hover {
            background-color: #c92a36;
        }

        .btn-warning {
            background-color: var(--amarillo);
            color: var(--gris-oscuro);
        }

        .btn-warning:hover {
            background-color: #e6c200;
        }

        .btn-success {
            background-color: #28a745;
            color: var(--blanco);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: var(--blanco);
        }

        .content-box {
            background-color: var(--blanco);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .alert {
            padding: 15px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            border-left: 4px solid #28a745;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border-left: 4px solid #dc3545;
            color: #721c24;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: var(--gris-oscuro);
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--celeste);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: var(--celeste);
            color: var(--blanco);
            font-weight: bold;
        }

        .table tr:hover {
            background-color: var(--gris-claro);
        }

        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-danger {
            background-color: var(--rojo);
            color: white;
        }

        .badge-warning {
            background-color: var(--amarillo);
            color: var(--gris-oscuro);
        }

        .actions {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="logo-container">
            <div class="logo-img">
                <img src="{{ asset('/imagenes/logo.jpg') }}" alt="Logo MDNCH">
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
