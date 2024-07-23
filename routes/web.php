<?php

use App\Http\Controllers\Web\LandingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',                                     [LandingController::class, 'Index'] );
Route::get('/registro',                             [LandingController::class, 'Register'] );
Route::post('/registro',                             [LandingController::class, 'Register'] );
// Route::get('/', function () {
    
Route::get('/mail_invitacion',                                     [LandingController::class, 'Invitacion'] );
//     return view('Landing_pets');
// });


