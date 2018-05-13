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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//    Route::get('/admin/location/ajax/province', 'ProvinceController@getTableData');


Route::middleware(['auth'])->group(function (){


    Route::prefix('admin')->group(function(){


        Route::prefix('teachers')->group(function (){

            Route::get('/', 'TeacherController@index');

            Route::post('/canton/ajax/table', 'TeacherController@getTableData');
            Route::get('/canton/ajax/{provinceId}', 'TeacherController@getByProvinceId');
            Route::post('/canton/{id}/ajax', 'TeacherController@update');
            Route::delete('/canton/{id}/ajax', 'TeacherController@delete');
            Route::post('/canton/ajax', 'TeacherController@store');


        });

        Route::prefix('course')->group(function (){

            Route::get('/', 'CourseController@index');

            Route::post('/ajax/table', 'CourseController@getTableData');
            Route::delete('/{id}/ajax', 'CourseController@delete');
            Route::post('/ajax', 'CourseController@store');
            Route::post('/ajax/{id}', 'CourseController@update');
            Route::delete('/ajax/{id}', 'CourseController@delete');



        });

        Route::prefix('university')->group(function (){

            Route::get('/', 'UniversityController@index');
            Route::get('/ajax', 'UniversityController@getUniversityList');

            Route::post('/ajax/table', 'UniversityController@getTableData');
            Route::post('/{id}/ajax', 'UniversityController@update');
            Route::delete('/{id}/ajax', 'UniversityController@delete');
            Route::post('/ajax', 'UniversityController@store');


        });

        Route::prefix('location')->group(function(){


            /**
             * Province
             */
            Route::post('/province/ajax/all', 'ProvinceController@getAllData');
            Route::get('/province/ajax/table', 'ProvinceController@getTableData');
            Route::get('/province', 'ProvinceController@index');


            /**
             * Cantons
             */
            Route::post('/canton/ajax/table', 'CantonController@getTableData');
            Route::get('/canton', 'CantonController@index');
            Route::get('/canton/ajax/{provinceId}', 'CantonController@getByProvinceId');
            Route::post('/canton/{id}/ajax', 'CantonController@update');
            Route::delete('/canton/{id}/ajax', 'CantonController@delete');
            Route::post('/canton/ajax', 'CantonController@store');

            /**
             * Parroquia
             */
            Route::post('/parroquia/ajax/table', 'ParroquiaController@getTableData');
            Route::get('/parroquia', 'ParroquiaController@index');
            Route::post('/parroquia/ajax', 'ParroquiaController@store');
            Route::post('/parroquia/{id}/ajax', 'ParroquiaController@update');
            Route::delete('/parroquia/{id}/ajax', 'ParroquiaController@delete');



        });

    });

});