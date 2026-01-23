@extends('admin.layout')

@section('title', 'Editar Categoría')

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
    <h2 style="color: var(--gris-oscuro); margin-bottom: 30px;">Editar Categoría</h2>

    <form action="{{ route('admin.tipos.update', $tipo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Código <span style="color: var(--rojo);">*</span></label>
            <input type="text" name="codigo" class="form-control" value="{{ old('codigo', $tipo->codigo) }}" required>
        </div>

        <div class="form-group">
            <label>Nombre <span style="color: var(--rojo);">*</span></label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $tipo->nombre) }}" required>
        </div>

        <div class="form-group">
            <label>Prefijo <span style="color: var(--rojo);">*</span></label>
            <input type="text" name="prefijo" class="form-control" value="{{ old('prefijo', $tipo->prefijo) }}" required>
            <small style="color: #666;">Se usará en el código del documento ({{ $tipo->prefijo }}-001-2025-MDNCH)</small>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary">💾 Actualizar Categoría</button>
            <a href="{{ route('admin.tipos.index') }}" class="btn btn-secondary">❌ Cancelar</a>
        </div>
    </form>
</div>
@endsection
