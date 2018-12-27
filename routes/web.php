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
Auth::routes();

Route::get('/', function () {
    return view('intro');
});

//route admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/getLogin',['as'=>'admin.getLogin', 'uses'=>'Auth\AdminLoginController@showLoginForm']);

    Route::post('/postLogin', ['as'=>'admin.postLogin','uses'=>'Auth\AdminLoginController@postLogin']);

    Route::post('/logout',['as'=>'admin.logout','uses'=>'Auth\AdminLoginController@logout']);

    Route::get('/home', ['as'=>'admin.home','uses'=>'AdminController@home']);

    Route::group(['prefix' => 'survey_ref_mgm'], function () {
        Route::get('/', ['uses' => 'AdminController@survey_ref_mgm']);
        Route::get('/search/{class_search}', ['uses' => 'AdminController@classSearch']);
        route::get('/result/{ma_mh}',['uses' => 'AdminController@result']);
        //Route::get('/delete/class/{ma_mh}',['uses'=>'AdminController@deleteClass']);
    });

    Route::group(['prefix' => 'survey_item_mgm'], function () {
        Route::get('/', ['uses'=> 'AdminController@survey_item_mgm']);
        Route::group(['prefix' => 'category'], function () {
            Route::get('info/{ten_category}', ['uses'=> 'AdminController@infoSurveyCategory']);

            Route::post('edit/submit', ['uses'=> 'AdminController@categoryEditSubmit']);

            Route::post('delete/submit', ['uses'=> 'AdminController@categoryDeleteSubmit']);

            Route::post('add/submit', ['uses' => 'AdminController@categoryAddSubmit']);
            
        });

        Route::group(['prefix' => 'item'], function () {
            Route::get('info/{ma_phieu}', ['uses'=> 'AdminController@infoSurveyItem']);

            Route::post('edit/submit', ['uses'=> 'AdminController@itemEditSubmit']);

            Route::post('delete/submit', ['uses'=> 'AdminController@itemDeleteSubmit']);

            
            Route::post('add/submit', ['uses' => 'AdminController@itemAddSubmit']);
            
        });
    });

    Route::group(['prefix' => 'teacher_mgm'], function () {
        Route::get('/', ['uses' => 'AdminController@teacher_mgm']);
        Route::post('/delete/submit',['uses'=>'AdminController@deleteTeacher']);
        Route::get('/info/{username}', ['uses' => 'AdminController@infoTeacher']);
        Route::post('/edit/submit', ['uses' => 'AdminController@TeacherEditSubmit'] );
        Route::get('/search/{gv_search}', ['uses' => 'AdminController@teacherSearch']);
        Route::post('/import/excel', ['uses'=>'ExcelController@teacherimport']);
        Route::group(['prefix' => 'import'], function () {
            // Route::post('/excel', ['uses'=>'ExcelController@studentimport']);
            Route::post('/1', ['uses' => 'AdminController@teacherAdd1']);
        });
    });

    Route::group(['prefix' => 'student_mgm'], function () {
        Route::get('/', ['uses' => 'AdminController@studentManagement']);
        Route::post('/delete/submit',['uses'=>'AdminController@deleteStudent']);
        Route::get('/info/{id}', ['uses' => 'AdminController@infoStudent']);
        Route::post('/edit/submit', ['uses' => 'AdminController@studentEditSubmit'] );
        Route::get('/search/{sv_search}', ['uses' => 'AdminController@studentSearch']);
        Route::group(['prefix' => 'import'], function () {
            Route::post('/excel', ['uses'=>'ExcelController@studentimport']);
            Route::post('/1', ['uses' => 'AdminController@studentAdd1']);
        });
    });

    Route::get('/result/{ma_mh}', ['uses' => 'AdminController@result']);

}); //end route admin

//route student
Route::group(['prefix' => 'student'], function () {
    Route::group(['prefix' => 'danh_gia'], function () {
        Route::get('/{ma_mh}', ['uses' => 'StudentController@getDanhGia']);
        Route::get('/mark_info/{ma_mh}', ['uses' => 'StudentController@mark_info']);
        Route::post('/post_danh_gia', ['uses' => 'StudentController@postDanhGia']);
        Route::post('/post_danh_gia_lai', ['uses' => 'StudentController@postDanhGiaLai']);
        Route::get('/status/done', ['uses' => 'StudentController@danh_gia_xong']);
    });

    Route::get('/getLogin',['as'=>'student.getLogin', 'uses'=>'Auth\StudentLoginController@showLoginForm']);

    Route::post('/postLogin',['as'=>'student.postLogin','uses'=>'Auth\StudentLoginController@postLogin']);

    Route::post('/logout',['as'=>'student.logout','uses'=>'Auth\StudentLoginController@logout']);
    
    Route::get('/retrieveAll', ['as'=>'student.retrieveAll', 'uses'=>'StudentController@retrieveAll']);
    
    Route::get('/home', ['as'=>'student.home','uses'=>'StudentController@home']);
}); // end route student


//route teacher
Route::group(['prefix' => 'teacher'], function () {
    Route::get('/getLogin',
            [
                'as'=>'teacher.getLogin',
                'uses'=>'Auth\TeacherLoginController@showLoginForm'
            ]
    );
    Route::post('/postLogin',
            [
                'as'=>'teacher.postLogin',
                'uses'=>'Auth\TeacherLoginController@postLogin'
            ]
    );
    Route::get('/home', ['as'=>'teacher.home','uses'=>'TeacherController@home']);
    
    Route::post('/logout', ['as'=>'teacher.logout','uses'=>'Auth\TeacherLoginController@logout']);
    
}); //end route teacher