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

// Coloque esta linha PRIMEIRO:
// E o resource DEPOIS:


// 1. PRIMEIRO as rotas estáticas e específicas
Route::get('/admin/livros/buscar-api', [AdminLivroController::class, 'buscarApi'])->name('admin.livros.buscar-api');

// 2. DEPOIS as rotas de recursos ou com parâmetros dinâmicos
Route::resource('admin/livros', AdminLivroController::class);


// Certifique-se de que está dentro do grupo de administradores, se houver middleware
Route::patch('/admin/usuarios/{id}/suspender', [AdminUsuarioController::class, 'suspender'])->name('admin.usuarios.suspender');

Route::get('/livros/buscar-api', [AdminLivroController::class, 'buscarApi'])->name('livros.buscarApi');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/livros', [AdminLivroController::class, 'index'])->name('livros');
    Route::post('/livros', [AdminLivroController::class, 'store'])->name('livros.store');
    Route::put('/livros/{id}', [AdminLivroController::class, 'update'])->name('livros.update');
    Route::delete('/livros/{id}', [AdminLivroController::class, 'destroy'])->name('livros.destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/usuarios', [AdminUsuarioController::class, 'index'])->name('usuarios');
    Route::put('/usuarios/{id}', [AdminUsuarioController::class, 'update'])->name('usuarios.update');
    Route::patch('/usuarios/{id}/status', [AdminUsuarioController::class, 'toggleStatus'])->name('usuarios.toggleStatus');
    Route::delete('/usuarios/{id}', [AdminUsuarioController::class, 'destroy'])->name('usuarios.destroy');
});

Route::get('/admin/usuarios', [AdminUsuarioController::class, 'index'])->name('admin.usuarios');
Route::get('/admin/tccs/{id}/editar', [AdminTccController::class, 'edit'])
    ->name('admin.tccs.edit');

Route::put('/admin/tccs/{id}', [AdminTccController::class, 'update'])
    ->name('admin.tccs.update');

Route::delete('/admin/tccs/{id}', [AdminTccController::class, 'destroy'])
    ->name('admin.tccs.destroy');


Route::get('/admin/tccs', [AdminTccController::class, 'index'])
    ->name('admin.tccs');

Route::get('/admin/upload-tcc', [AdminTccController::class, 'upload'])
    ->name('admin.upload-tcc');

Route::post('/admin/upload-tcc', [AdminTccController::class, 'store'])
    ->name('admin.upload-tcc.store');

Route::post('/admin/tccs/{id}/aprovar', [AdminTccController::class, 'aprovar'])
    ->name('admin.tccs.aprovar');

Route::post('/admin/tccs/{id}/destacar', [AdminTccController::class, 'destacar'])
    ->name('admin.tccs.destacar');




Route::get('/admin/tccs', [AdminTccController::class, 'index']) 
    ->name('admin.tccs'); 
Route::get('/admin/upload-tcc', [AdminTccController::class, 'upload']) 
    ->name('admin.upload-tcc');
Route::post('/admin/upload-tcc', [AdminTccController::class, 'store']) 
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






Route::get('/admin/tccs', [AdminTccController::class, 'index'])
    ->name('admin.tccs');

Route::get('/admin/upload-tcc', [AdminTccController::class, 'upload'])
    ->name('admin.upload-tcc');

Route::post('/admin/upload-tcc', [AdminTccController::class, 'store'])
    ->name('admin.upload-tcc.store');

Route::post('/admin/tccs/{id}/aprovar', [AdminTccController::class, 'aprovar'])
    ->name('admin.tccs.aprovar');

Route::post('/admin/tccs/{id}/destacar', [AdminTccController::class, 'destacar'])
    ->name('admin.tccs.destacar');

Route::get('/admin/tccs/{id}/edit', [AdminTccController::class, 'edit'])
    ->name('admin.tccs.edit');

Route::put('/admin/tccs/{id}', [AdminTccController::class, 'update'])
    ->name('admin.tccs.update');

Route::delete('/admin/tccs/{id}', [AdminTccController::class, 'destroy'])
    ->name('admin.tccs.destroy');

Route::get('/admin/livros', [AdminLivroController::class, 'index'])
    ->name('admin.livros');

Route::get('/admin/livros/criar', [AdminLivroController::class, 'create'])
    ->name('admin.livros.create');