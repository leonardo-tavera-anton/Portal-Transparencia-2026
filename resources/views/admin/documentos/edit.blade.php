@extends('admin.layout')

@section('title', 'Editar Documento')

@section('content')
<div class="content-box">
    <h2 style="color: var(--gris-oscuro); margin-bottom: 30px;">Editar Documento</h2>

    <div style="background-color: #fff3cd; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
        <strong>⚠️ Código Actual:</strong> {{ $documento->tipo }}-{{ $documento->numero }}-{{ $documento->anno }}-MDNCH
        <br><small style="color: #856404;">Si cambia el tipo, número o fecha (año), el código se actualizará automáticamente.</small>
    </div>

    <form action="{{ route('admin.documentos.update', $documento->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Categoría <span style="color: var(--rojo);">*</span></label>
                <select name="tipo" class="form-control" required>
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo->prefijo }}" {{ old('tipo', $documento->tipo) == $tipo->prefijo ? 'selected' : '' }}>
                            {{ $tipo->nombre }} ({{ $tipo->prefijo }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Número <span style="color: var(--rojo);">*</span></label>
                <input type="text" name="numero" class="form-control" value="{{ old('numero', $documento->numero) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label>Fecha del Documento <span style="color: var(--rojo);">*</span></label>
            <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $documento->fecha->format('Y-m-d')) }}" required>
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4">{{ old('descripcion', $documento->descripcion) }}</textarea>
        </div>

        <div class="form-group">
            <label>Reemplazar Archivo PDF</label>
            <input type="file" name="archivo" class="form-control" accept=".pdf">
            <small style="color: #666;">
                Archivo actual: <strong>{{ basename($documento->archivo_path) }}</strong>
                <br>Deje vacío si no desea cambiar el archivo
            </small>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary">💾 Actualizar Documento</button>
            <a href="{{ route('admin.documentos.index') }}" class="btn btn-secondary">❌ Cancelar</a>
        </div>
    </form>
</div>
@endsection
