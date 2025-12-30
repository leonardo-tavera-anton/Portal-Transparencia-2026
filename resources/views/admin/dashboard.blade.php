@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="content-box">
    <h2 style="color: var(--celeste); margin-bottom: 30px;">Bienvenido al Panel de Administración</h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px;">
        <div style="background-color: var(--celeste); padding: 25px; border-radius: 10px; color: white; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h3 style="font-size: 16px; margin-bottom: 10px; opacity: 0.9;">Total Documentos</h3>
            <p style="font-size: 36px; font-weight: bold;">{{ $stats['total_documentos'] }}</p>
        </div>

        <div style="background-color: #28a745; padding: 25px; border-radius: 10px; color: white; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h3 style="font-size: 16px; margin-bottom: 10px; opacity: 0.9;">Documentos Publicados</h3>
            <p style="font-size: 36px; font-weight: bold;">{{ $stats['documentos_publicados'] }}</p>
        </div>

        <div style="background-color: var(--amarillo); padding: 25px; border-radius: 10px; color: var(--gris-oscuro); box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h3 style="font-size: 16px; margin-bottom: 10px; opacity: 0.9;">Categorías Activas</h3>
            <p style="font-size: 36px; font-weight: bold;">{{ $stats['total_categorias'] }}</p>
        </div>

        <div style="background-color: var(--rojo); padding: 25px; border-radius: 10px; color: white; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h3 style="font-size: 16px; margin-bottom: 10px; opacity: 0.9;">Usuarios Activos</h3>
            <p style="font-size: 36px; font-weight: bold;">{{ $stats['total_usuarios'] }}</p>
        </div>
    </div>

    <h3 style="color: var(--gris-oscuro); margin-bottom: 20px;">Últimos Documentos Registrados</h3>

    @if($documentos_recientes->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Categoría</th>
                    <th>Año</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documentos_recientes as $doc)
                    <tr>
                        <td><strong>{{ $doc->tipo }}-{{ $doc->numero }}-{{ $doc->anno }}</strong></td>
                        <td>{{ $doc->tipoDocumento->nombre }}</td>
                        <td>{{ $doc->anno }}</td>
                        <td>{{ $doc->fecha->format('d/m/Y') }}</td>
                        <td>
                            @if($doc->publicado)
                                <span class="badge badge-success">Publicado</span>
                            @else
                                <span class="badge badge-danger">No Publicado</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; color: #999; padding: 40px;">No hay documentos registrados</p>
    @endif
</div>
@endsection
