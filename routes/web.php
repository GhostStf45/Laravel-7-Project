<?php

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

Route::get('/', function () {
    return view('welcome');
});
//****************************************GENERALES*******************
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//********************************************************************
//---------------------CONFIGURACION DE USUARIOS------------------------------
Route::get('/configuracion', 'UserController@config')->name('config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');

//--------------------CONFIGURACION DE PUBLICACIONES-------------------------------

Route::get('/subir-imagen', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');

Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/imagen/{id}', 'ImageController@detail')->name('image.detail');


//--------------------SECCION DE COMENTARIOS ----------------------------------
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');


//--------------------SECCION DE LIKES-------------------------------------------
Route::get('/likes', 'LikeController@index')->name('likes');

//--------------------PERFIL DEL USUARIO-----------------------------------------
Route::get('/perfil/{id}', 'UserController@profile')->name('profile');


//--------------------CONFIGURACION DE PUBLICACIONES-----------------------------
Route::get('/imagen/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('/imagen/editar/{id}', 'ImageController@edit')->name('image.edit');
Route::post('/imagen/update', 'ImageController@update')->name('image.update');

//--------------------------PAGINA DE GENTE-------------------------------------
Route::get('/gente/{search?}', 'UserController@index')->name('user.index');