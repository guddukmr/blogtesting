<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',['as'=>'home','uses'=>'HomeController@index']);

Route::get('about',['as'=>'about','uses'=>'HomeController@about']);

Route::get('show',"HomeController@show");

Route::post('register',"HomeController@register");

Route::get('edit',[
   'middleware' => 'cheak','uses' =>'HomeController@edit']);
Route::get('update',"HomeController@update");
Route::post('pupdate',"HomeController@pupdate");
Route::get('passwordupdate',"HomeController@passwordupdate");
Route::get('delete',"HomeController@delete");

Route::get('downloadPDF','HomeController@downloadPDF');
Route::get('downloadEXCEL','HomeController@downloadEXCEL');

Route::get('login',['as'=>'login','uses'=> 'HomeController@login']);

Route::post('loginaction',"HomeController@loginaction");
Route::get('forgot',"HomeController@forgot");
Route::post('passwordsend',"HomeController@passwordsend");
Route::get('session1',"HomeController@session1");
Route::post('session2',"HomeController@session2");
Route::post('session3',"HomeController@session3");
Route::post('session4',"HomeController@session4");
Route::post('session5',"HomeController@session5");
Route::post('session6',"HomeController@session6");

Route::get('my-captcha', 'HomeController@myCaptcha')->name('myCaptcha');
Route::post('my-captcha', 'HomeController@myCaptchaPost')->name('myCaptcha.post');
Route::get('blog/public/refresh_captcha', 'HomeController@refreshCaptcha')->name('refresh_captcha');
Route::get('barcode', 'HomeController@barcode');



