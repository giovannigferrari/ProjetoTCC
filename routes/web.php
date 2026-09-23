<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminEmprestimoController;
use App\Http\Controllers\AdminLivroController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminMensagemController;
use App\Http\Controllers\AdminTccController;
use App\Http\Controllers\AdminUsuarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\TccController;
use App\Http\Controllers\MensagemController;
use App\Http\Controllers\UsuarioFavoritos;
use App\Http\Controllers\UsuarioHistorico;
use App\Http\Controllers\UsuarioBiblioteca;
use App\Http\Controllers\UsuarioMensagens;
use App\Http\Controllers\UsuarioPerfil;

Route::get('/admin/tccs', [TccController::class, 'index'])
    ->name('admin.tccs');

Route::get('/admin/upload-tcc', [TccController::class, 'upload'])
    ->name('admin.upload-tcc');

Route::post('/admin/upload-tcc', [TccController::class, 'store'])
    ->name('admin.upload-tcc.store');

// ============================================================
// LOGIN PÚBLICO
// ============================================================

Route::get('/login', function () {
    return view('login');
})->name('login');


// ============================================================
// LOGIN
// Usuário comum OU Administrador
// ============================================================

Route::post('/login', [
    LoginController::class,
    'login'
])->name('login.store');


// ============================================================
// CADASTRO DE USUÁRIO
// ============================================================

Route::get('/register', function () {
    return view('auth.register');
})->name('register.form');

Route::post('/register', [
    RegisterController::class,
    'store'
])->name('register.store');


// ============================================================
// ÁREA DO USUÁRIO
// ============================================================

Route::get('/usuario', [
    UsuarioController::class,
    'index'
])->name('usuario.home');


// ============================================================
// DASHBOARD DO ADMINISTRADOR
// ============================================================

Route::get('/admin', [
    AdminController::class,
    'index'
])->name('admin.home');


// ============================================================
// GERENCIAR LIVROS
// ============================================================

Route::get('/admin/livros', [
    AdminLivroController::class,
    'index'
])->name('admin.livros');


// ============================================================
// USUÁRIOS
// ============================================================

Route::get('/admin/usuarios', [
    AdminUsuarioController::class,
    'index'
])->name('admin.usuarios');

Route::get('/usuario/favoritos', [
    UsuarioFavoritos::class,
    'index'
])->name('usuario.favoritos');

Route::get('/usuario/historico', [
    UsuarioHistorico::class,
    'index'
])->name('usuario.historico');

Route::get('/usuario/biblioteca', [
    UsuarioBiblioteca::class,
    'index'
])->name('usuario.biblioteca');

Route::get('/usuario/mensagens', [
    UsuarioMensagens::class,
    'index'
])->name('usuario.mensagens');

Route::get('/usuario/perfil', [
    UsuarioPerfil::class,
    'index'
])->name('usuario.perfil');




// ============================================================
// EMPRÉSTIMOS
// ============================================================

Route::get('/admin/emprestimos', [
    AdminEmprestimoController::class,
    'index'
])->name('admin.emprestimos');


// ============================================================
// TCCs
// ============================================================

Route::get('/admin/tccs', [
    AdminTccController::class,
    'index'
])->name('admin.tccs');


// ============================================================
// UPLOAD DE TCC
// ============================================================

Route::get('/admin/upload-tcc', [
    AdminTccController::class,
    'upload'
])->name('admin.upload-tcc');


// ============================================================
// MENSAGENS
// ============================================================

Route::get('/admin/mensagens', [
    AdminMensagemController::class,
    'index'
])->name('admin.mensagens');

// ============================================================
// LOGOUT
// ============================================================

Route::post('/logout', [
    LoginController::class,
    'logout'
])->name('logout');


// ============================================================
// HOME PÚBLICA
// ============================================================

Route::get('/', [
    HomeController::class,
    'index'
])->name('usuario.home');

Route::get('home', [
    HomeController::class,
    'index'
])->name('home');