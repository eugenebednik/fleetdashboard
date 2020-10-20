<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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
    return view('welcome');
});

Route::get('login', [LoginController::class, 'redirectToDiscord'])->name('discord.login');
Route::get('login/callback', [LoginController::class, 'handleDiscordCallback'])
    ->name('discord.login.redirect');

Route::group(['middleware' => ['auth:sanctum', 'verified', 'in_guild']], function () {
    Route::get('/dashboard', function () {
        return view ('dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('/', App\Http\Livewire\Admin\AdminDashboard::class)->name('admin.index');
        Route::get('ship-manufacturers', App\Http\Livewire\ShipManufacturers\ShipManufacturers::class)
            ->name('admin.ship-manufacturers');
        Route::get('ships', App\Http\Livewire\Ships\Ships::class)
            ->name('admin.ships');
        Route::get('allowed-roles', App\Http\Livewire\AllowedRoles\AllowedRoles::class)
            ->name('admin.allowed-roles');
    });
});
