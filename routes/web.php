<?php

use PharIo\Manifest\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\KadepController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ReceiverController;
use App\Http\Controllers\SenderController;
use Maatwebsite\Excel\Row;

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

// Umum
Route::get('/author', [HomeController::class, 'author'])->name('author');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dokmasuk', [HomeController::class, 'incoming']);
Route::get('/dokkeluar', [HomeController::class, 'outgoing']);
Route::get('/dokumen/{id}', [HomeController::class, 'show'])->name('home.show');
Route::get('/dokumen/download/{id}', [HomeController::class, 'download'])->name('home.download');


// Guest Only
Route::group(['middleware' => ['guest']], function() {
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.action');
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login.action');
});
Route::get('logout', function(){return redirect('/');});
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('profile')->middleware('auth', 'role:mahasiswa,alumni')->group(function() {
    Route::get('/', [HomeController::class, 'profile'])->name('profile');
    Route::put('/update', [HomeController::class, 'update_profile'])->name('profile.update');
    Route::put('/picture', [HomeController::class, 'update_picture'])->name('profile.picture');
    Route::put('/ktm', [HomeController::class, 'update_ktm'])->name('profile.ktm');
    Route::put('/password', [HomeController::class, 'update_password'])->name('profile.password');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth', 'role:admin,koor,kadep');

Route::prefix('dashboard')
    ->middleware('auth')
    ->group(function() {
        Route::group(['middleware' => ['role:admin,kadep,koor']], function() {
            Route::get('/myprofile', [DashboardController::class, 'profile'])->name('dashboard.profile');
            Route::put('/myprofile/edit', [DashboardController::class, 'update'])->name('dashboard.profile.edit');
            Route::put('/myprofile/delpicture', [DashboardController::class, 'delpicture'])->name('dashboard.profile.delpicture');
            Route::put('/myprofile/changepassword', [DashboardController::class, 'changepassword'])->name('dashboard.profile.password');
        });

        Route::group(['middleware' => ['role:admin']], function() {
            Route::resource('operator', OperatorController::class);
            Route::get('/operator/status/{user_id}/{status}', [OperatorController::class, 'updateStatus'])->name('operator.status');
            Route::put('/operator/reset/{operator}', [OperatorController::class, 'reset'])->name('operator.reset');
            Route::delete('/operator/destroy/{operator}', [OperatorController::class, 'destroy'])->name('operator.destroy');
            Route::put('/operator/delpicture/{operator}', [OperatorController::class, 'delpicture'])->name('operator.delpicture');
            
            Route::get('/setfrontend', [AdminController::class, 'index'])->name('setfrontend');
            Route::prefix('setfrontend')->group(function() {
                Route::put('/header', [AdminController::class, 'header']);
                Route::put('/paragraf', [AdminController::class, 'paragraf']);
                Route::post('/pictureadd', [AdminController::class, 'pictureAdd']);
                Route::delete('/picturedelete/{id}', [AdminController::class, 'pictureDelete']);
            });
        });

        Route::group(['middleware' => ['role:kadep,admin']], function() {
            Route::get('/surat/incoming', [KadepController::class, 'incoming'])->name('kadep.incoming');
            Route::get('/surat/outgoing', [KadepController::class, 'outgoing'])->name('kadep.outgoing');
            Route::get('/kadep/download/{kadep}', [DocumentController::class, 'download'])->name('kadep.download');
            Route::resource('kadep', KadepController::class);
        });

        Route::group(['middleware' => ['role:koor,admin']], function() {
            Route::resource('user', UserController::class);
            Route::get('/user/{user_id}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::get('/user/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('user.status');
            Route::put('/user/reset/{user_id}', [UserController::class, 'reset'])->name('user.reset');
            Route::delete('/user/destroy/{user_id}', [UserController::class, 'destroy'])->name('user.destroy');
            Route::put('/user/delpicture/{user_id}', [UserController::class, 'delpicture'])->name('user.delpicture');
            Route::post('/user/import', [UserController::class, 'import'])->name('user.import');

            Route::resource('sender', SenderController::class);
            Route::get('/sender/user/{user_id}', [SenderController::class, 'getdata'])->name('sender.getdata');

            Route::resource('receiver', ReceiverController::class);
            Route::get('/receiver/user/{user_id}', [ReceiverController::class, 'getdata'])->name('receiver.getdata');
            
            Route::get('/document/incoming', [DocumentController::class, 'incoming'])->name('doc.incoming');
            Route::get('/document/outgoing', [DocumentController::class, 'outgoing'])->name('doc.outgoing');
            Route::get('/document/change/{doc_id}/{type}', [DocumentController::class, 'change'])->name('doc.change');
            Route::get('/document/download/{doc_id}', [DocumentController::class, 'download'])->name('doc.download');
            Route::delete('/document/delete-selected', [DocumentController::class, 'deleteCheckbox'])->name('doc.delcheck');
            Route::get('/document/incoming/pdf/{type}', [DocumentController::class, 'inpdf'])->name('doc.inpdf');
            Route::get('/document/incoming/date/{startdate}/{enddate}', [DocumentController::class, 'indate']);
            Route::post('/document/incoming/import', [DocumentController::class, 'inimport'])->name('doc.inimport');
            Route::get('/document/incoming/excel/export', [DocumentController::class, 'inexport'])->name('doc.inexport');
            Route::get('/document/outgoing/pdf/{type}', [DocumentController::class, 'outpdf'])->name('doc.outpdf');
            Route::get('/document/outgoing/date/{startdate}/{enddate}', [DocumentController::class, 'outdate']);
            Route::post('/document/outgoing/import', [DocumentController::class, 'outimport'])->name('doc.outimport');
            Route::get('/document/outgoing/excel/export', [DocumentController::class, 'outexport'])->name('doc.outexport');
            Route::resource('document', DocumentController::class);
        });
});
