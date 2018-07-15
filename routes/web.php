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
            Route::delete('/{id}', 'TeacherController@delete');

            Route::post('/ajax/table', 'TeacherController@getTableData');
            Route::get('/profile/{id}', 'TeacherController@showProfile');
            Route::post('/upload/teachers-list', 'TeacherController@upload');

        });

        // teacher portfolio
        Route::get('/portfolio', 'PortfolioController@teachers');
        Route::get('/portfolio/download', 'PortfolioController@download');

        /**
         * Category
         */
        Route::prefix('categories')->group(function (){

            Route::get('/type', 'CategoryController@index');
            Route::get('/type/list', 'CategoryController@getTypeList');

            Route::get('/label', 'CategoryController@label');
            Route::get('/label/{id}', 'CategoryController@getLabelList');
            Route::post('/label', 'CategoryController@postLabel');

            Route::get('/sublabel', 'CategoryController@subLabel');
            Route::get('/sublabel/{id}', 'CategoryController@getSubLabelList');
            Route::post('/sublabel', 'CategoryController@postSubLabel');

            Route::get('/knowledge', 'CategoryController@knowledge');
            Route::get('/knowledge/{id}', 'CategoryController@getKnowledgeList');
            Route::post('/knowledge', 'CategoryController@postKnowledge');

            Route::get('/subject', 'CategoryController@subject');
            Route::get('/subject/{id}', 'CategoryController@getSubjectList');
            Route::post('/subject', 'CategoryController@postSubject');

            Route::post('/{id}', 'CategoryController@update');
            Route::delete('/delete/{id}', 'CategoryController@delete');

        });


        /**
         * Master Course
         */

        Route::prefix('master-course')->group(function (){

            Route::get('/create', 'MasterCourseController@create');
            Route::get('/list', 'MasterCourseController@getList');
            Route::get('/', 'MasterCourseController@index');
            Route::get('/{id}', 'MasterCourseController@show');


            Route::post('/', 'MasterCourseController@insert');
            Route::post('/{id}', 'MasterCourseController@update');
            Route::delete('/{id}', 'MasterCourseController@delete');

        });

        Route::prefix('course')->group(function (){

            Route::get('/', 'CourseController@index');
            Route::get('/create', 'CourseController@create');

            Route::post('/ajax/table', 'CourseController@getTableData');
            Route::delete('/{id}/ajax', 'CourseController@delete');
            Route::post('/ajax', 'CourseController@store');
            Route::post('/ajax/{id}', 'CourseController@update');
            Route::delete('/ajax/{id}', 'CourseController@delete');
            Route::post('/upload/inspection-form', 'CourseController@uploadInspection');
            Route::post('/upload/new-course', 'CourseController@uploadCourseList');
            Route::post('/upload/file', 'CourseController@uploadFile');

            Route::get('/search/ajax', 'CourseController@getSearch');

//            @todo move those to Registration Controller
            Route::post('/register/{id}', 'CourseController@getRegister');

            Route::get('/{id}/add-grade', 'CourseController@getAddMarkPage');
            Route::post('/{id}/add-grade', 'CourseController@postAddMark');


            Route::post('/{id}/download/lor', 'CourseController@downloadLor');
            Route::post('/{id}/download-grade-template', 'CourseController@downloadGradeTemplate');



        });

        /**
         * Course type
         */
        Route::prefix('course-type')->group(function (){

            Route::get('/create', 'CourseTypeController@create');
            Route::get('/list', 'CourseTypeController@getList');
            Route::get('/', 'CourseTypeController@index');
            Route::get('/{id}', 'CourseTypeController@show');


            Route::post('/', 'CourseTypeController@insert');
            Route::post('/{id}', 'CourseTypeController@update');
            Route::delete('/{id}', 'CourseTypeController@delete');

        });

        /**
         * Course modality
         */
        Route::prefix('course-modality')->group(function (){


            Route::get('/{courseTypeId}', 'CourseModalityController@index');
            Route::get('/{id}', 'CourseModalityController@show');

            Route::post('/', 'CourseModalityController@insert');
            Route::post('/{id}', 'CourseModalityController@update');
            Route::delete('/{id}', 'CourseModalityController@delete');

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
            Route::post('/{id}/download/diploma', 'RegistrationController@downloadStudentDiploma');




        });

        /**
         * User management routes
         */
        Route::prefix('users')->group(function() {


            Route::get('/',             'UserController@index');
            Route::post('/table/ajax',  'UserController@getTableData');
            Route::post('/ajax',        'UserController@store');
            Route::post('/{id}/ajax',   'UserController@update');
            Route::post('/{id}/change-password',   'UserController@changePassword');

            Route::delete('/{id}/ajax', 'UserController@delete');


        });

        /**
         * Profile routes
         */
        Route::prefix('profile')->group(function() {

            Route::get('/', 'ProfileController@index');
            Route::get('/change-password', 'ProfileController@changePassword');

            Route::post('', 'ProfileController@update');//update profile
            Route::post('/email', 'ProfileController@updateEmail');//update profile
            Route::post('/change-password', 'ProfileController@updatePassword'); //update password



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

            Route::get('/{id}/upload/mark', 'UniversityController@uploadMark');


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