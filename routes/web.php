<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpresaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Colors;
use Illuminate\Support\Facades\Storage;

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
    $colors = Colors::all()->first();
    $company = Empresa::all()->first();

    return Inertia::render('App', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'colors' => $colors,
        'company' => $company,
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
    $colors = Colors::all()->first();
    return Inertia::render('HomeView', compact('colors', 'users'));
})->name('dashboard');

//RUTAS PARA EL LISTADO DE TODOS LOS USUARIOS REGISTRADOS
Route::middleware('auth.admin')->get('users', function () {
    $user = User::all();
    $colors = Colors::all()->first();
    return Inertia::render('pages-admin/UsersList', compact('user', 'colors'));
})->name('User');

// Route::middleware('auth.admin')->get('company', function () {
//     $empresa = Empresa::all();
//     return Inertia::render('pages-admin/ProfileView', compact('empresa'));
// })->name('Company');

Route::middleware('auth.admin')->get('company', function () {
    $empresa = Empresa::all();
    $colors = Colors::all()->first();
    if (count($empresa) == 0) {
        return Inertia::render('pages-admin/createCompany2', compact('colors'));
    } else {
        return Inertia::render('pages-admin/createCompany2', compact('empresa', 'colors'));
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
    } else {
        $empresa->delete();
        return redirect()->route('Company');
    }
})->name('company.delete');

//RUTA PARA EL REGISTRO DE UNA EMPRESA EN UN FORMULARIO TIPO WIZARD
Route::middleware('auth.admin')->get('company/wizard', function () {
    $empresa = Empresa::all();
    $colors = Colors::all()->first();
    if (count($empresa) == 0) {
        return Inertia::render('pages-admin/CreateCompanyWizard', compact('colors'));
    } else {
        return Inertia::render('pages-admin/CreateCompanyWizard', compact('empresa', 'colors'));
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
    } else {
        $empresa->delete();
        return redirect()->route('Company.wizard');
    }
})->name('company.wizard.delete');

Route::middleware('auth.admin')->get('company/colors', function () {
    $colors = Colors::all();
    if (count($colors) == 0) {
        return Inertia::render('pages-admin/CreatePaletteColor', []);
    } else {
        return Inertia::render('pages-admin/CreatePaletteColor', compact('colors'));
    }
})->name('Company.colors');

Route::middleware('auth.admin')->post('company/colors', function () {
    $colors = Colors::all()->first();
    if ($colors == null) {
        $colors = new Colors();
        $colors->color1 = request()->color1;
        $colors->color2 = request()->color2;
        $colors->color3 = request()->color3;
        $colors->color4 = request()->color4;
        $colors->color5 = request()->color5;

        if (request()->hasFile('file')) {
            $file = request()->file('file');
            $filename = $file->getClientOriginalName();
            $colors->file = $filename;
            $file->move(public_path('images'), $filename);
        } else {
            $colors->file = null;
        }
        $colors->save();
        return redirect()->route('Company.colors');
    } else {

        $colors->color1 = request()->color1 ?? $colors->color1;
        $colors->color2 = request()->color2 ?? $colors->color2;
        $colors->color3 = request()->color3 ?? $colors->color3;
        $colors->color4 = request()->color4 ?? $colors->color4;
        $colors->color5 = request()->color5 ?? $colors->color5;
        if (request()->hasFile('file')) {
            $file = request()->file('file');
            $filename = $file->getClientOriginalName();
            $colors->file = $filename;
            $file->move(public_path('images'), $filename);
        }
        $colors->save();
        return redirect()->route('colors.edit');
    }
})->name('colors.create');
//Ruta para editar una empresa
Route::middleware('auth.admin')->patch('company/colors', function () {
    //Obtengo la unica empresa que esta registrada
    $colors = Colors::all()->first();

    //Actualizo los datos con los campos no nulos de la request
    $colors->color1 = request()->color1 ?? $colors->color1;
    $colors->color2 = request()->color2 ?? $colors->color2;
    $colors->color3 = request()->color3 ?? $colors->color3;
    $colors->color4 = request()->color4 ?? $colors->color4;
    $colors->color5 = request()->color5 ?? $colors->color5;
    $colors->save();
    return redirect()->route('colors.edit');
})->name('colors.edit');

require __DIR__ . '/auth.php';
