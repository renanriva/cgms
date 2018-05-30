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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function (){


    Route::prefix('admin')->group(function(){


        Route::get('/unauthorized', 'HomeController@unauthorized');


        Route::prefix('teachers')->group(function (){

            Route::get('/', 'TeacherController@index');
            Route::post('/', 'TeacherController@store');
            Route::get('/new', 'TeacherController@getNew');
            Route::get('/{id}/edit', 'TeacherController@edit');
            Route::post('/{id}', 'TeacherController@update');

            Route::post('/ajax/table', 'TeacherController@getTableData');
            Route::get('/profile/{id}', 'TeacherController@showProfile');
            Route::post('/upload/teachers-list', 'TeacherController@upload');

        });

        // teacher portfolio
        Route::get('/portfolio', 'PortfolioController@teachers');


        Route::prefix('course')->group(function (){

            Route::get('/', 'CourseController@index');

            Route::post('/ajax/table', 'CourseController@getTableData');
            Route::delete('/{id}/ajax', 'CourseController@delete');
            Route::post('/ajax', 'CourseController@store');
            Route::post('/ajax/{id}', 'CourseController@update');
            Route::delete('/ajax/{id}', 'CourseController@delete');
            Route::post('/upload/inspection-form', 'CourseController@uploadInspection');
            Route::post('/upload/new-course', 'CourseController@uploadCourseList');

            Route::get('/search/ajax', 'CourseController@getSearch');

//            @todo move those to Registration Controller
            Route::post('/register/{id}', 'CourseController@getRegister');


        });

        Route::prefix('registration')->group(function(){

            // by admin
            Route::get('/', 'RegistrationController@index');
            Route::get('/pending', 'RegistrationController@getPending');
            Route::post('/approve/{id}', 'RegistrationController@postApprove');
            Route::post('/{id}/update/{part}', 'RegistrationController@updateRegistration');
            Route::post('/{id}/upload/inspection', 'RegistrationController@uploadStudentInspection');


            Route::post('/{id}/download/student-inspection-form', 'RegistrationController@downloadStudentInspectionCertificate');
            Route::post('/{id}/download/certificate', 'RegistrationController@downloadStudentCertificate');



            //by teacher
//            Route::post('/register/{id}', 'CourseController@getRegister');
//            Route::post('/register/{id}/upload/inspection', 'CourseController@uploadStudentInspection');
//            Route::post('/register/{id}/update/{part}', 'CourseController@updateRegistration');



        });

        /**
         * User management routes
         */
        Route::prefix('users')->group(function() {


            Route::get('/',             'UserController@index');
            Route::post('/table/ajax',  'UserController@getTableData');
            Route::post('/ajax',        'UserController@store');
            Route::post('/{id}/ajax',   'UserController@update');
            Route::delete('/{id}/ajax', 'UserController@delete');


        });

        /**
         * Profile routes
         */
        Route::prefix('profile')->group(function() {


        });

        Route::prefix('upcoming-courses')->group(function (){

            Route::get('/', 'UpcomingController@index');
            Route::get('/ajax/table', 'UpcomingController@getTableData');
            Route::post('/upload', 'UpcomingController@uploadCourseRequest');

        });

        Route::prefix('university')->group(function (){

            Route::get('/', 'UniversityController@index');
            Route::get('/ajax', 'UniversityController@getUniversityList');
            Route::get('/{id}', 'UniversityController@view');

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