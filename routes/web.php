<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\CensorsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AndroidController;
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

Route::get('/', function(){
	return redirect('dashboard');
});

// Authentication
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginAction', [AuthController::class, 'loginAction']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth', 'checkLevel:Admin']], function(){
	// Route::get('/dashboard', [PagesController::class, 'index']);
	// staff routes
	Route::get('/employees', [EmployeesController::class, 'index']);
	Route::get('/employees/create', [EmployeesController::class, 'create']);
	Route::post('/employees', [EmployeesController::class, 'store']);
	Route::get('/employees/{employee}', [EmployeesController::class, 'show']);
	Route::post('/employees/{employee}/edit', [EmployeesController::class, 'edit']);
	Route::patch('/employees/{employee}', [EmployeesController::class, 'update']);
	Route::delete('/employees/{employee}', [EmployeesController::class, 'destroy']);
	// Route::post('/employees/{employee}', [EmployeesController::class, 'decryptpassword']); //for decrypt password if pressed edit button and generate to method edit using redirect

	// patient route
	Route::get('/patients/create', [PatientsController::class, 'create']);
	Route::get('/patients/{patient}', [PatientsController::class, 'show']);
	Route::post('/patients', [PatientsController::class, 'store']);
	Route::delete('/patients/{patient}', [PatientsController::class, 'destroy']);
	Route::get('/patients/{patient}/edit', [PatientsController::class, 'edit']);
	Route::patch('/patients/{patient}', [PatientsController::class, 'update']);
});

Route::group(['middleware' => ['auth', 'checkLevel:Admin,User']], function(){
	// dashboard routes
	Route::get('/dashboard', [PagesController::class, 'index'])->name('dashboard');

	// schedule routes
	Route::get('/schedule', [SchedulesController::class, 'index']);

	// patient routes
	Route::get('/patients', [PatientsController::class, 'index']);
	// sensor routes
	Route::get('/heartbeatCensor', [CensorsController::class, 'heartbeat'])->name('hball');
	Route::get('/heartbeatCensor/search', [CensorsController::class, 'search']);
	// Route::post('/heartbeatCensor', [CensorsController::class, 'heartbeat']);
	Route::get('/temperatureCensor', [CensorsController::class, 'temperature']);

});

//request from arduino rpms
Route::get('/censors/upload', [CensorsController::class, 'upload']); 

// ----------------------- android request routes -----------------------------

//request from android and show data censor
Route::get('/android/datacensor', [AndroidController::class, 'AndroidCensorShow']); 
//request from android and show data censor
Route::get('/android/dataPatient', [AndroidController::class, 'AndroidPatientShow']);
Route::post('/android/authLogin', [AndroidController::class, 'AndroidLoginAuth']);
Route::get('/android/show', [AndroidController::class, 'showtoken']);
// ------------------------- End android routes -------------------------------

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
