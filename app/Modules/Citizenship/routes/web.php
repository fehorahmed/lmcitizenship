<?php

use App\Modules\Citizenship\Http\Controllers\CitizenshipController;
use Illuminate\Support\Facades\Route;

// Route::get('citizenship', 'CitizenshipController@welcome');

Route::group(['middleware' => ['auth:web', 'admin.check'], 'prefix' => 'admin'], function () {

    Route::group(['prefix' => 'citizenship'], function () {
        Route::get('/', [CitizenshipController::class, 'index'])->name('admin.citizenship.index');
        Route::get('/approved', [CitizenshipController::class, 'approvedIndex'])->name('admin.citizenship.approved');
        Route::get('/pending', [CitizenshipController::class, 'pendingIndex'])->name('admin.citizenship.pending');
        Route::get('/setting', [CitizenshipController::class, 'setting'])->name('admin.citizenship.setting');
        Route::post('/setting', [CitizenshipController::class, 'settingUpdate']);
        Route::get('{id}/details', [CitizenshipController::class, 'adminDetails'])->name('admin.citizenship.details');
        Route::get('/make-payment', [CitizenshipController::class, 'makePayment'])->name('admin.citizenship.make-payment');
        Route::post('/make-payment', [CitizenshipController::class, 'makePaymentStore']);
        Route::get('/change-status', [CitizenshipController::class, 'changeStatus'])->name('admin.citizenship.change-status');
        Route::get('/check-citizen', [CitizenshipController::class, 'checkCitizen'])->name('check.user.citizen');
    });
});

Route::group(['middleware' => ['auth:web']], function () {

    Route::group(['prefix' => 'citizenship'], function () {
        Route::get('/', [CitizenshipController::class, 'userCitizenship'])->name('user.citizenship');
        Route::post('/citizenship_payment', [CitizenshipController::class, 'citizenshipPayment'])->name('citizenship.payment');
    });
    Route::group(['prefix' => 'citizenship'], function () {
        Route::get('/pdf/{id}/aplication', [CitizenshipController::class, 'citizenshipPdfApplication'])->name('citizenship.pdf.aplication');
        Route::get('/pdf/{id}/payment', [CitizenshipController::class, 'citizenshipPdfPayment'])->name('citizenship.pdf.payment');
        Route::get('/pdf/{id}/certificate', [CitizenshipController::class, 'citizenshipPdfCertificate'])->name('citizenship.pdf.certificate');
        Route::get('/pdf/{id}/certificate_2', [CitizenshipController::class, 'citizenshipPdfCertificate2'])->name('citizenship.pdf.certificate_2');
    });
});
