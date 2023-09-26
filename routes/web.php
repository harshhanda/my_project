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


	Route::get('/', "HomeController@index");
	Route::get('about',"HomeController@about")->name('about');
    Route::get('contact','HomeController@contact')->name('contact');
    Route::get('properties','HomeController@properties')->name('properties');
    Route::get('services','HomeController@services')->name('services');
    Route::get('property-single','HomeController@propertySingle')->name('property-single');
 
	Route::get('login', 'Auth\LoginController@showLoginForm');
	Route::post('login', 'Auth\LoginController@login')->name('login'); 

	Route::match(['get','post'],'/change-password', 'Admin\AdminController@changePassword')->name('changepassword');
 
	Route::group(['prefix'=>'admin','as'=>'admin','middleware'=>['auth','checkadmin'],'as'=>'admin.'],function() {
		
		Route::match(['get','post'],'/logout','Auth\LoginController@logout')->name('logout');
		Route::match(['get','post'],'/dashboard', 'Admin\DashboardController@index');




		Route::group(['prefix'=>'slider'],function(){

			Route::match(['get','post'],'add','Admin\SliderController@add')->name('slider.add');
			
			Route::get('list','Admin\SliderController@list');
			
			Route::get('update/{id}','Admin\SliderController@update');
				
			Route::post('/changeStatus','Admin\SliderController@changeStatus')->name('slider.changeStatus');

			Route::get('delete/{id}','Admin\SliderController@delete');

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		});





 
		
	});


	Route::match(['get','post'],'/logout','Auth\LoginController@logout')->name('logout');
