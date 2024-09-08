<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ComplainController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePersonListController;
use App\Http\Controllers\MohollaController;
use App\Http\Controllers\PostOfficeController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionLogController;
use App\Http\Controllers\UnionController;
use App\Http\Controllers\WardController;

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

// Route::get('/', function () {
//     return redirect()->route('login');
//     // return view('welcome');
// });

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/{id}/details', [HomeController::class, 'personDetails'])->name('home.person.details');
// Route::get('/register_form', [HomeController::class, 'home'])->name('home');

Route::post('/user-registration', [UserController::class, 'userRegistration'])->name('user.registration');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware([
    'auth:sanctum', 'admin.check',
    config('jetstream.auth_session'),
    'verified'
])->name('dashboard');
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/my_account', [UserController::class, 'myAccount'])->name('user.my_account');
    Route::get('/my_profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('/my_profile', [UserController::class, 'userProfileUpdate']);
    Route::get('/profile_edit', [UserController::class, 'profile_edit'])->name('user.profile.edit');
    Route::post('/profile_edit_update', [UserController::class, 'profile_edit_update'])->name('user.profile.update');

    Route::get('/profile_pdf', [UserController::class, 'profile_pdf'])->name('profile_pdf');



    Route::get('/pending_payment', [UserController::class, 'pending_payment'])->name('digital.pending_payment');
    Route::get('/pending_payment_view/{id}', [UserController::class, 'pending_payment_view'])->name('digital.pending_payment_view');
    Route::get('/payment_aprove/{id}', [UserController::class, 'payment_aprove'])->name('digital.payment_aprove');

    Route::get('/income_statement', [UserController::class, 'income_statement'])->name('digital.income_statement');


});

//Common
Route::get('get-district', [\App\Http\Controllers\DistrictController::class, 'getDistrictByDivision'])->name('get.district');
Route::get('get-sub-district', [\App\Http\Controllers\UpazilaController::class, 'getSubDistrictByDistrict'])->name('get.sub_district');
Route::get('get-unions', [\App\Http\Controllers\UnionController::class, 'getUnionBySubDistrict'])->name('get.unions');
Route::get('get-wards', [\App\Http\Controllers\WardController::class, 'getWardsByUnion'])->name('get.wards');
Route::get('get-post-offices', [\App\Http\Controllers\PostOfficeController::class, 'getPostOfficesBySubDistrict'])->name('get.post-offices');
Route::get('get-mohollas', [\App\Http\Controllers\MohollaController::class, 'getMohollasByWard'])->name('get.mohollas');


