<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\AccessTokensController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('authors', AuthorController::class);
Route::post('auth/access-tokens',[AccessTokensController::class,'store'])->middleware('guest:sanctum');
//create // edit
Route::delete('auth/access-tokens/{token?}',[AccessTokensController::class,'destroy'])->middleware('auth:sanctum');