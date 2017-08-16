<?php

use App\Shard;
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

Route::get('/reports', function (Request $request, $limit = 25) {
    if ($request->has('limit') && is_numeric($request->get('limit'))) {
        $limit = max(5, min(150, $request->get('limit')));
    }
    return Report::orderBy('created_at', 'desc')->paginate($limit)->appends($request->only('limit'));
});

Route::get('/shards', function (Request $request, $limit = 25) {
    if ($request->has('limit') && is_numeric($request->get('limit'))) {
        $limit = max(5, min(50, $request->get('limit')));
    }
    return Shard::orderBy('updated_at', 'desc')->paginate($limit)->appends($request->only('limit'));
});
