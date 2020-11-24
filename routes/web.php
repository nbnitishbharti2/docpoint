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

/* Start user auth */
Route::get('/user-registration', 'UserController@userRegistration')->name('user.registration');
Route::post('/user-registration', 'UserController@createUser')->name('create.user');
Route::get('/user-login', 'UserController@userLogin')->name('user.login');
/*  End user auth */

/* Start doctor auth */
Route::get('/doctor-registration', 'UserController@doctorRegistration')->name('doctor.registration');
// Route::post('/doctor-registration', 'UserController@createDoctor')->name('create.doctor');
Route::get('/doctor-login', 'UserController@doctorLogin')->name('doctor.login');
/*  End doctor auth */

Route::get('/home', 'HomeController@index')->name('home');


/*website */
Route::any('/doctor-lists', 'DoctorController@liest')->name('doctor.list');


/**
 * Please add all the action that is accessible after valid login to this group.
 */
Route::group(['middleware' => ['auth']], function () {

    // Check user & redirect
    Route::get('/auth', 'AuthController@authenticateUserAndRedirect')->name('auth');

    //Change Password Routes
    Route::post('update-password/{user_id}', 'UserController@updatePassword')->name('update.password');
    Route::get('/user-delete/{user_id}', 'UserController@delete')->name('user.delete');

    // Doctor Routes
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/doctor-list', 'DoctorController@index')->name('doctor.index');
    Route::get('/doctor-add', 'DoctorController@add')->name('doctor.add');
    Route::post('/doctor-add', 'DoctorController@store')->name('doctor.store');
    Route::get('/profile/{id?}', 'DoctorController@myProfile')->name('doctor.profile');
    Route::get('doctor-edit/{id}', 'DoctorController@edit')->name('doctor.edit');
    Route::post('/doctor-edit/{id}', 'DoctorController@update')->name('doctor.update');
    Route::get('/doctor-delete/{doctor_id}', 'DoctorController@delete')->name('doctor.delete');

    // Speciality route
    Route::get('/speciality-add/', 'SpecialityController@add')->name('Speciality.add');
    Route::post('/speciality-add/', 'SpecialityController@store');
    Route::get('/speciality-edit/{specId}', 'SpecialityController@show')->name('Speciality.edit');
    Route::post('/speciality-edit/{specId}', 'SpecialityController@edit');
    Route::get('/speciality-index', 'SpecialityController@index')->name('Speciality.index');
    Route::get('/speciality-delete/{speciality_id}', 'SpecialityController@delete')->name('speciality.delete');

    // Country route
    Route::get('/country-import', 'CountryController@import')->name('country.import');
    Route::post('/country-import', 'CountryController@import')->name('country.import');
    Route::get('/country-export', 'CountryController@export')->name('country.export');
    Route::get('/countries', 'CountryController@index')->name('countries');
    Route::get('/country-edit/{country_id}', 'CountryController@edit')->name('country.edit');
    Route::post('/country-edit/{country_id}', 'CountryController@update')->name('country.update');
    Route::get('/country-delete/{user_id}', 'CountryController@delete')->name('country.delete');
    
    // State route
    Route::get('/state-import/{id}', 'StateController@import')->name('state.import');
    Route::post('/state-import/{id}', 'StateController@import')->name('state.import');
    Route::get('/state-export/{id}', 'StateController@export')->name('state.export');;
    Route::get('/states/{id}', 'StateController@index')->name('states'); 
    Route::get('/state-edit/{state_id}', 'StateController@edit')->name('state.edit');
    Route::post('/state-edit/{state_id}', 'StateController@update')->name('state.update');
    Route::get('/state-delete/{user_id}', 'StateController@delete')->name('states.delete');
    
    // City route
    Route::get('/city-import/{countryid}/{stateid}', 'CityController@import')->name('city.import');
    Route::post('city-import/{countryid}/{stateid}', 'CityController@import')->name('city.import');
    Route::get('/city-export/{countryid}/{stateid}', 'CityController@export')->name('city.export');
    Route::get('/cities/{countryid}/{stateid}', 'CityController@index')->name('cities');
    Route::get('/city-edit/{city_id}', 'CityController@edit')->name('city.edit');
    Route::post('/city-edit/{city_id}', 'CityController@update')->name('city.update');
    Route::get('/city-delete/{user_id}', 'CityController@delete')->name('citie.delete');
    
    // Locality routes
    Route::get('/locality-import/{countryid}/{stateid}/{cityid}', 'LocalityController@import')->name('locality.import');
    Route::post('/locality-import/{countryid}/{stateid}/{cityid}', 'LocalityController@import')->name('locality.import');
    Route::get('/locality-export/{countryid}/{stateid}/{cityid}', 'LocalityController@export')->name('locality.export');
    Route::get('/locality-index/{countryid}/{stateid}/{cityid}', 'LocalityController@index')->name('locality.index');
    Route::get('/locality-edit/{location_id}', 'LocalityController@edit')->name('locality.edit');
    Route::post('/locality-edit/{location_id}', 'LocalityController@update')->name('locality.update');
    Route::get('/location-delete/{user_id}', 'LocalityController@delete')->name('location.delete');
    
    // User routes
    Route::get('/user_groups', 'UserGroupController@index')->name('user_groups');
    Route::get('/users', 'UserController@listUsers')->name('users');
    Route::get('/user_groups_add/', 'UserGroupController@add')->name('user_groups_add');
    Route::post('/user_groups_add/', 'UserGroupController@add')->name('user_groups_add');
    Route::get('/log-history/{user_id}', 'UserController@logHistory')->name('log.history');

    // review for admin
    Route::get('/review', 'ReviewController@index')->name('review');
    Route::get('/change-status/{id}/{status}', 'ReviewController@changeStatus')->name('change-review');

    // Ajax Routes
    Route::post('get-state', 'StateController@getStateOfCountry')->name('get.country.state');
    Route::post('get-city', 'CityController@getCityOfState')->name('get.state.city');

    Route::post('change-doctor-status', 'DoctorController@changeStatus')->name('change.doctor.status');
    Route::post('change-doctor-sponsored-status', 'DoctorController@changeSponsoredStatus')->name('change.doctor.sponsored.status');
    Route::post('change-user-status', 'UserController@changeStatus')->name('change.user.status');
    Route::post('change-speciality-status', 'SpecialityController@changeStatus')->name('change.speciality.status');
    Route::post('change-country-status', 'CountryController@changeStatus')->name('change.country.status');
    Route::post('change-state-status', 'StateController@changeStatus')->name('change.state.status');
    Route::post('change-city-status', 'CityController@changeStatus')->name('change.city.status');
    Route::post('change-location-status', 'LocalityController@changeStatus')->name('change.location.status');
});
