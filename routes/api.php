<?php

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

Route::get('/reports', function (Request $request) {
    return Cache::remember('reports', 10, function () {
        return Report::orderBy('created_at', 'desc')->take(25)->get();
    });
});
