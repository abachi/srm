<?php

use App\Http\Controllers\Api\ResourceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/resources', [ResourceController::class, 'index']);

Route::get('/resources/{id}/download', [ResourceController::class, 'download']);

Route::post('/resources/{id}/delete', [ResourceController::class, 'delete'])->name('resources.delete');

Route::get('/resources/{resource_type}/{id}', [ResourceController::class, 'show'])->name('resources.show');
Route::post('/resources/{resource_type}/{id}', [ResourceController::class, 'update'])->name('resources.update');

Route::post('/resources', [ResourceController::class, 'store'])->name('resources.store');

Route::get('/resources-types', [ResourceController::class, 'types']);


