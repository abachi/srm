<?php

use App\Http\Controllers\Admin\ResourceController as AdminResourceController;
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


Route::get('/admin',[AdminResourceController::class, 'index'])->name('admin.index');

Route::view('/{any}', 'admin.dashboard')
    ->where('any', '.*');

