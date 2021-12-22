<?php

use App\Http\Controllers\AnularSolicitudController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BuscarEstudianteController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DisabledUserController;
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UsuarioImportController;
use App\Http\Controllers\GestionSolicitudController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::resource('GestionSolicitud', GestionSolicitudController::class,['middleware' => 'auth']);




Route::middleware(['rutasAlumno'])->group(function () {
    Route::resource('solicitud', SolicitudController::class);
    Route::get('/solicitud/{id}/edit', [SolcitudController::class, 'edit'])->name('editarSolicitud');
    Route::post('anular',[AnularSolicitudController::class,'AnularSolicitud'])->name('anular');

});

Route::middleware(['rutasJefeCarrera'])->group(function () {
    Route::resource('GestionSolicitud', GestionSolicitudController::class);
    Route::get('buscarEstudiante', function(){return view('auth.buscarEstudiante.index');})->name('buscarEstudiante');
    Route::get('filtrarSolicitudes', function(){return view('filtrarSolicitudes.index');})->name('filtrarSolicitudes');
    Route::get('Detalles/{id}',[GestionSolicitudController::class, 'Detalles'])->name('postDetalles');
    Route::get('Detalles/{alumno_id}/solicitud/{id}', [GestionSolicitudController::class, 'DatosSolicitud'])->name('verSolicitud');
    Route::get('Detalles2/{alumno_id}/solicitud/{id}', [GestionSolicitudController::class, 'AceptarSolicitud'])->name('AceptarSolicitud');
    Route::get('Detalles3/{alumno_id}/solicitud/{id}', [GestionSolicitudController::class, 'AceptarOSolicitud'])->name('AceptarOSolicitud');
    Route::get('Detalles4/{alumno_id}/solicitud/{id}', [GestionSolicitudController::class, 'RechazarSolicitud'])->name('RechazarSolicitud');
    Route::post('alumno',[BuscarEstudianteController::class, 'devolverEstudiante'])->name('postBuscarEstudiante');
    Route::get('alumno/{id}', [BuscarEstudianteController::class,'mostrarEstudiante'])->name('mostrarEstudiante');
    Route::get('alumno/{alumno_id}/solicitud/{id}', [BuscarEstudianteController::class, 'verDatosSolicitud'])->name('verSolicitudAlumno');
    Route::get('estadisticas', [EstadisticasController::class, 'showEstadistica'])->name('estadisitica');
    Route::get('GestionSolicitud', [GestionSolicitudController::class, 'show'])->name('GestionSolicitud');
    Route::post('Aceptar',[GestionSolicitudController::class,'AceptarSolicitud'])->name('Aceptar');
    Route::get('Resuelta', [GestionSolicitudController::class, 'Resuelta'])->name('Resuelta');
    
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

//Route::get('import-alumno',[App\Http\Controllers\UsuarioImportController::class,'show']);
//Route::post('import-alumno',[App\Http\Controllers\UsuarioImportController::class,'store'])->name('alumno.import');

Route::get('carga-masiva', [UsuarioImportController::class, 'index'])->name('indexCargaMasiva');
Route::post('carga-masiva', [UsuarioImportController::class, 'carga'])->name('cargaExcel');

Route::get('/import', function () {return view('usuario.import');});

