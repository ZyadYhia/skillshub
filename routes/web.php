<?php

use App\Http\Controllers\admin\CatController as AdminCatController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\SkillController as AdminSkillController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\CatController;
use App\Http\Controllers\web\ExamController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LangController;
use App\Http\Controllers\web\SkillController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\ProfileController;

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
    Route::get('/exams/questions/{id}', [ExamController::class, 'questions'])->middleware(['auth', 'verified', 'student']);
    Route::get('/contact', [ContactController::class, 'index']);
    Route::post('/contact/message/send', [ContactController::class, 'send']);
    Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth', 'verified', 'student']);

});

Route::post('/exams/start/{id}', [ExamController::class, 'start'])->middleware(['auth', 'verified', 'student', 'can-enter-exam']);
Route::post('/exams/submit/{id}', [ExamController::class, 'submit'])->middleware(['auth', 'verified', 'student']);
Route::get('/lang/set/{lang}', [LangController::class, 'set']);
Route::prefix('dashboard')->middleware(['auth', 'verified', 'can-enter-dashboard'])->group(function () {
    Route::get('', [AdminHomeController::class, 'index']);

    Route::get('categories', [AdminCatController::class, 'index']);
    Route::get('categories/toggle/{cat}', [AdminCatController::class, 'toggle']);
    Route::get('categories/delete/{cat}', [AdminCatController::class, 'delete']);
    Route::post('categories/store', [AdminCatController::class, 'store']);
    Route::post('categories/update', [AdminCatController::class, 'update']);

    Route::get('skills', [AdminSkillController::class, 'index']);
    Route::get('skills/toggle/{skill}', [AdminSkillController::class, 'toggle']);
    Route::get('skills/delete/{skill}', [AdminSkillController::class, 'delete']);
    Route::post('skills/store', [AdminSkillController::class, 'store']);
    Route::post('skills/update', [AdminSkillController::class, 'update']);
});
