@extends('admin.layout')

@section('title', 'Documentos')

@section('content')
<div class="content-box">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="color: var(--gris-oscuro);">Gestión de Documentos</h2>
        <a href="{{ route('admin.documentos.create') }}" class="btn btn-primary">➕ Nuevo Documento</a>
    </div>

    <form method="GET" style="background-color: var(--gris-claro); padding: 20px; border-radius: 5px; margin-bottom: 20px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr auto; gap: 15px; align-items: end;">
            <div class="form-group" style="margin-bottom: 0;">
                <label>Categoría</label>
                <select name="tipo" class="form-control">
                    <option value="">Todas</option>
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo->prefijo }}" {{ request('tipo') == $tipo->prefijo ? 'selected' : '' }}>
                            {{ $tipo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label>Año</label>
                <select name="anno" class="form-control">
                    <option value="">Todos</option>
                    @foreach($annos as $anno)
                        <option value="{{ $anno->anno }}" {{ request('anno') == $anno->anno ? 'selected' : '' }}>
                            {{ $anno->anno }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label>Buscar</label>
                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Número o descripción">
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label>Mostrar</label>
                <select name="per_page" class="form-control">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page', 20) == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">🔍 Filtrar</button>
                <a href="{{ route('admin.documentos.index') }}" class="btn btn-secondary">Limpiar</a>
            </div>
        </div>
    </form>

    @if($documentos->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Categoría</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documentos as $doc)
                    <tr>
                        <td><strong>{{ $doc->tipo }}-{{ $doc->numero }}-{{ $doc->anno }}</strong></td>
                        <td>{{ $doc->tipoDocumento->nombre }}</td>
                        <td>{{ $doc->fecha->format('d/m/Y') }}</td>
                        <td>{{ \Str::limit($doc->descripcion, 50) }}</td>
                        <td>
                            @if($doc->publicado)
                                <span class="badge badge-success">Publicado</span>
                            @else
                                <span class="badge badge-danger">No Publicado</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.documentos.download', $doc->id) }}" class="btn btn-primary btn-sm" target="_blank" title="Descargar">📥</a>
                                <a href="{{ route('admin.documentos.edit', $doc->id) }}" class="btn btn-warning btn-sm" title="Editar">✏️</a>
                                <form action="{{ route('admin.documentos.toggle', $doc->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn {{ $doc->publicado ? 'btn-danger' : 'btn-success' }} btn-sm" title="{{ $doc->publicado ? 'Despublicar' : 'Publicar' }}">
                                        {{ $doc->publicado ? '🚫' : '✅' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.documentos.destroy', $doc->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Está seguro de eliminar este documento? Esta acción no se puede deshacer.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $documentos->links() }}
        </div>
    @else
        <p style="text-align: center; color: #999; padding: 40px;">No hay documentos registrados</p>
    @endif
</div>
@endsection
