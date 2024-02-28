<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IllustrationFormController;

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

// Route::get('/illustrationform', function () {
//     return view('request-form');
// });
//'IllustrationFormController@storeRequest'

Route::get('/illustrationRequest', [IllustrationFormController::class, 'viewForm'])->name('illform.view');
Route::post('/illustrationRequest', [IllustrationFormController::class, 'storeRequest'])->name('illform.submit');
