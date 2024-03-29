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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('notes')
    ->namespace('App\Http\Controllers')
    ->group(function () {
    Route::get('/', 'NoteController@index')->name('notes');
    Route::post('/', 'NoteController@store')->name('notes.store');
    Route::get('/{id}', 'NoteController@show')->name('notes.show');
    Route::put('/{id}', 'NoteController@update')->name('notes.update');
    Route::delete('/{id}', 'NoteController@delete')->name('notes.delete');
});

Route::prefix('tags')
    ->namespace('App\Http\Controllers')
    ->group(function () {
    Route::get('/', 'TagController@index')->name('tags');
    Route::post('/', 'TagController@store')->name('tags.store');
    Route::get('/{id}', 'TagController@show')->name('tags.show');
    Route::put('/{id}', 'TagController@update')->name('tags.update');
    Route::delete('/{id}', 'TagController@delete')->name('tags.delete');
});
