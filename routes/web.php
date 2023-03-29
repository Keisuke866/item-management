<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::get('/logout',[App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
    //商品の削除機能//
    Route::post('/destroy/{id}',[App\Http\Controllers\ItemController::class,'destroy'])->name('item.destroy');
    //商品の検索機能//
    Route::get('/index/{name}', [App\Http\Controllers\ItemController::class, 'index'])->name('item.index');
    Route::get('/search', [App\Http\Controllers\ItemController::class, 'search'])->name('item.search');
    //商品の売却処理機能//
    Route::get('/Finished/{id}',[App\Http\Controllers\ItemController::class, 'Finished'])->name('itemed.index');
    Route::get('/finish',[App\Http\Controllers\ItemController::class, 'finish'])->name('item.finish');
    //アップデート
    Route::post('/update/{id}',[App\Http\Controllers\ItemController::class,'update']);
    //売却済み一覧表示
    Route::get('/sold', [App\Http\Controllers\FinishController::class,'Sold'])->name('item.solds');
    //売却キャンセル機能
    Route::get('/CancelId/{id}',[App\Http\Controllers\FinishController::class,'Cancel'])->name('item.cancel');
    Route::get('/Canceling',[App\Http\Controllers\FinishController::class,'Canceling'])->name('item.canceling');
    //アップデート２
    Route::post('/Updateing/{id}',[App\Http\Controllers\FinishController::class,'Updateing']);
});                                                                                                                                                                                                                                
