<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TipoController;
use App\Http\Controllers\Admin\DocumentoController;
use App\Http\Controllers\Admin\UsuarioController;

// Rutas Públicas
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/documento/{id}/descargar', [PublicController::class, 'download'])->name('public.documento.download');
Route::get('/documento/{id}/ver', [PublicController::class, 'view'])->name('public.documento.view');

// Rutas de Autenticación Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

// Rutas Admin Protegidas
Route::prefix('admin')->middleware('admin.auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Categorías (Tipos)
    Route::get('/categorias', [TipoController::class, 'index'])->name('admin.tipos.index');
    Route::get('/categorias/crear', [TipoController::class, 'create'])->name('admin.tipos.create');
    Route::post('/categorias', [TipoController::class, 'store'])->name('admin.tipos.store');
    Route::get('/categorias/{id}/editar', [TipoController::class, 'edit'])->name('admin.tipos.edit');
    Route::put('/categorias/{id}', [TipoController::class, 'update'])->name('admin.tipos.update');
    Route::post('/categorias/{id}/toggle', [TipoController::class, 'toggleStatus'])->name('admin.tipos.toggle');
    
    // Documentos
    Route::get('/documentos', [DocumentoController::class, 'index'])->name('admin.documentos.index');
    Route::get('/documentos/crear', [DocumentoController::class, 'create'])->name('admin.documentos.create');
    Route::post('/documentos', [DocumentoController::class, 'store'])->name('admin.documentos.store');
    Route::get('/documentos/{id}/editar', [DocumentoController::class, 'edit'])->name('admin.documentos.edit');
    Route::put('/documentos/{id}', [DocumentoController::class, 'update'])->name('admin.documentos.update');
    Route::delete('/documentos/{id}', [DocumentoController::class, 'destroy'])->name('admin.documentos.destroy');
    Route::post('/documentos/{id}/toggle', [DocumentoController::class, 'togglePublicado'])->name('admin.documentos.toggle');
    Route::get('/documentos/{id}/descargar', [DocumentoController::class, 'download'])->name('admin.documentos.download');
    
    // Usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios.index');
    Route::get('/usuarios/crear', [UsuarioController::class, 'create'])->name('admin.usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('admin.usuarios.store');
    Route::get('/usuarios/{id}/editar', [UsuarioController::class, 'edit'])->name('admin.usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('admin.usuarios.update');
    Route::post('/usuarios/{id}/toggle', [UsuarioController::class, 'toggleStatus'])->name('admin.usuarios.toggle');
});