Route::group(['middleware' => ['auth:web', 'admin.check'], 'prefix' => 'admin'], function () {

    Route::group(['prefix' => 'registration'], function () {
        Route::get('/', [UserController::class, 'registration'])->name('admin.registration.index');
        Route::post('/', [UserController::class, 'registrationUserStatusChange'])->name('admin.registration.status-change');
        Route::get('/{id}/view', [UserController::class, 'userView'])->name('admin.registration.view');
    });


    Route::group(['prefix' => 'front-dashboard'], function () {
        Route::get('/', [HomePersonListController::class, 'index'])->name('admin.front-dashboard.list-of-person.index');
        Route::get('/create', [HomePersonListController::class, 'create'])->name('admin.front-dashboard.list-of-person.create');
        Route::post('/store', [HomePersonListController::class, 'store'])->name('admin.front-dashboard.list-of-person.store');
        Route::get('/{homePersonList}/edit', [HomePersonListController::class, 'edit'])->name('admin.front-dashboard.list-of-person.edit');
        Route::post('{homePersonList}/edit', [HomePersonListController::class, 'update'])->name('admin.front-dashboard.list-of-person.update');
    });
    Route::group(['prefix' => 'front-contact'], function () {
        Route::get('/', [HomeContactController::class, 'index'])->name('admin.front-contact.index');
        Route::get('/create', [HomeContactController::class, 'create'])->name('admin.front-contact.create');
        Route::post('/store', [HomeContactController::class, 'store'])->name('admin.front-contact.store');
        Route::get('/{homeContact}/edit', [HomeContactController::class, 'edit'])->name('admin.front-contact.edit');
        Route::post('{homeContact}/edit', [HomeContactController::class, 'update'])->name('admin.front-contact.update');
    });

    Route::get('/account-details', [TransactionLogController::class, 'accountDetail'])->name('admin.account-detail');
    Route::group(['prefix' => 'configure'], function () {

        Route::group(['prefix' => 'profession'], function () {
            Route::get('/', [ProfessionController::class, 'index'])->name('admin.config.profession.index');
            Route::get('/create', [ProfessionController::class, 'create'])->name('admin.config.profession.create');
            Route::post('/create', [ProfessionController::class, 'store'])->name('admin.config.profession.store');
            Route::get('/edit/{id}', [ProfessionController::class, 'edit'])->name('admin.config.profession.edit');
            Route::post('/edit/{id}', [ProfessionController::class, 'update'])->name('admin.config.profession.update');
        });
        Route::group(['prefix' => 'union'], function () {
            Route::get('/', [UnionController::class, 'index'])->name('admin.config.union.index');
            Route::get('/create', [UnionController::class, 'create'])->name('admin.config.union.create');
            Route::post('/create', [UnionController::class, 'store'])->name('admin.config.union.store');
            Route::get('/edit/{union}', [UnionController::class, 'edit'])->name('admin.config.union.edit');
            Route::post('/edit/{union}', [UnionController::class, 'update'])->name('admin.config.union.update');
        });
        Route::group(['prefix' => 'ward'], function () {
            Route::get('/', [WardController::class, 'index'])->name('admin.config.ward.index');
            Route::get('/create', [WardController::class, 'create'])->name('admin.config.ward.create');
            Route::post('/create', [WardController::class, 'store'])->name('admin.config.ward.store');
            Route::get('/edit/{ward}', [WardController::class, 'edit'])->name('admin.config.ward.edit');
            Route::post('/edit/{ward}', [WardController::class, 'update'])->name('admin.config.ward.update');
        });
        Route::group(['prefix' => 'moholla'], function () {
            Route::get('/', [MohollaController::class, 'index'])->name('admin.config.moholla.index');
            Route::get('/create', [MohollaController::class, 'create'])->name('admin.config.moholla.create');
            Route::post('/create', [MohollaController::class, 'store'])->name('admin.config.moholla.store');
            Route::get('/edit/{moholla}', [MohollaController::class, 'edit'])->name('admin.config.moholla.edit');
            Route::post('/edit/{moholla}', [MohollaController::class, 'update'])->name('admin.config.moholla.update');
        });
        Route::group(['prefix' => 'post-office'], function () {
            Route::get('/', [PostOfficeController::class, 'index'])->name('admin.config.post.index');
            Route::get('/create', [PostOfficeController::class, 'create'])->name('admin.config.post.create');
            Route::post('/create', [PostOfficeController::class, 'store'])->name('admin.config.post.store');
            Route::get('/edit/{post}', [PostOfficeController::class, 'edit'])->name('admin.config.post.edit');
            Route::post('/edit/{post}', [PostOfficeController::class, 'update'])->name('admin.config.post.update');
        });
    });
    Route::group(['prefix' => 'setting'], function () {

        Route::get('/', [SettingController::class, 'index'])->name('admin.setting.index');
        Route::post('/update', [SettingController::class, 'update'])->name('admin.setting.update');
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.admin.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.admin.create');
        Route::post('/create', [UserController::class, 'store'])->name('admin.admin.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.admin.edit');
        Route::post('/edit/{id}', [UserController::class, 'update'])->name('admin.admin.update');
        Route::get('/export', [UserController::class, 'export'])->name('admin.admin.export');
        Route::get('/change-status', [UserController::class, 'changeStatus'])->name('admin.admin.change-status');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'userIndex'])->name('admin.user.index');
        Route::get('/create', [UserController::class, 'userCreate'])->name('admin.user.create');
        Route::post('/create', [UserController::class, 'userStore'])->name('admin.user.store');
        Route::get('/edit/{id}', [UserController::class, 'userEdit'])->name('admin.user.edit');
        Route::post('/edit/{id}', [UserController::class, 'userUpdate'])->name('admin.user.update');
        Route::get('/export', [UserController::class, 'userExport'])->name('admin.user.export');
        Route::get('/change-status', [UserController::class, 'userChangeStatus'])->name('admin.user.change-status');
    });
});


Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('optimize:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:cache');
    return 'success';
});
Route::get('/storage-link', function () {
    Artisan::call('storage:link');

    return 'success';
});
