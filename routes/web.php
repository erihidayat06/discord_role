<?php

use Midtrans\Config;
use App\Models\Modul;
use Midtrans\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\AkademiController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\GuildController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\ModulController;
use App\Http\Controllers\Admin\PixelController;
use App\Http\Controllers\Auth\DiscordController;
use App\Http\Controllers\Auth\RedirectController;
use App\Http\Controllers\Admin\GetUsersController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ResearchController;
use App\Http\Controllers\Admin\LanggananController;
use App\Http\Controllers\Admin\KeanggotaanController;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

Route::get('/', [HomeController::class, 'index'])->middleware('prevent.if.active', 'add_role');


Route::get('/akademicrypto', [AkademiController::class, 'index'])->middleware('add_role');

Route::middleware(['auth'])->group(
    function () {
        Route::get('/payment', [PaymentController::class, 'index']);
        Route::post('/payment/process', [PaymentController::class, 'process']);
        Route::post('/payment/notification', [PaymentController::class, 'notification']);
        Route::post('/midtrans/cancel', function (Request $request) {
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');

            $orderId = $request->order_id;

            try {
                $response = Transaction::cancel($orderId);
                return response()->json(['success' => true, 'message' => 'Transaksi dibatalkan!', 'data' => $response]);
            } catch (Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
        });
        Route::get('/payment/token/{order}', [PaymentController::class, 'getToken'])->name('midtrans.token');
        Route::post('/payment/update-status', [PaymentController::class, 'updateStatus']);
        Route::post('/payment/webhook', [PaymentController::class, 'webhook']);
        Route::get('/order/cetak/{id}', [OrderController::class, 'cetak'])->name('order.cetak');


        Route::get('/orderan', [OrderController::class, 'index']);
    }
);

Route::middleware(['is_admin', 'auth'])->group(function () {
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

    Route::get('/logout/admin', [DiscordController::class, 'logout'])->name('logout.admin');

    // Kategori
    Route::resource('/kategori', KategoriController::class);

    // Kelas/Modul
    Route::resource('/kelas', KelasController::class)->parameters([
        'kelas' => 'kelas'
    ]);
    Route::get('/kelas/{kelas_id}/video/{id}', [KelasController::class, 'lihatVideo'])->name('lihat.video');
    Route::post('/keatas/kelas/{id}/up', [KelasController::class, 'moveUp'])->name('kelas.moveUp');
    Route::post('/kebawah/kelas/{id}/down', [KelasController::class, 'moveDown'])->name('kelas.moveDown');
    Route::post('/kelas/subkelas/{kelas:id}', [KelasController::class, 'subKelas']);

    Route::resource('/kelas/modul', ModulController::class);
    // Route::post('/modul/store/', [ModulController::class, 'store'])->name('modul.store');
    Route::get('/video/{id}', [ModulController::class, 'showVideo'])->name('video.show');

    Route::get('/langganan', [LanggananController::class, 'index']);
    Route::get('/admin/user', [LanggananController::class, 'adminUser']);
    Route::patch('/admin/langganan/update-expired/{id}', [LanggananController::class, 'updateExpired'])
        ->name('admin.langganan.updateExpired');
    Route::post('/keatas/kategori/{id}/up', [KategoriController::class, 'moveUp'])->name('kategori.moveUp');
    Route::post('/kebawah/kategori/{id}/down', [KategoriController::class, 'moveDown'])->name('kategori.moveDown');

    // research
    Route::resource('/admin/research', ResearchController::class);


    Route::resource('/admin/keanggotaan', KeanggotaanController::class);
    Route::get('/admin/orderan', [KeanggotaanController::class, 'orderan']);
    Route::post('/admin/periode/{period:id}', [KeanggotaanController::class, 'periode']);

    Route::get('/admin/pixel', [PixelController::class, 'index']);
    Route::put('/admin/pixel/{id}', [PixelController::class, 'update'])->name('pixel.update');
});

Route::post('/logout', [DiscordController::class, 'logout'])->name('logout')->middleware('auth');



Route::middleware(['auth',  'check.subscription'])->group(
    function () {
        Route::get('/kursus', [KursusController::class, 'index']);
        Route::get('/kursus/{kelas:slug}', [KursusController::class, 'show']);
        Route::get('/kursus/{slug}/modul/{slug_modul}', [KursusController::class, 'showModul'])->name('modul.view');
        Route::post('/modul/{slug}/{slug_modul}/next', [KursusController::class, 'nextModul'])->name('modul.next');
        Route::get('/secure-video/{filename}', [KursusController::class, 'secureVideo'])->name('video.secure');
        Route::post('/logout/discord', [KursusController::class, 'logout']);

        Route::get('/research', [ResearchController::class, 'show']);

        Route::get('/orderan/user', [OrderController::class, 'orderUser']);
        Route::get('/perpanjang/user', [OrderController::class, 'perpanjangUser']);
    }
);


Route::middleware([])->group(function () {
    Route::get('/login/discord', [RedirectController::class, 'redirectToProvider']);
    Route::get('/auth/discord/callback', [DiscordController::class, 'handleProviderCallback']);
    Route::get('/auth/discord', [DiscordController::class, 'redirect'])->name('discord.login');
});

Auth::routes();

Route::get('/sitemap.xml', function () {
    $content = view('sitemap'); // Pastikan ada file `sitemap.blade.php` di resources/views
    return Response::make($content, 200, ['Content-Type' => 'application/xml']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
