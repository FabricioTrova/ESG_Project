<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\AdicionarEmpresaController;
use App\Http\Controllers\FonteConsumoController;
use App\Http\Controllers\ConsumoController;

Route::get('/', function () {
    return redirect()->route('login');
});

//Rotas de login usuario
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Rotas de registro usuario 
Route::get('/register', [RegistroController::class, 'showUserForm']);
Route::post('/register', [RegistroController::class, 'registrarUsuario']);

// Rota GET para '/fonteDeConsumo' que retorna diretamente a view 'fonteDeConsumo'
// Essa rota não passa dados do controlador, apenas carrega a página estática
Route::get('/fonteDeConsumo', function () {
    return view('fonteDeConsumo');
});

// Registro de fontes de consumo via FonteConsumoController

// Rota GET para '/fontes' que chama o método 'index' do FonteConsumoController
// Usada para listar todas as fontes de consumo cadastradas
Route::get('/fontes', [FonteConsumoController::class, 'index'])->name('fontes.index');

// Rota POST para '/fontes' que chama o método 'store' do FonteConsumoController
// Usada para salvar uma nova fonte de consumo no banco de dados
Route::post('/fontes', [FonteConsumoController::class, 'store'])->name('fontes.store');

// Rota PUT para '/fontes/{id}' que chama o método 'update' do FonteConsumoController
// Usada para atualizar uma fonte de consumo existente, identificada pelo 'id'
Route::put('/fontes/{id}', [FonteConsumoController::class, 'update'])->name('fontes.update');

// Rota DELETE para '/fontes/{id}' que chama o método 'destroy' do FonteConsumoController
// Usada para excluir uma fonte de consumo existente, identificada pelo 'id'
Route::delete('/fontes/{id}', [FonteConsumoController::class, 'destroy'])->name('fontes.destroy');


// Rota GET para a URL '/historico' que originalmente renderizava diretamente a view 'consumo' (sem passar dados)
// Esta rota está sobrescrevendo a rota abaixo (e pode ser removida para evitar conflito)
Route::get('/historico', function () {
    return view('consumo');
});

// Rota GET para a URL '/historico' que chama o método 'index' do 'ConsumoController'
// Essa rota carrega a view 'consumo' com os dados necessários, como $consumos e $fontes
// Esta deve ser a rota utilizada para exibir o histórico de consumos
Route::get('/historico', [ConsumoController::class, 'index'])->name('consumo');

// Rota POST para '/consumos' que chama o método 'store' do 'ConsumoController'
// Essa rota é usada para salvar um novo registro de consumo no banco de dados
Route::post('/consumos', [ConsumoController::class, 'store'])->name('consumos.store');

// Rota PUT para '/consumos/{id}' que chama o método 'update' do 'ConsumoController'
// Essa rota é usada para atualizar um consumo existente com base no ID fornecido
Route::put('/consumos/{id}', [ConsumoController::class, 'update'])->name('consumos.update');

// Rota DELETE para '/consumos/{id}' que chama o método 'destroy' do 'ConsumoController'
// Essa rota é usada para excluir um registro de consumo existente pelo ID
Route::delete('/consumos/{id}', [ConsumoController::class, 'destroy'])->name('consumos.destroy');


// Protegidas futuramente com middleware('auth')
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/charts', function () {
    return view('charts');
});

Route::get('/forgot', function () {
    return view('auth.forgot-password');
});

// Rotas para adicionar empresa
Route::get('/empresas', [AdicionarEmpresaController::class, 'index'])->name('empresas.index');
Route::post('/empresas', [AdicionarEmpresaController::class, 'store'])->name('empresas.store');