<?php

use App\Http\Controllers\AdminViewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatatablesController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\HMIController;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/export', [DashboardController::class, 'export'])->name('export')->middleware('auth');
//setup
Route::get('/setup', [SetupController::class, 'index'])->middleware('auth');
Route::get('/sku', [SetupController::class, 'sku'])->middleware('auth');
//admin view
Route::get('/admin_view', [AdminViewController::class, 'index'])->name('admin_view')->middleware('auth');
Route::post('/live_admin_view', [AdminViewController::class, 'liveAdminView'])->middleware('auth');
//HMI
Route::get('/hmi', [HMIController::class, 'index'])->name('hmi')->middleware('auth');
Route::post('/live_hmi', [HMIController::class, 'liveHMI'])->middleware('auth');
Route::post('/hmi_list', [DatatablesController::class, 'hmiList'])->middleware('auth');
Route::put('/edit_hmi', [DatatablesController::class, 'editHmi'])->middleware('auth');
//sku
Route::post('/sku_list', [DatatablesController::class, 'skuList'])->middleware('auth');
Route::post('/add_sku', [DatatablesController::class, 'addSKU'])->middleware('auth');
Route::put('/edit_sku', [DatatablesController::class, 'editSKU'])->middleware('auth');
Route::delete('/delete_sku', [DatatablesController::class, 'deleteSKU'])->middleware('auth');
//line
Route::post('/line_list', [DatatablesController::class, 'lineList'])->middleware('auth');
Route::post('/add_line', [DatatablesController::class, 'addLine'])->middleware('auth');
Route::delete('/delete_line', [DatatablesController::class, 'deleteLine'])->middleware('auth');
//machine
Route::post('/machine_list', [DatatablesController::class, 'machineList'])->middleware('auth');
Route::post('/add_machine', [DatatablesController::class, 'addMachine'])->middleware('auth');
Route::put('/edit_machine', [DatatablesController::class, 'editMachine'])->middleware('auth');
Route::delete('/delete_machine', [DatatablesController::class, 'deleteMachine'])->middleware('auth');
//shift
Route::post('/shift_list', [DatatablesController::class, 'shiftList'])->middleware('auth');
Route::post('/add_shift', [DatatablesController::class, 'addShift'])->middleware('auth');
Route::put('/edit_shift', [DatatablesController::class, 'editShift'])->middleware('auth');
Route::delete('/delete_shift', [DatatablesController::class, 'deleteShift'])->middleware('auth');
//pic
Route::post('/pic_list', [DatatablesController::class, 'picList'])->middleware('auth');
Route::post('/add_pic', [DatatablesController::class, 'addPic'])->middleware('auth');
Route::put('/edit_pic', [DatatablesController::class, 'editPic'])->middleware('auth');
Route::delete('/delete_pic', [DatatablesController::class, 'deletePic'])->middleware('auth');
//log
Route::post('/historical_log', [DatatablesController::class, 'historicalLog'])->middleware('auth');
Route::post('/livedata_once', [DashboardController::class, 'liveDataOnce'])->middleware('auth');
Route::post('/livedata', [DashboardController::class, 'liveData'])->middleware('auth');
//account
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/account', [LoginController::class, 'showAccount'])->middleware('auth');
Route::post('/update_password', [LoginController::class, 'updatePassword'])->middleware('auth');
