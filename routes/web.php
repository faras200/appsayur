<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLapakController;
use App\Http\Controllers\AdminOrmawaController;
use App\Http\Controllers\AnggotaOrmawaController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardUsersController;
use App\Http\Controllers\EmailNotificationController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LapakController;
use App\http\Controllers\LoginController;
use App\Http\Controllers\OrmawaController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PengambilanDanaController;
use App\http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\http\Controllers\RegisterController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UploadImageController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/emailsaya', function () {
    return view('emailku');
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth:user,admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
Route::get('blog/{slug}', [PostController::class, 'show']);
Route::get('/blog', [PostController::class, 'blog']);
Route::get('/', [PostController::class, 'home']);
Route::get('/home', [PostController::class, 'index']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/lapak', [AuthorsController::class, 'index']);
Route::get('/lapak/{user:username}', [AuthorsController::class, 'show']);
Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::get('home/{post:slug}', [PostController::class, 'show']);
Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all(),
    ]);
});
Route::get('/categories/{category:slug}', function (Category $category) {
    return view('home', [
        'title' => "Post By Category: $category->name",
        "active" => "categories",
        'post' => $category->posts->load('category', 'user'),
    ]);
});

// Route::get('/ormawa', function () {
//     return view('authors', [
//         'title' => 'Semua Authors',
//         "active" => "authors",
//         'authors' => User::all()
//     ]);
// });
Route::get('/authors/{authors:username}', function (User $authors) {
    return view('home', [
        'title' => "Post By Authors: $authors->name",
        'active' => "authors",
        'post' => $authors->posts->load('category', 'user'),
    ]);
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug']);

Route::group(['middleware' => ['auth:user,admin']], function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/dashboard/bayar', [DashboardController::class, 'bayar']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/dashboard/posts', DashboardPostController::class);
    Route::get('/dashboard/posts/delete/{id}', [DashboardPostController::class, 'destroy']);
    Route::post('images', [UploadImageController::class, 'store'])->name('upload-image');
    Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show');
    Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug']);
    Route::resource('/dashboard/profile', ProfileController::class)->except('show')->except('create');
    Route::resource('/dashboard/admin', AdminController::class)->except('show');
    Route::get('/dashboard/admin/delete/{id}', [AdminController::class, 'delete']);
    Route::get('/dashboard/admin-ormawa/delete/{id}', [AdminOrmawaController::class, 'destroy']);
    Route::resource('/dashboard/admin-ormawa', AdminLapakController::class)->except('show');
    Route::get('/dashboard/admin-lapak/delete/{id}', [AdminLapakController::class, 'destroy']);
    Route::resource('/dashboard/admin-lapak', AdminLapakController::class)->except('show');
    Route::resource('/dashboard/lapak', LapakController::class);
    Route::get('/dashboard/lapak/delete/{id}', [LapakController::class, 'destroy']);
    Route::resource('/dashboard/ormawa', OrmawaController::class);
    Route::get('/dashboard/ormawa/delete/{id}', [OrmawaController::class, 'destroy']);
    Route::resource('/dashboard/ormawa/anggota', AnggotaOrmawaController::class)->except(['show']);
    Route::get('/dashboard/ormawa/anggota/delete/{id}', [AnggotaOrmawaController::class, 'destroy']);
    Route::get('/dashboard/{ormawa_id}/anggota', [AnggotaOrmawaController::class, 'index']);
    Route::get('/dashboard/media', function () {
        return view('dashboard.media.index');
    });
    Route::get('/dashboard/arsip-file', function () {
        return view('dashboard.arsip-file.index');
    });
    Route::resource('/dashboard/pengajuan', PengajuanController::class);
    Route::resource('/dashboard/ambil-dana', PengambilanDanaController::class);
    Route::get('/dashboard/ambil-dana/delete/{id}', [PengambilanDanaController::class, 'destroy']);
    Route::get('/dashboard/arsip-pengajuan', [PengajuanController::class, 'arsip']);
    Route::get('/dashboard/pengajuan/{id}/status', [PengajuanController::class, 'status']);
    Route::get('/dashboard/arsip-pengajuan/{id}', [PengajuanController::class, 'detail_arsip']);
    Route::get('/dashboard/pengajuan/delete/{id}', [PengajuanController::class, 'destroy']);
    Route::get('/getpengajuan/{id}', function ($id) {
        $pengajuan = App\Models\Pengajuan::where('ormawa_id', $id)->where('status', 'setuju')->where('jenis', 'proposal')->get(['id', 'subjek']);
        return response()->json($pengajuan);
    });
    Route::get('/kirimemail', [EmailNotificationController::class, 'index']);

    Route::post('/keranjang/deletes', [KeranjangController::class, 'destroy'])->name('delete.keranjang');
    Route::resource('/keranjang', KeranjangController::class)->names([
        'show' => 'add.keranjang',
    ]);
    Route::resource('/checkout', CheckoutController::class);
    Route::resource('/dashboard/transaksi', TransaksiController::class);
    Route::get('/dashboard/users/delete/{id}', [DashboardUsersController::class, 'destroy']);
    Route::resource('/dashboard/users', DashboardUsersController::class);
    Route::get('/dashboard/laporan', [LaporanController::class, 'index']);
});
