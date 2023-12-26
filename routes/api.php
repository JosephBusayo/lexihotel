<?php

use App\Http\Controllers\AjaxRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* ====================APPLICATION AJAX REQUEST ==================*/
Route::prefix('ajax')->name('ajax.')->controller(AjaxRequestController::class)->group(function () {
    Route::post('/get-category', 'getCategory')->name('get-category');

    Route::get('/get-room', 'getRooms')->name('get-room');

    Route::post('/get-booking-detail', 'getBookingDetail')->name('booking-detail');

    // get discount report
    Route::get('/reports/get-discount', 'getDiscount')->name('report.get-discount');
    // get debt report
    Route::get('/reports/get-debt', 'getDebt')->name('report.get-debt');
    // get debt cancel
    Route::post('/reports/get-cancel', 'getCancel')->name('report.get-cancel');
    // get reservation
    Route::post('/reports/get-reservation', 'getReservation')->name('report.get-reservation');
    // get general
    Route::post('/reports/get-general', 'getGeneral')->name('report.get-general');
});