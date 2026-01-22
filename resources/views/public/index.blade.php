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
            --rojo-gob: #C1272D;
            --rojo-oscuro: #9B1E23;
            --negro: #1C1C1C;
            --gris-oscuro: #333333;
            --gris-medio: #666666;
            --gris-claro: #F5F5F5;
            --blanco: #FFFFFF;
        }

        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            background-color: var(--gris-claro);
            color: var(--negro);
        }

        .header {
            background-color: var(--rojo-gob);
            color: var(--blanco);
            padding: 20px;
            border-bottom: 4px solid var(--negro);
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background-color: none;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 5px;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.95;
        }

        .container {
            max-width: 1400px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .filter-section {
            background-color: var(--blanco);
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: var(--negro);
            font-size: 13px;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            font-size: 13px;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--rojo-gob);
        }

        .btn {
            padding: 8px 20px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: var(--rojo-gob);
            color: var(--blanco);
        }

        .btn-primary:hover {
            background-color: var(--rojo-oscuro);
        }

        .btn-secondary {
            background-color: var(--gris-oscuro);
            color: var(--blanco);
        }

        .btn-secondary:hover {
            background-color: var(--negro);
        }

        /* Tabla de documentos */
        .table-container {
            background-color: var(--blanco);
            border: 1px solid #ddd;
            overflow-x: auto;
        }

        .documents-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .documents-table thead {
            background-color: var(--negro);
            color: var(--blanco);
        }

        .documents-table thead th {
            padding: 12px 10px;
            text-align: left;
            font-weight: bold;
            border-bottom: 2px solid var(--rojo-gob);
        }

        .documents-table tbody tr {
            border-bottom: 1px solid #e0e0e0;
        }

        .documents-table tbody tr:hover {
            background-color: var(--gris-claro);
        }

        .documents-table tbody td {
            padding: 10px;
            vertical-align: middle;
        }

        .document-code {
            font-weight: bold;
            color: var(--negro);
            font-size: 12px;
        }

        .document-type {
            display: inline-block;
            background-color: var(--rojo-gob);
            color: var(--blanco);
            padding: 3px 8px;
            font-size: 11px;
            font-weight: bold;
        }

        .document-description {
            color: var(--gris-medio);
            line-height: 1.4;
            max-width: 400px;
        }

        .btn-action {
            padding: 6px 12px;
            font-size: 12px;
            text-decoration: none;
            display: inline-block;
            margin-right: 5px;
            font-weight: bold;
        }

        .btn-download {
            background-color: var(--rojo-gob);
            color: var(--blanco);
        }

        .btn-download:hover {
            background-color: var(--rojo-oscuro);
        }

        .btn-view {
            background-color: var(--blanco);
            color: var(--negro);
            border: 1px solid var(--negro);
        }

        .btn-view:hover {
            background-color: var(--negro);
            color: var(--blanco);
        }

        .no-results {
            text-align: center;
            padding: 40px 20px;
            color: var(--gris-medio);
            background-color: var(--blanco);
            border: 1px solid #ddd;
        }

        .no-results h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: var(--negro);
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 20px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            background-color: var(--blanco);
            border: 1px solid #ddd;
            text-decoration: none;
            color: var(--negro);
            font-size: 13px;
        }

        .pagination a:hover {
            background-color: var(--gris-claro);
        }

        .pagination .active {
            background-color: var(--rojo-gob);
            color: var(--blanco);
            border-color: var(--rojo-gob);
        }

        .admin-link {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: var(--negro);
            color: var(--blanco);
            padding: 12px 20px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            font-size: 13px;
        }

        .admin-link:hover {
            background-color: var(--rojo-gob);
        }

        .results-count {
            padding: 10px 15px;
            background-color: var(--blanco);
            border: 1px solid #ddd;
            margin-bottom: 10px;
            font-size: 13px;
            color: var(--gris-medio);
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <img src="{{ asset('/imagenes/LOGO2-MDNCH.png') }}" alt="Logo MDNCH">
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
                        <label>Categoría</label>
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
                        <label>Año</label>
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
                        <label>Buscar</label>
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Número o descripción...">
                    </div>

                    <div class="form-group">
                        <label>Mostrar</label>
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
            <div class="results-count">
                <strong>{{ $documentos->total() }}</strong> documentos encontrados
            </div>

            <div class="table-container">
                <table class="documents-table">
                    <thead>
                        <tr>
                            <th style="width: 180px;">CÓDIGO</th>
                            <th style="width: 150px;">TIPO</th>
                            <th style="width: 100px;">FECHA</th>
                            <th>DESCRIPCIÓN</th>
                            <th style="width: 180px;">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documentos as $documento)
                            <tr>
                                <td>
                                    <div class="document-code">
                                        {{ $documento->tipo }}-{{ $documento->numero }}-{{ $documento->anno }}-MDNCH
                                    </div>
                                </td>
                                <td>
                                    <span class="document-type">{{ $documento->tipoDocumento->nombre }}</span>
                                </td>
                                <td>{{ $documento->fecha->format('d/m/Y') }}</td>
                                <td>
                                    <div class="document-description">
                                        {{ $documento->descripcion ?? 'Sin descripción' }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('public.documento.download', $documento->id) }}" class="btn-action btn-download">
                                        Descargar
                                    </a>
                                    <a href="{{ route('public.documento.view', $documento->id) }}" class="btn-action btn-view" target="_blank">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $documentos->links() }}
            </div>
        @else
            <div class="no-results">
                <h3>No se encontraron documentos</h3>
                <p>Intente con otros filtros de búsqueda</p>
            </div>
        @endif
    </div>

    <a href="{{ route('admin.login') }}" class="admin-link">Acceso Admin</a>
</body>
</html>
