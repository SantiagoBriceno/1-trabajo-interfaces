<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//RUTA WELCOME PAGE PREDEFINIDA POR LARAVEL
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//RUTA INDEX PAGE PROPUESTA
Route::get('/index', function () {
    return Inertia::render('App', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
})->name('index');

//RUTA DASHBOARD PAGE PROPUESTA PARA TODOS LOS USUARIOS (BORRAR)
// Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', function () {
//     return Inertia::render('HomeView');
// })->name('dashboard');

//RUTAS PARA LA EDICION DE PERFIL
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth.admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::middleware('auth.admin')->get('dashboard', function () {
    $users = User::all();
    return Inertia::render('HomeView', compact('users'));
})->name('dashboard');

//RUTAS PARA EL LISTADO DE TODOS LOS USUARIOS REGISTRADOS
Route::middleware('auth.admin')->get('users', function () {
    $user = User::all();
    return Inertia::render('pages-admin/UsersList', compact('user'));
})->name('User');

//RUTAS PARA LA EDICION DE PERFIN DE LA EMPRESA
Route::middleware('auth.admin')->get('company', function () {
    return Inertia::render('pages-admin/Company');
})->name('Company');

require __DIR__ . '/auth.php';
