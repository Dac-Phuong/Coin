<?php

use App\Livewire\Web\Account\EditAccount;
use App\Livewire\Web\Faq\Faq;
use App\Livewire\Web\Withdraw\ListWithdraw;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DepositController;
use App\Http\Controllers\admin\InvestorController;
use App\Http\Controllers\admin\PlanController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\WalletController;
use App\Http\Controllers\admin\WithdrawController;
use App\Http\Controllers\admin\ReferralController;
use App\Http\Controllers\AuthController as ControllersAuthController;
use App\Http\Controllers\LanguageController;
use App\Livewire\Web\Deposit\ListDeposit;
use App\Livewire\Web\Aboutus\Aboutus;
use App\Livewire\Web\Account\Account;
use App\Livewire\Web\Auth\Login;
use App\Livewire\Web\Auth\Register;
use App\Livewire\Web\Bounty\Bounty;
use App\Livewire\Web\Deposit\Deposit;
use App\Livewire\Web\Referal\Referal;
use App\Livewire\Web\Home\Index;
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
Route::fallback(function () {
    return view('web.errors.404');
});

// .......................................................................BEGIN............................................................................
// auth
Route::get('/register', Register::class);
Route::get('/login', Login::class);
Route::get('/logout', [ControllersAuthController::class, 'logout']);
// page
Route::get('/', Index::class)->name('home');
Route::get('/aboutus', Aboutus::class);
Route::get('/bounty', Bounty::class);
Route::get('/faq', Faq::class);
// manager investor
Route::get('/account', Account::class);
Route::get('/deposit', Deposit::class);
Route::get('/list-deposit', ListDeposit::class);
Route::get('/withdraw', ListWithdraw::class);
Route::get('/edit-account', EditAccount::class);
Route::get('/referrals', Referal::class);

// .......................................................................END............................................................................


// manage admin
Route::group(['prefix' => 'admin'], function () {
    // lang
    Route::get('lang/{locale}', [LanguageController::class, 'swap']);
    // auth
    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', [AuthController::class, 'index'])->name('login');
        Route::post('login', [AuthController::class, 'post_login'])->name('post_login');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
    // management
    Route::group(['middleware' => ['auth']], function () {
        Route::get('', [DashboardController::class, 'index'])->name('dashboard');
        // user
        Route::get('list-user', [UserController::class, 'index'])->name('users')->middleware('can:list-user');
        // roles
        Route::get('list-role', [RoleController::class, 'index'])->name('roles')->middleware('can:list-role');
        // investor
        Route::get('list-investor', [InvestorController::class, 'index'])->name('investors')->middleware('can:list-investor');
        Route::get('history-deposit/{id}', [InvestorController::class, 'history_deposit'])->name('history-deposit');
        Route::get('history-withdraw/{id}', [InvestorController::class, 'history_withdraw'])->name('history-withdraw');
        // wallets
        Route::get('list-wallets', [WalletController::class, 'index'])->name('wallets')->middleware('can:list-wallets');
        // plan fixed
        Route::get('list-plan-fixeds', [PlanController::class, 'plan_fixed'])->name('plans-fixeds')->middleware('can:list-plan');
        // plan daily
        Route::get('list-plan-daily', [PlanController::class, 'plan_daily'])->name('plans-daily')->middleware('can:list-plan');
        // deposit
        Route::get('list-deposit', [DepositController::class, 'index'])->name('deposits')->middleware('can:list-deposit');
        // withdraw
        Route::get('list-withdraw', [WithdrawController::class, 'index'])->name('withdraws')->middleware('can:list-withdraw');
        // referral
        Route::get('list-referral', [ReferralController::class, 'index'])->name('referrals');
    });
});
// .......................................................................END............................................................................
