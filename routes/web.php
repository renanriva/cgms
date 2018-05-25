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

            Route::post('/ajax/table', 'TeacherController@getTableData');
            Route::get('/profile/{id}', 'TeacherController@showProfile');
            Route::post('/upload', 'TeacherController@upload');


        });

        Route::prefix('course')->group(function (){

            Route::get('/', 'CourseController@index');

            Route::post('/ajax/table', 'CourseController@getTableData');
            Route::delete('/{id}/ajax', 'CourseController@delete');
            Route::post('/ajax', 'CourseController@store');
            Route::post('/ajax/{id}', 'CourseController@update');
            Route::delete('/ajax/{id}', 'CourseController@delete');
            Route::post('/upload/inspection-form', 'CourseController@uploadInspection');

            Route::get('/search/ajax', 'CourseController@getSearch');

//            @todo move those to Registration Controller
            Route::post('/register/{id}', 'CourseController@getRegister');
            Route::post('/register/{id}/upload/inspection', 'CourseController@uploadStudentInspection');


        });

        Route::prefix('registration')->group(function(){

            // by admin
            Route::get('/', 'RegistrationController@index');
            Route::get('/pending', 'RegistrationController@getPending');
            Route::post('/approve/{id}', 'RegistrationController@postApprove');

            Route::post('/{id}/update/{part}', 'RegistrationController@updateRegistration');


            //by teacher
//            Route::post('/register/{id}', 'CourseController@getRegister');
//            Route::post('/register/{id}/upload/inspection', 'CourseController@uploadStudentInspection');
//            Route::post('/register/{id}/update/{part}', 'CourseController@updateRegistration');



        });

        Route::prefix('upcoming-courses')->group(function (){

            Route::get('/', 'UpcomingController@index');
            Route::get('/ajax/table', 'UpcomingController@getTableData');
            Route::post('/upload', 'UpcomingController@uploadCourseRequest');

        });

        Route::prefix('university')->group(function (){

            Route::get('/', 'UniversityController@index');
            Route::get('/ajax', 'UniversityController@getUniversityList');

            Route::post('/ajax/table', 'UniversityController@getTableData');
            Route::post('/ajax/{id}', 'UniversityController@update');
            Route::delete('/ajax/{id}', 'UniversityController@delete');
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