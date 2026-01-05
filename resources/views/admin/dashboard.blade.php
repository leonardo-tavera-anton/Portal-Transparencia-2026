@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<style>
    .welcome-section {
        margin-bottom: 2rem;
    }
    
    .welcome-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .welcome-subtitle {
        color: var(--secondary);
        font-size: 0.95rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .stat-card {
        background-color: white;
        padding: 1.5rem;
        border-radius: 1rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        border: 1px solid var(--border);
        transition: all 0.3s ease;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border-color: var(--primary);
    }

    .stat-content h3 {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-content .value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-main);
        line-height: 1;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .icon-primary { background-color: #e0f2fe; color: var(--primary); }
    .icon-success { background-color: #dcfce7; color: var(--success); }
    .icon-warning { background-color: #fef3c7; color: #d97706; }
    .icon-danger { background-color: #fee2e2; color: var(--danger); }

    .recent-docs-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .recent-docs-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-main);
    }
</style>

<div class="welcome-section">
    <h2 class="welcome-title">Panel de Administración</h2>
    <p class="welcome-subtitle">Bienvenido al sistema de gestión del Portal de Transparencia</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-content">
            <h3>Total Documentos</h3>
            <div class="value">{{ $stats['total_documentos'] }}</div>
        </div>
        <div class="stat-icon icon-primary">📄</div>
    </div>

    <div class="stat-card">
        <div class="stat-content">
            <h3>Publicados</h3>
            <div class="value">{{ $stats['documentos_publicados'] }}</div>
        </div>
        <div class="stat-icon icon-success">✅</div>
    </div>

    <div class="stat-card">
        <div class="stat-content">
            <h3>Categorías</h3>
            <div class="value">{{ $stats['total_categorias'] }}</div>
        </div>
        <div class="stat-icon icon-warning">📁</div>
    </div>

    <div class="stat-card">
        <div class="stat-content">
            <h3>Usuarios</h3>
            <div class="value">{{ $stats['total_usuarios'] }}</div>
        </div>
        <div class="stat-icon icon-danger">👥</div>
    </div>
</div>

<div class="content-box">
    <div class="recent-docs-header">
        <h3 class="recent-docs-title">Últimos Documentos Registrados</h3>
    </div>

    @if($documentos_recientes->count() > 0)
        <div style="overflow-x: auto;">
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
                            <td style="font-family: 'Monaco', 'Consolas', monospace; font-weight: 600; color: var(--primary);">
                                {{ $doc->tipo }}-{{ $doc->numero }}-{{ $doc->anno }}
                            </td>
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
        </div>
    @else
        <div style="text-align: center; padding: 3rem; color: var(--secondary);">
            <p>No hay documentos registrados recientemente</p>
        </div>
    @endif
</div>
@endsection
