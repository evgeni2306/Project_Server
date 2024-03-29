<?php

use App\Http\Controllers\Authentication\AuthorizationController;
use App\Http\Controllers\Authentication\RegistrationController;
use App\Http\Controllers\GenerateContentController;
use App\Http\Controllers\Interview\GetSpheresController;
use App\Http\Controllers\Interview\GetTechnologiesController;
use App\Http\Controllers\Interview\GetResultsController;
use App\Http\Controllers\Interview\GetProfessionsController;
use App\Http\Controllers\Interview\GetDirectionsController;
use App\Http\Controllers\Interview\InterviewTemplateController;
use App\Http\Controllers\Interview\InterviewStartController;
use App\Http\Controllers\Interview\PreviewPageController;
use App\Http\Controllers\Interview\GetNextQuestionController;
use App\Http\Controllers\Interview\AnswerTaskController;
use App\Http\Controllers\FavoriteSection\GetFavoriteQuestController;
use App\Http\Controllers\FavoriteSection\FavoriteQuestionController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KnowledgeBase\GetProfessionsController as KB_GetProfessionsController;
use App\Http\Controllers\KnowledgeBase\GetQuestionsController as KB_GetQuestionsController;
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
Route::get('/generate={admin}', [GenerateContentController::class, 'createContent']);

Route::get('/presentation', function () {
    return redirect('https://docs.google.com/presentation/d/1hwJfUa-yMfKX2mtrfUrhj-Uwvl3FVTXP9D6tabs00wA/edit?usp=sharing');
});

Route::get('/', function () {
    return view('form');
});
Route::get('/interview/new', [GetSpheresController::class, 'getSpheresForInterview']);
Route::get('/interview/new/sphere={idd}', [GetDirectionsController::class, 'getDirectionsForInterview']);
Route::get('/interview/new/sphere/direction={idd}', [GetTechnologiesController::class, 'getTechnologiesForInterview']);
Route::get('/interview/new/sphere/direction/technology={idd}', [GetProfessionsController::class, 'getProfessionsForInterview']);
Route::get('/interview/new/sphere/direction/technology/profession={idd}', [PreviewPageController::class, 'getPreviewPage']);
Route::post('/interview/templates', [InterviewTemplateController::class, 'getTemplateList']);
Route::post('/interview/templates/delete', [InterviewTemplateController::class, 'deleteTemplate']);
Route::post('/interview/start', [InterviewStartController::class, 'startInterview']);
Route::post('/interview/question', [GetNextQuestionController::class, 'getNextQuestion']);
Route::post('/interview/question/answer', [AnswerTaskController::class, 'answerTask']);
Route::post('/interview/results', [GetResultsController::class, 'getResults']);

Route::post('/question/favorite/list', [GetFavoriteQuestController::class, 'getFavoriteList']);
Route::post('/question/favorite/add', [FavoriteQuestionController::class, 'addFavorite']);
Route::post('/question/favorite/delete', [FavoriteQuestionController::class, 'deleteFavorite']);


Route::post('/knowledgebase/professions', [KB_GetProfessionsController::class, 'getProfessionsForKnowledgeBase']);
Route::post('/knowledgebase/professions/questions', [KB_GetQuestionsController::class, 'getQuestionsForKnowledgeBase']);




Route::post('/registration', [RegistrationController::class, 'createUserAction'])->name('registration');
Route::post('/login', [AuthorizationController::class, 'loginUserAction'])->name('login');

Route::get('/plan', function () {
    return redirect('https://miro.com/app/board/uXjVPFkN4t0=/?share_link_id=228192283176');
});
