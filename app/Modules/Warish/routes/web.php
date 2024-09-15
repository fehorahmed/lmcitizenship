<?php

use App\Modules\Warish\Http\Controllers\WarishController;
use Illuminate\Support\Facades\Route;

Route::get('warish', 'WarishController@welcome');


Route::group(['middleware' => ['auth:web', 'admin.check'], 'prefix' => 'admin'], function () {

    Route::group(['prefix' => 'warish'], function () {
        Route::get('/', [WarishController::class, 'admin_index'])->name('admin.warish.index');
        Route::get('/setting', [WarishController::class, 'setting'])->name('admin.warish.setting');
        Route::post('/setting', [WarishController::class, 'settingUpdate']);
        Route::get('{id}/details', [WarishController::class, 'admin_details'])->name('admin.warish.details');

        Route::get('/change-status', [WarishController::class, 'changeStatus'])->name('admin.warish.change-status');

        Route::get('/make-payment', [WarishController::class, 'makePayment'])->name('admin.warish.make-payment');
        Route::post('/make-payment', [WarishController::class, 'makePaymentStore']);
        Route::get('/check-citizen', [WarishController::class, 'checkCitizen'])->name('check.user.warish');
    });
});

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/warish/welcome', [WarishController::class, 'myAccount'])->name('user.warish.welcome');
    Route::get('/warish', [WarishController::class, 'warishIndex'])->name('user.warish');
    Route::get('/warish/{id}/details', [WarishController::class, 'details'])->name('user.warish.details');
    Route::get('/warish/form/{id?}', [WarishController::class, 'warish_add_form'])->name('user.warish.form');
    Route::post('/warish/add', [WarishController::class, 'warish_add'])->name('user.warish.add');

    Route::get('/warish/{id}/apply', [WarishController::class, 'warish_apply'])->name('user.warish.apply');
    Route::post('/warish/payment', [WarishController::class, 'warish_payment'])->name('user.warish.payment');

    Route::get('warish/pdf/{id}/payment',   [WarishController::class, 'pdf_payment'])->name('warish.pdf.payment');
    Route::get('warish/pdf/{id}/certificate',  [WarishController::class, 'pdf_certificate'])->name('warish.pdf.certificate');
    Route::get('warish/pdf/{id}/certificate_2',  [WarishController::class, 'pdf_certificate_2'])->name('warish.pdf.certificate_2');
    Route::get('warish/pdf/{id}/application',   [WarishController::class, 'pdf_application'])->name('warish.pdf.application');
    Route::get('warish/ajax_rowitem',  [WarishController::class, 'ajax_rowitem'])->name('warish.ajax.rowitem');
});
