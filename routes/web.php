<?php

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BuscarEstudiante;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DisabledUserController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\UsuarioController;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioImportController;
use App\Imports\UsersImport;
use App\Imports\UsuarioImport;

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

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', function (){
        $usuarioLogeado = Auth::user();
        return view('perfil')->with('user',$usuarioLogeado);
    });
});

Route::resource('carrera', CarreraController::class,['middleware'=>'auth']);
Route::resource('usuario', UsuarioController::class,['middleware' => 'auth']);

Route::middleware(['rutasAlumno'])->group(function () {
    Route::resource('solicitud', SolicitudController::class);

});

Route::middleware(['rutasJefeC'])->group(function () {
    Route::get('buscarEstudiante', function(){return view('buscarEstudiante.index');})->name('buscarEstudiante');
    Route::post('alumno',[BuscarEstudiante::class, 'devolverEstudiante'])->name('postBuscarEstudiante');
    Route::get('alumno/{id}', [BuscarEstudiante::class,'mostrarEstudiante'])->name('mostrarEstudiante');
    Route::get('alumno/{alumno_id}/solicitud/{id}', [BuscarEstudiante::class, 'verDatosSolicitud'])->name('verSolicitudAlumno');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/help', function () {
    return view('help');
})->name('help');

Route::post('/change-password',[ChangePasswordController::class, 'changePassword'])->name('changepassword');

Route::get('/status-user-change', [DisabledUserController::class, 'disabledUser'])->name('changeStatus');

Route::post('/reset-password/{id}',[ResetPasswordController::class, 'resetPassword'])->name('resetpassword');
//nuevo
//otra linea
//importar alumnos

Route::get('import-alumno',[App\Http\Controllers\UsuarioImportController::class,'show']);
Route::post('import-alumno',[App\Http\Controllers\UsuarioImportController::class,'store'])->name('alumno.import');
Route::get('/import', function () {return view('usuario.import');});
