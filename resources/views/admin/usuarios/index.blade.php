@extends('admin.layout')

@section('title', 'Usuarios')

@section('content')
<div class="content-box">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="color: var(--gris-oscuro);">Gestión de Usuarios</h2>
        <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary">➕ Nuevo Usuario</a>
    </div>

    @if($usuarios->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td><strong>#{{ $usuario->id }}</strong></td>
                        <td>{{ $usuario->username }}</td>
                        <td>
                            @if($usuario->activo)
                                <span class="badge badge-success">Activo</span>
                            @else
                                <span class="badge badge-danger">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                                @if($usuario->id != session('admin_id'))
                                    <form action="{{ route('admin.usuarios.toggle', $usuario->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Está seguro de {{ $usuario->activo ? 'DESACTIVAR' : 'ACTIVAR' }} este usuario?{{ $usuario->activo ? ' El usuario será expulsado inmediatamente si tiene una sesión activa.' : '' }}')">
                                        @csrf
                                        <button type="submit" class="btn {{ $usuario->activo ? 'btn-danger' : 'btn-success' }} btn-sm">
                                            {{ $usuario->activo ? '🚫 Desactivar' : '✅ Activar' }}
                                        </button>
                                    </form>
                                @else
                                    <span style="color: #999; font-size: 12px;">(Tu cuenta)</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; color: #999; padding: 40px;">No hay usuarios registrados</p>
    @endif
</div>
@endsection
