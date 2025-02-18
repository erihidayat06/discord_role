<?php

use App\Http\Controllers\Admin\GetUsersController;
use App\Http\Controllers\Admin\GuildController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\DiscordController;
use App\Http\Controllers\Auth\RedirectController;

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

Route::get('/', function () {
    return view('index');
});

Route::middleware(['is_admin', 'auth', 'add_role'])->group(function () {
    Route::get('/discord/data-role/view', [DiscordController::class, 'roleUser']);
    Route::get('/discord/add-role/view', [DiscordController::class, 'index']);
    Route::get('/discord/edit/view/{userRole}', [DiscordController::class, 'editRoleUser'])
        ->name('discord.editRole')
        ->where('userRole', '[0-9]+'); // Batasi hanya angka untuk keamanan
    Route::get('/discord/edit/view/{userRole:id}', [DiscordController::class, 'editRoleUSer']);
    Route::put('/discord/update/role/{userRole:id}', [DiscordController::class, 'update']);
    Route::delete('/discord/delete/{userRole:id}', [DiscordController::class, 'delete']);
    Route::post('/discord/add-role', [DiscordController::class, 'addRole'])->name('discord.addRole');
    Route::get('/discord/add-role/multiple/create', [DiscordController::class, 'addRoleMultipleCreate']);
    Route::post('/discord/add-role/multiple', [GetUsersController::class, 'addRoleMultiple']);
    Route::get('/get-discord-users', [GetUsersController::class, 'getUsersByRole']);
    Route::resource('/guild', GuildController::class);
    Route::post('/update-guild/ubah', [GuildController::class, 'updateGuild']);
});

Route::middleware(['guest', 'add_role'])->group(function () {
    Route::get('login/discord', [RedirectController::class, 'redirectToProvider']);
    Route::get('/auth/discord/callback', [DiscordController::class, 'handleProviderCallback']);
    Route::get('/auth/discord', [DiscordController::class, 'redirect'])->name('discord.login');
});
Route::post('/logout', [DiscordController::class, 'logout'])->name('logout');
Route::get('/logout/admin', [DiscordController::class, 'logout'])->name('logout');
