<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IllustrationFormController;
use App\Http\Controllers\testController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/illustrationRequest', [IllustrationFormController::class, 'viewForm'])->name('illform.view');
Route::post('/illustrationRequest', [IllustrationFormController::class, 'storeRequest'])->name('illform.submit');


//testing page
Route::get('/test', [testController::class, 'viewForm'])->name('test.view');
Route::post('/test', [testController::class, 'storeForm'])->name('test.submit');
