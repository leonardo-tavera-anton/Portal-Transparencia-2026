@extends('admin.layout')

@section('title', 'Categorías')

@section('content')
<style>
    .btn-primary {
        background-color: #28a745; 
        border-color: #28a745;
        color: white;
        font-weight: bold;
    }

    .content-box .btn-primary:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
</style>
<div class="content-box">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="color: var(--gris-oscuro);">Gestión de Categorías</h2>
        <a href="{{ route('admin.tipos.create') }}" class="btn btn-primary">➕ Nueva Categoría</a>
    </div>

    @if($tipos->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Prefijo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipos as $tipo)
                    <tr>
                        <td><strong>{{ $tipo->codigo }}</strong></td>
                        <td>{{ $tipo->nombre }}</td>
                        <td><span class="badge badge-success">{{ $tipo->prefijo }}</span></td>
                        <td>
                            @if($tipo->estado)
                                <span class="badge badge-success">Activo</span>
                            @else
                                <span class="badge badge-danger">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.tipos.edit', $tipo->id) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                                <form action="{{ route('admin.tipos.toggle', $tipo->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn {{ $tipo->estado ? 'btn-danger' : 'btn-success' }} btn-sm">
                                        {{ $tipo->estado ? '🚫 Desactivar' : '✅ Activar' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; color: #999; padding: 40px;">No hay categorías registradas</p>
    @endif
</div>
@endsection
