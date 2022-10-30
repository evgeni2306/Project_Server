<?php

use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Simulation\GetSpheresController;
use App\Http\Controllers\Simulation\GetTechnologiesController;
use App\Http\Controllers\Simulation\GetProfessionsController;
use App\Http\Controllers\Simulation\GetDirectionsController;
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
    return view('form');
});
Route::get('/gs', [GetSpheresController::class, 'getSpheresForSimulation']);
Route::get('/gd={idd}', [GetDirectionsController::class, 'getDirectionsForSimulation']);
Route::get('/gt={idd}', [GetTechnologiesController::class, 'getTechnologiesForSimulation']);
Route::get('/gp={idd}', [GetProfessionsController::class, 'getProfessionsForSimulation']);

Route::post('/registration', [RegistrationController::class, 'createUserAction'])->name('registration');
Route::post('/login', [AuthorizationController::class, 'loginUserAction'])->name('login');
