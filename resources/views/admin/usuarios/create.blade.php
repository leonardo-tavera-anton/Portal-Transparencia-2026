@extends('admin.layout')

@section('title', 'Nuevo Usuario')

@section('content')
<div class="content-box">
    <h2 style="color: var(--gris-oscuro); margin-bottom: 30px;">Nuevo Usuario</h2>

    <form action="{{ route('admin.usuarios.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nombre de Usuario <span style="color: var(--rojo);">*</span></label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}" required placeholder="Ej: admin">
        </div>

        <div class="form-group">
            <label>Contraseña <span style="color: var(--rojo);">*</span></label>
            <input type="password" name="password" class="form-control" required placeholder="Mínimo 6 caracteres">
        </div>

        <div class="form-group">
            <label>Confirmar Contraseña <span style="color: var(--rojo);">*</span></label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary">💾 Guardar Usuario</button>
            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">❌ Cancelar</a>
        </div>
    </form>
</div>
@endsection
