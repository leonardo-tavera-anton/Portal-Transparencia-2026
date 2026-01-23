@extends('admin.layout')

@section('title', 'Nuevo Documento')

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
    <h2 style="color: var(--gris-oscuro); margin-bottom: 30px;">Nuevo Documento</h2>

    <form action="{{ route('admin.documentos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Categoría <span style="color: var(--rojo);">*</span></label>
                <select name="tipo" class="form-control" required>
                    <option value="">Seleccione una categoría</option>
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo->prefijo }}" {{ old('tipo') == $tipo->prefijo ? 'selected' : '' }}>
                            {{ $tipo->nombre }} ({{ $tipo->prefijo }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Número <span style="color: var(--rojo);">*</span></label>
                <input type="text" name="numero" class="form-control" value="{{ old('numero') }}" required placeholder="Ej: 1">
                <small style="color: #666;">Sin ceros a la izquierda</small>
            </div>
        </div>

        <div class="form-group">
            <label>Fecha del Documento <span style="color: var(--rojo);">*</span></label>
            <input type="date" name="fecha" class="form-control" value="{{ old('fecha', date('Y-m-d')) }}" required>
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4" placeholder="Descripción opcional del documento">{{ old('descripcion') }}</textarea>
        </div>

        <div class="form-group">
            <label>Archivo PDF <span style="color: var(--rojo);">*</span></label>
            <input type="file" name="archivo" class="form-control" accept=".pdf" required>
            <small style="color: #666;">Solo archivos PDF, máximo 10MB</small>
        </div>

        <div style="background-color: #e7f3ff; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>ℹ️ Nota:</strong> El archivo se guardará con la nomenclatura: <code>PREFIJO_NUMERO-AÑO-MDNCH.pdf</code>
            <br>El año se detectará automáticamente ({{ date('Y') }})
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary">💾 Guardar Documento</button>
            <a href="{{ route('admin.documentos.index') }}" class="btn btn-secondary">❌ Cancelar</a>
        </div>
    </form>
</div>
@endsection
