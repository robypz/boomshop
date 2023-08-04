<?php

use App\Http\Controllers\BundleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValuationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\http\Controllers\Auth\LoginController;
use App\http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

Auth::routes([
    'verify' => true
]);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {



        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('login', [LoginController::class, 'login']);
        Route::post('register', [RegisterController::class, 'register']);




        Route::post('livewire/message/{name}', '\Livewire\Controllers\HttpConnectionHandler');


        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/close', [HomeController::class, 'close'])->name('close');

        Route::prefix('product')->group(function () {
            Route::get('/show/{id}', [ProductController::class, 'show'])->name('product.show');
        });

        Route::prefix('image')->group(function () {
            Route::get('/show/{image}', [ImageController::class, 'show'])->name('image.show');
        });

        Route::prefix('help')->group(function () {
            Route::view('/', 'help.index')->name('help');
            Route::view('boom', 'help.boom')->name('help.boom');
            Route::view('transactionsAndPayments', 'help.transactionsAndPayments')->name('help.transactionsAndPayments');
            Route::view('paymentMethods', 'help.paymentMethods')->name('help.paymentMethods');
            Route::view('tutorials', 'help.tutorials')->name('help.tutorials');
            Route::view('termsAndConditions', 'help.termsAndConditions')->name('help.termsAndConditions');
        });

        Route::get('/confirm-password', function () {
            return view('auth.passwords.confirm');
        })->middleware('auth')->name('password.confirmPassword');

        Route::post('/confirm-password', function (Request $request) {
            if (!Hash::check($request->password, $request->user()->password)) {
                return back()->withErrors([
                    'password' => ['The provided password does not match our records.']
                ]);
            }

            $request->session()->passwordConfirmed();

            return redirect()->intended();
        })->middleware(['auth', 'throttle:6,1']);



        Route::middleware(['auth', 'verified'])->group(function () {


            Route::prefix('product')->group(function () {
                Route::group(['middleware' => ['role:super-admin']], function () {
                    Route::get('/index', [ProductController::class, 'index'])->name('product.index');
                    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
                    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
                    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
                    Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
                });
            });

            Route::prefix('category')->group(function () {
                Route::group(['middleware' => ['role:super-admin']], function () {

                    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
                    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
                    Route::get('/index', [CategoryController::class, 'index'])->name('category.index');
                    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
                    Route::get('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
                });
            });

            Route::group(['middleware' => ['role:super-admin|admin']], function () {

                Route::prefix('bundle')->group(function () {

                    Route::get('/create', [BundleController::class, 'create'])->name('bundle.create');
                    Route::post('/store', [BundleController::class, 'store'])->name('bundle.store');
                    Route::get('/index/{product_id?}', [BundleController::class, 'index'])->name('bundle.index');
                    Route::get('/edit/{id}', [BundleController::class, 'edit'])->name('bundle.edit');
                    Route::post('/update', [BundleController::class, 'update'])->name('bundle.update');
                });
            });

            Route::prefix('payment')->group(function () {

                Route::POST('/create', [PaymentController::class, 'create'])->name('payment.create');
            });

            Route::prefix('order')->group(function () {

                Route::post('/store', [OrderController::class, 'store'])->name('order.store');

                Route::group(['middleware' => ['role:super-admin|admin|operator']], function () {

                    Route::get('/index/{id?}', [OrderController::class, 'index'])->name('order.index');
                    Route::get('/show/{id}', [OrderController::class, 'show'])->name('order.show');
                    Route::post('/update', [OrderController::class, 'update'])->name('order.update');
                    Route::get('/pending', [OrderController::class, 'pending'])->name('order.pending');
                });
            });

            Route::group(['middleware' => ['role:super-admin|admin']], function () {

                Route::prefix('valuation')->group(function () {
                    Route::get('/create', [ValuationController::class, 'create'])->name('valuation.create');
                    Route::post('/store', [ValuationController::class, 'store'])->name('valuation.store');
                    Route::get('/index', [ValuationController::class, 'index'])->name('valuation.index');
                    Route::get('/edit/{id}', [ValuationController::class, 'edit'])->name('valuation.edit');
                    Route::post('/update', [ValuationController::class, 'update'])->name('valuation.update');
                });
            });



            Route::group(['middleware' => ['role:super-admin']], function () {

                Route::prefix('paymentMethod')->group(function () {

                    Route::get('/index', [PaymentMethodController::class, 'index'])->name('paymentMethod.index');
                    Route::get('/create', [PaymentMethodController::class, 'create'])->name('paymentMethod.create');
                    Route::post('/store', [PaymentMethodController::class, 'store'])->name('paymentMethod.store');
                    Route::get('/edit/{id}', [PaymentMethodController::class, 'edit'])->name('paymentMethod.edit');
                    Route::post('/update', [PaymentMethodController::class, 'update'])->name('paymentMethod.update');
                });
            });



            Route::prefix('user')->group(function () {

                Route::get('/show', [UserController::class, 'show'])->name('user.show');
                Route::get('/edit', [UserController::class, 'edit'])->name('user.edit');
                Route::post('/update', [UserController::class, 'update'])->name('user.update');
                Route::get('/orders', [UserController::class, 'orders'])->name('user.orders');
                Route::get('/giftcards', [UserController::class, 'giftCards'])->name('user.giftCards')->middleware(['password.confirm']);
                Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
                Route::get('/changePasswordRequest', [UserController::class, 'passwordChangeRequest'])->name('user.changePasswordRequest')->middleware(['password.confirm']);
                Route::post('/changePassword', [UserController::class, 'passwordChange'])->name('user.passwordChange')->middleware(['password.confirm']);
                Route::get('/editAvatar', [UserController::class, 'editAvatar'])->name('user.editAvatar');
                Route::post('/setAvatar', [UserController::class, 'setAvatar'])->name('user.setAvatar');

                Route::group(['middleware' => ['role:super-admin|admin|operator']], function () {
                    Route::get('/ordersInProcess', [UserController::class, 'ordersInProcess'])->name('user.ordersInProcess');
                });

                Route::group(['middleware' => ['role:super-admin']], function () {
                    Route::get('/index', [UserController::class, 'index'])->name('user.index');
                    Route::get('/editRole/{id}', [UserController::class, 'editRole'])->name('user.editRole');
                    Route::post('/updateRole', [UserController::class, 'updateRole'])->name('user.updateRole');
                });
            });



            Route::prefix('avatar')->group(function () {
                Route::group(['middleware' => ['role:super-admin|admin']], function () {
                    Route::get('/create', [AvatarController::class, 'create'])->name('avatar.create');
                    Route::get('/index', [AvatarController::class, 'index'])->name('avatar.index');
                    Route::post('/store', [AvatarController::class, 'store'])->name('avatar.store');
                    Route::get('/destroy/{id}', [AvatarController::class, 'destroy'])->name('avatar.destroy');
                });

            });



            Route::prefix('code')->group(function () {

                Route::group(['middleware' => ['role:super-admin|admin']], function () {
                    Route::get('/index', [CodeController::class, 'index'])->name('code.index');
                    Route::get('/create', [CodeController::class, 'create'])->name('code.create');
                    Route::post('/store', [CodeController::class, 'store'])->name('code.store');
                });

                Route::post('/validate', [CodeController::class, 'validateCode'])->name('code.validate');
                Route::get('/test', [CodeController::class, 'test'])->name('code.test');
            });
        });
    }
);
