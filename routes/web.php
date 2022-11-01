<?php

use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Interview\GetSpheresController;
use App\Http\Controllers\Interview\GetTechnologiesController;
use App\Http\Controllers\Interview\GetProfessionsController;
use App\Http\Controllers\Interview\GetDirectionsController;
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
Route::get('/interview/new', [GetSpheresController::class, 'getSpheresForInterview']);
Route::get('/interview/new/sphere={idd}', [GetDirectionsController::class, 'getDirectionsForInterview']);
Route::get('/interview/new/sphere/direction={idd}', [GetTechnologiesController::class, 'getTechnologiesForInterview']);
Route::get('/interview/new/sphere/direction/technology={idd}', [GetProfessionsController::class, 'getProfessionsForInterview']);

Route::post('/registration', [RegistrationController::class, 'createUserAction'])->name('registration');
Route::post('/login', [AuthorizationController::class, 'loginUserAction'])->name('login');
