<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TikTokController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/api/download', [TikTokController::class, 'download']);
