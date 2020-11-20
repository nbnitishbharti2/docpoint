<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Please be carefule before changing existing route defination
| @Author: Chetan Jha
| @Org: KK Web Solutions
|
*/

Route::get('/', 'HomeController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/auth', 'AuthController@authenticateUserAndRedirect')->name('auth');
/**
 * Please add all the action that is accessible after valid login to this group.
 */
Route::group(['middleware' => ['auth']], function () {

    //Change Password Routes
    Route::post('update-password/{user_id}', 'UserController@updatePassword')->name('update.password');
    Route::get('/user-delete/{user_id}', 'UserController@delete')->name('user.delete');

    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/doctor-list', 'DoctorController@index')->name('doctor.index');
    Route::get('/doctor-add', 'DoctorController@add')->name('doctor.add');
    Route::post('/doctor-add', 'DoctorController@store')->name('doctor.store');
    Route::get('/profile/{id?}', 'DoctorController@myProfile')->name('doctor.profile');
    Route::get('doctor-edit/{id}', 'DoctorController@edit')->name('doctor.edit');
    Route::post('/doctor-edit/{id}', 'DoctorController@update')->name('doctor.update');
    Route::get('/doctor-delete/{doctor_id}', 'DoctorController@delete')->name('doctor.delete');


    Route::get('/country-import', 'CountryController@import')->name('country.import');
    Route::post('/country-import', 'CountryController@import')->name('country.import');
    Route::get('/country-export', 'CountryController@export')->name('country.export');
    Route::get('/countries', 'CountryController@index')->name('countries');
    
    Route::get('/state-import/{id}', 'StateController@import')->name('state.import');
    Route::post('/state-import/{id}', 'StateController@import')->name('state.import');
    
    Route::get('/state-export/{id}', 'StateController@export')->name('state.export');;
    Route::get('/states/{id}', 'StateController@index')->name('states');
    
    
    Route::get('/city-import/{countryid}/{stateid}', 'CityController@import')->name('city.import');
    Route::post('city-import/{countryid}/{stateid}', 'CityController@import')->name('city.import');
    
    Route::get('/city-export/{countryid}/{stateid}', 'CityController@export')->name('city.export');
    Route::get('/cities/{countryid}/{stateid}', 'CityController@index')->name('cities');
    
    
    Route::get('/locality-import/{countryid}/{stateid}/{cityid}', 'LocalityController@import')->name('locality.import');
    Route::post('/locality-import/{countryid}/{stateid}/{cityid}', 'LocalityController@import')->name('locality.import');
    
    Route::get('/locality-export/{countryid}/{stateid}/{cityid}', 'LocalityController@export')->name('locality.export');
    Route::get('/locality-index/{countryid}/{stateid}/{cityid}', 'LocalityController@index')->name('locality.index');
    
    Route::get('/speciality-add/', 'SpecialityController@add')->name('Speciality.add');
    Route::post('/speciality-add/', 'SpecialityController@store');
    Route::get('/speciality-edit/{specId}', 'SpecialityController@show')->name('Speciality.edit');
    Route::post('/speciality-edit/{specId}', 'SpecialityController@edit');
    Route::get('/speciality-index', 'SpecialityController@index')->name('Speciality.index');;
    Route::get('/user_groups', 'UserGroupController@index')->name('user_groups');;
    Route::get('/users', 'UserController@listUsers')->name('users');;
    Route::get('/user_groups_add/', 'UserGroupController@add')->name('user_groups_add');
    Route::post('/user_groups_add/', 'UserGroupController@add')->name('user_groups_add');


    // Ajax Routes
    Route::post('get-state', 'StateController@getStateOfCountry')->name('get.country.state');
    Route::post('get-city', 'CityController@getCityOfState')->name('get.state.city');

    Route::post('change-doctor-status', 'DoctorController@changeStatus')->name('change.doctor.status');
    Route::post('change-user-status', 'UserController@changeStatus')->name('change.user.status');
});
