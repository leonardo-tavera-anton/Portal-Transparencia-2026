@extends('admin.layout')

@section('title', 'Nueva Categoría')

@section('content')
<div class="content-box">
    <h2 style="color: var(--gris-oscuro); margin-bottom: 30px;">Nueva Categoría</h2>

    <form action="{{ route('admin.tipos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Código <span style="color: var(--rojo);">*</span></label>
            <input type="text" name="codigo" class="form-control" value="{{ old('codigo') }}" required placeholder="Ej: ORD">
            <small style="color: #666;">Código único de identificación</small>
        </div>

        <div class="form-group">
            <label>Nombre <span style="color: var(--rojo);">*</span></label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required placeholder="Ej: Ordenanza Municipal">
        </div>

        <div class="form-group">
            <label>Prefijo <span style="color: var(--rojo);">*</span></label>
            <input type="text" name="prefijo" class="form-control" value="{{ old('prefijo') }}" required placeholder="Ej: OM">
            <small style="color: #666;">Se usará en el código del documento (OM-001-2025-MDNCH)</small>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary">💾 Guardar Categoría</button>
            <a href="{{ route('admin.tipos.index') }}" class="btn btn-secondary">❌ Cancelar</a>
        </div>
    </form>
</div>
@endsection
