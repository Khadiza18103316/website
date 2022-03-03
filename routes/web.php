<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\RingtoneController;

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


//Backend
Route::group(array('namespace'=>'Backend','middleware'=>'auth'),
function(){
    Route::resource('/ringtones','RingtoneController');
    Route::resource('/photos','PhotoController');
});

//Frontend
Route::group(array('namespace'=>'Frontend'),
function(){
    Route::get('/','RingtoneController@index');
    Route::get('/ringtones/{id}/{slug}','RingtoneController@show')
    ->name('ringtones.show');
    Route::get('/category/{id}','RingtoneController@category')
    ->name('ringtones.category');
    Route::get('/wallpapers','RingtoneController@wallpaper');
});