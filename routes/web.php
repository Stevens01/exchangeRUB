<?php

use App\Http\Controllers\ExchangeRateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentSettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilController;
use App\Models\ExchangeRate;
use App\Models\Transaction;
use App\Models\User;
use Spatie\Permission\Models\Role;

// Routes publiques
Route::get('/', function () {
    $users = User::all(); 
    $roles = Role::all(); 
    $exchangeRates = ExchangeRate::latest()->get();
    return view('welcome', compact('users','roles','exchangeRates'));
})->name('home');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/en-attente', [AuthController::class, 'waitingApproval'])
    ->name('waiting_approval');

Route::get('/propos', [UtilController::class, 'propos'])->name('propos');
Route::get('/work', [UtilController::class, 'work'])->name('work');
Route::get('/exchange-rate', [UtilController::class, 'indexU'])->name('exchange_rates');
Route::get('/exchange-rates', [UtilController::class, 'transaction'])->name('transaction');

Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);

// Routes protégées
// Routes Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/exchange', [TransactionController::class, 'index'])->name('exchange.index');
    Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('exchange.show');
    Route::post('/transactions/{id}/approve', [TransactionController::class, 'approve'])->name('admin.transactions.approve');
    Route::post('/transactions/{id}/reject', [TransactionController::class, 'reject'])->name('admin.transactions.reject');
    Route::get('/users/pending', [DashboardController::class, 'pendingUsers'])->name('admin.pending_users');
    Route::get('/admin/users', [DashboardController::class, 'allUsers'])->name('admin.all_users');
    Route::get('/users/{id}', [DashboardController::class, 'showUser'])->name('admin.user.show');
    Route::post('/users/{id}/approve', [DashboardController::class, 'approveUser'])->name('admin.user.approve');
    Route::delete('/users/{id}/reject', [DashboardController::class, 'rejectUser'])->name('admin.user.reject');
    Route::get('/exchange-rates', [ExchangeRateController::class, 'index'])->name('admin.exchange_rates');
    Route::put('/exchange-rates/{id}', [ExchangeRateController::class, 'update'])->name('admin.exchange-rates.update');
    Route::patch('/exchange-rates/{id}/toggle', [ExchangeRateController::class, 'toggle'])->name('admin.exchange-rates.toggle');
    Route::get('/payment-settings', [PaymentSettingsController::class, 'index']) ->name('admin.payment_settings');
    Route::put('/payment-settings', [PaymentSettingsController::class, 'update'])->name('admin.payment_settings.update');

   
});

Route::middleware(['auth', 'user.status'])->group(function () {
   
Route::get('/exchange', [TransactionController::class, 'create'])->name('exchange.create');
Route::get('/exchange/confirm', [TransactionController::class, 'confirm'])->name('exchange.confirm');
Route::post('exchange', [TransactionController::class, 'store'])->name('exchange.store');

});