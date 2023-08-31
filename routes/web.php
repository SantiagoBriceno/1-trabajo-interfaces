<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpresaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Empresa;

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

// Route::middleware('auth.admin')->get('company', function () {
//     $empresa = Empresa::all();
//     return Inertia::render('pages-admin/ProfileView', compact('empresa'));
// })->name('Company');

Route::middleware('auth.admin')->get('company', function () {
    $empresa = Empresa::all();
    if (count($empresa) == 0) {
        return Inertia::render('pages-admin/createCompany2', []);
    }else{
        return Inertia::render('pages-admin/createCompany2', compact('empresa'));
    }
    
})->name('Company');

//Ruta para registrar una nueva empresa
Route::middleware('auth.admin')->put('company', function () {
    $empresa = new Empresa();
    $empresa->name = request()->name;
    $empresa->rif = request()->rif;
    $empresa->email = request()->email;
    $empresa->email2 = request()->email2;
    $empresa->phone = request()->phone;
    $empresa->phone2 = request()->phone2;
    $empresa->pais = request()->pais;
    $empresa->estado = request()->estado;
    $empresa->direccion = request()->direccion;
    $empresa->save();
    return redirect()->route('Company');
})->name('company.create');

//Ruta para editar una empresa
Route::middleware('auth.admin')->patch('company', function () {
    //Obtengo la unica empresa que esta registrada
    $empresa = Empresa::all()->first();

    //Actualizo los datos con los campos no nulos de la request
    $empresa->name = request()->name ?? $empresa->name;
    $empresa->rif = request()->rif ?? $empresa->rif;
    $empresa->email = request()->email ?? $empresa->email;
    $empresa->email2 = request()->email2 ?? $empresa->email2;
    $empresa->phone = request()->phone ?? $empresa->phone;
    $empresa->phone2 = request()->phone2 ?? $empresa->phone2;
    $empresa->pais = request()->pais ?? $empresa->pais;
    $empresa->estado = request()->estado ?? $empresa->estado;
    $empresa->direccion = request()->direccion ?? $empresa->direccion;
    $empresa->save();
    return redirect()->route('Company');
})->name('company.edit');

//Ruta para eliminar una empresa
Route::middleware('auth.admin')->delete('company', function () {
    $empresa = Empresa::all()->first();
    if ($empresa == null) {
        return redirect()->route('Company');
    }else{
        $empresa->delete();
        return redirect()->route('Company');}
    
})->name('company.delete');

//RUTA PARA EL REGISTRO DE UNA EMPRESA EN UN FORMULARIO TIPO WIZARD
Route::middleware('auth.admin')->get('company/wizard', function () {
    $empresa = Empresa::all();
    if (count($empresa) == 0) {
        return Inertia::render('pages-admin/CreateCompanyWizard', []);
    }else{
        return Inertia::render('pages-admin/CreateCompanyWizard', compact('empresa'));
    }
})->name('Company.wizard');

Route::middleware('auth.admin')->put('company/wizard', function () {
    $empresa = new Empresa();
    $empresa->name = request()->name;
    $empresa->rif = request()->rif;
    $empresa->email = request()->email;
    $empresa->email2 = request()->email2;
    $empresa->phone = request()->phone;
    $empresa->phone2 = request()->phone2;
    $empresa->pais = request()->pais;
    $empresa->estado = request()->estado;
    $empresa->direccion = request()->direccion;
    $empresa->save();
    return redirect()->route('Company.wizard');
})->name('Company.wizard.register');

Route::middleware('auth.admin')->patch('company', function () {
    //Obtengo la unica empresa que esta registrada
    $empresa = Empresa::all()->first();

    //Actualizo los datos con los campos no nulos de la request
    $empresa->name = request()->name ?? $empresa->name;
    $empresa->rif = request()->rif ?? $empresa->rif;
    $empresa->email = request()->email ?? $empresa->email;
    $empresa->email2 = request()->email2 ?? $empresa->email2;
    $empresa->phone = request()->phone ?? $empresa->phone;
    $empresa->phone2 = request()->phone2 ?? $empresa->phone2;
    $empresa->pais = request()->pais ?? $empresa->pais;
    $empresa->estado = request()->estado ?? $empresa->estado;
    $empresa->direccion = request()->direccion ?? $empresa->direccion;
    $empresa->save();
    return redirect()->route('Company.wizard');
})->name('company.wizard.edit');


//RUTA PARA ELIMINAR LA COMPANY desde Wizard
Route::middleware('auth.admin')->delete('company/wizard', function () {
    $empresa = Empresa::all()->first();
    if ($empresa == null) {
        return redirect()->route('Company.wizard');
    }else{
        $empresa->delete();
        return redirect()->route('Company.wizard');}
    
})->name('company.wizard.delete');



require __DIR__ . '/auth.php';
