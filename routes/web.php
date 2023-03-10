<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FormReservationController;
use App\Http\Controllers\ReservationListController;
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
    return view('pages.welcome');
});

Route::get('reservation', [FormReservationController::class, 'GetIndex'])->name('reservation');
Route::post('reservation', [FormReservationController::class, 'SendForm']);

Route::resource('reservation-list', ReservationListController::class);
Route::get('/search', [ReservationListController::class, 'SearchData']);


Route::get('calendar', [CalendarController::class, 'StartCalendar'])->name('calendar');
Route::put('calendar/{id}', [CalendarController::class, 'UpdateReservationFromCalendar'])
    ->where('id', '[0-9]+');
