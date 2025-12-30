<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Transparencia - Municipalidad de Nuevo Chimbote</title>
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
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--gris-claro);
        }

        .header {
            background-color: var(--celeste);
            color: white;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background-color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid var(--amarillo);
            overflow: hidden;
            padding: 5px;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .filter-section {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .form-group {
            margin-bottom: 0;
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
        }

        .form-control:focus {
            outline: none;
            border-color: var(--celeste);
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: var(--celeste);
            color: white;
        }

        .btn-primary:hover {
            background-color: #0087c1;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .documents-grid {
            display: grid;
            gap: 20px;
        }

        .document-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .document-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }

        .document-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }

        .document-code {
            background-color: var(--celeste);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }

        .document-date {
            color: #666;
            font-size: 14px;
        }

        .document-category {
            display: inline-block;
            background-color: var(--amarillo);
            color: var(--gris-oscuro);
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .document-description {
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .document-actions {
            display: flex;
            gap: 10px;
        }

        .btn-download {
            background-color: var(--celeste);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: background-color 0.3s;
        }

        .btn-download:hover {
            background-color: #0087c1;
        }

        .btn-view {
            background-color: var(--amarillo);
            color: var(--gris-oscuro);
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-view:hover {
            background-color: #e6c200;
        }

        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .no-results h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 15px;
            background-color: white;
            border-radius: 5px;
            text-decoration: none;
            color: var(--gris-oscuro);
        }

        .pagination .active {
            background-color: var(--celeste);
            color: white;
        }

        .admin-link {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: var(--rojo);
            color: white;
            padding: 15px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            transition: transform 0.3s;
        }

        .admin-link:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <img src="{{ asset('/imagenes/logo.jpg') }}" alt="Logo MDNCH">
            </div>
            <div>
                <h1>Portal de Transparencia</h1>
                <p>Municipalidad Distrital de Nuevo Chimbote</p>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="filter-section">
            <form method="GET">
                <div class="filter-grid">
                    <div class="form-group">
                        <label>📁 Categoría</label>
                        <select name="tipo" class="form-control">
                            <option value="">Todas las categorías</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->prefijo }}" {{ request('tipo') == $tipo->prefijo ? 'selected' : '' }}>
                                    {{ $tipo->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>📅 Año</label>
                        <select name="anno" class="form-control">
                            <option value="">Todos los años</option>
                            @foreach($annos as $anno)
                                <option value="{{ $anno->anno }}" {{ request('anno') == $anno->anno ? 'selected' : '' }}>
                                    {{ $anno->anno }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>🔍 Buscar</label>
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Número o descripción...">
                    </div>

                    <div class="form-group">
                        <label>📄 Mostrar</label>
                        <select name="per_page" class="form-control">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('per_page', 20) == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                        <a href="{{ route('public.index') }}" class="btn btn-secondary">Limpiar</a>
                    </div>
                </div>
            </form>
        </div>

        @if($documentos->count() > 0)
            <div class="documents-grid">
                @foreach($documentos as $documento)
                    <div class="document-card">
                        <div class="document-header">
                            <div>
                                <div class="document-code">
                                    📄 {{ $documento->tipo }}-{{ $documento->numero }}-{{ $documento->anno }}-MDNCH
                                </div>
                            </div>
                            <div class="document-date">
                                📅 {{ $documento->fecha->format('d/m/Y') }}
                            </div>
                        </div>

                        <span class="document-category">{{ $documento->tipoDocumento->nombre }}</span>

                        @if($documento->descripcion)
                            <p class="document-description">{{ $documento->descripcion }}</p>
                        @endif

                        <div class="document-actions">
                            <a href="{{ route('public.documento.download', $documento->id) }}" class="btn-download">
                                📥 Descargar PDF
                            </a>
                            <a href="{{ route('public.documento.view', $documento->id) }}" class="btn-view" target="_blank">
                                👁️ Ver
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination">
                {{ $documentos->links() }}
            </div>
        @else
            <div class="no-results">
                <h3>📭 No se encontraron documentos</h3>
                <p>Intente con otros filtros de búsqueda</p>
            </div>
        @endif
    </div>

    <a href="{{ route('admin.login') }}" class="admin-link">🔒 Acceso Admin</a>
</body>
</html>
