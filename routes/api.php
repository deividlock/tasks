<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('project/{id}', function (Request $request) {
    $term = $request->term ?: '';
    $project = DB::table('projects')
        ->where('projects.name', 'like', '%'.$term.'%')
        ->get(['projects.id', 'projects.name as text']);
    return response()->json($project);
});
