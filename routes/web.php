<?php

use App\Http\Controllers\web\CatController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\ExamController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LangController;
use App\Http\Controllers\web\SkillController;
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

Route::middleware(['lang'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/categories/show/{id}', [CatController::class, 'show']);
    Route::get('/skills/show/{id}', [SkillController::class, 'show']);
    Route::get('/exams/show/{id}', [ExamController::class, 'show']);
    Route::get('/exams/questions/{id}', [ExamController::class, 'questions'])->middleware(['auth','verified','student']);
    Route::get('/contact', [ContactController::class, 'index']);
    Route::post('/contact/message/send', [ContactController::class, 'send']);
});

Route::post('/exams/start/{id}', [ExamController::class, 'start'])->middleware(['auth','verified','student']);
Route::post('/exams/submit/{id}', [ExamController::class, 'submit'])->middleware(['auth','verified','student']);
Route::get('/lang/set/{lang}', [LangController::class, 'set']);
