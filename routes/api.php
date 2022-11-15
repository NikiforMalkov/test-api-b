<?php

use App\Category\Controllers\CategoriesController;
use App\Item\Controllers\ItemsController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('category/all', [CategoriesController::class, 'all']);
Route::put('category/{id}', [CategoriesController::class, 'update']);
Route::get('item/search', [ItemsController::class, 'search']);
