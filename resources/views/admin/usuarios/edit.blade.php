@extends('admin.layout')

@section('title', 'Editar Usuario')

@section('content')
<div class="content-box">
    <h2 style="color: var(--gris-oscuro); margin-bottom: 30px;">Editar Usuario</h2>

    <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nombre de Usuario <span style="color: var(--rojo);">*</span></label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $usuario->username) }}" required>
        </div>

        <div style="background-color: #e7f3ff; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>ℹ️ Contraseña:</strong> Deje los campos vacíos si no desea cambiar la contraseña
        </div>

        <div class="form-group">
            <label>Nueva Contraseña</label>
            <input type="password" name="password" class="form-control" placeholder="Dejar vacío para mantener la actual">
        </div>

        <div class="form-group">
            <label>Confirmar Nueva Contraseña</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary">💾 Actualizar Usuario</button>
            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">❌ Cancelar</a>
        </div>
    </form>
</div>
@endsection
