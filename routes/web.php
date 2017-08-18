<?php



Route::get('/', 'PublicController@index');
Route::get('get_pages', 'PublicController@getPages');
Route::post('contact', 'PublicController@contact');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function (){

    Route::resource('admin', 'AdminController', ['only' => ['index', 'destroy']]);
    Route::get('newadmin', 'AdminController@newAdmin')->name('newAdmin');
    Route::post('storeadmin', 'AdminController@storeAdmin');
    Route::get('logout', 'AdminController@logout');

    Route::get('home/{id}', 'HomeController@index')->name('home');
    Route::post('update_box', 'HomeController@updateBox');

    Route::post('update_attribute', 'AttributeController@updateAttribute');

    Route::post('update_info', 'InfoController@updateInfo');

    Route::post('update_event', 'EventDateController@updateEvent');
    Route::post('create_event', 'EventDateController@createEvent');
    Route::get('delete_event/{id}', 'EventDateController@destroy')->name('delete_event');

    Route::post('update_menu', 'MenuController@updateMenu');

    Route::get('breakfast', 'RoomController@index');
    Route::post('update_room', 'RoomController@updateRoom');
    Route::post('create_room', 'RoomController@createRoom');
    Route::get('delete_room/{id}', 'RoomController@destroy')->name('delete_room');

    Route::post('update_extras', 'RoomExtraController@updateExtras');
    Route::post('add_extras', 'RoomExtraController@addExtras');
    Route::get('delete_extra/{id}', 'RoomExtraController@destroy')->name('delete_extra');

});

Route::get('users/verify/{token}', 'AdminController@verify')->name('verify');
Route::post('users', 'AdminController@store')->name('saveUser');