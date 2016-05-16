<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => 'web'], function () {
	 
	/*==========================================================
	 * ==Authentication for students: login, register, logout===
	 * =========================================================
     */
    Route::auth();
    Route::get('/register/verify/{confirmation_code}',[
    	'as' 	=> 'confirmation_path',
   		'uses'	=> 'Auth\AuthController@confirm'
    ]);
    // End section 
    

    /*========================================
     *======= Authentication for admins ======
     *========================================
     */
    
    /**
     * Login handle
     */
    Route::get('/admin/login',[
        'as'   => 'admin.getLogin',
        'uses' => 'AdminAuth\AdminAuthController@getLogin'
    ]);
    Route::post('/admin/login',[
        'as'   => 'admin.postLogin',
        'uses' => 'AdminAuth\AdminAuthController@postLogin'
    ]);
    Route::get('/admin/logout',[
        'as'   => 'admin.getLogout',
        'uses' => 'AdminAuth\AdminAuthController@getLogout'
    ]);
    
    /*============================================
     * ======Authentication for teacher===========
     * ===========================================
     */
    
    /**
     * Register handle
     */
    Route::post('/giang-vien/dang-ki',[
        'as'    => 'teacher.postRegister',
        'uses'  => 'TeacherAuth\TeacherAuthController@postRegister'
    ]);

    /**
     * Login handle
     */
    Route::get('/giang-vien/dang-nhap',[
        'as'    => 'teacher.getLogin',
        'uses'  => 'TeacherAuth\TeacherAuthController@getLogin'
    ]);
    Route::post('/giang-vien/dang-nhap',[
        'as'    => 'teacher.postLogin',
        'uses'  => 'TeacherAuth\TeacherAuthController@postLogin'
    ]);
    /**
     * Logout
     */
    Route::get('/giang-vien/dang-xuat',[
        'as'    => 'teacher.logout',
        'uses'  => 'TeacherAuth\TeacherAuthController@getLogout'
    ]);
    /**
     * Verify teacher registered
     */
    Route::get('/giang-vien/dang-ki/xac-nhan/{confirmation_code}',[
        'as'    => 'teacher.verify',
        'uses'  => 'TeacherAuth\TeacherAuthController@confirmTeacher'
    ]);
    
    /*================================================
     * =========== Student panel =====================
     *================================================
     */
    Route::group(['prefix'=>'sinh-vien','middleware'=>'auth'],function(){
        Route::get('/',[
            'as'    => 'student.index',
            'uses'  => 'UserController@index'
        ]); 

        /**
         * See profile
         */
        Route::get('/thong-tin-ca-nhan/{id}',[
            'as'    => 'student.seeProfile',
            'uses'  => 'UserController@seeProfile'

        ]);
        /**
         * Update profile
         */
        Route::get('/cap-nhat-thong-tin/{id}',[
            'as'    => 'student.update',
            'uses'  => 'UserController@update'
        ]);
        Route::post('/cap-nhat-thong-tin/{id}',[
            'as'    => 'student.store',
            'uses'  => 'UserController@store'
        ]);
        

        /**
         * CV create, update , view
         */
        Route::get('/{id}/cv',[
            'as'    => 'student.cv.init',
            'uses'  => 'CvController@init'
        ]);
        Route::get('/{id}/cv/xem',[
            'as'    => 'student.cv.view',
            'uses'  => 'CvController@view'
        ]);
        Route::get('/{id}/cv/tao',[
            'as'    => 'student.cv.create',
            'uses'  => 'CvController@create'
        ]);
        Route::post('/{id}/cv/tao',[
            'as'    => 'student.cv.store',
            'uses'  => 'CvController@store'
        ]);
        Route::get('/{id}/cv/sua',[
            'as'    => 'student.cv.edit',
            'uses'  => 'CvController@edit'
        ]);
        Route::post('/{id}/cv/edit',[
            'as'    => 'student.cv.update',
            'uses'  => 'CvController@update'
        ]);

        /**
         * Notification 
         */
        Route::group(['prefix'=>'/{id}/thong-bao'],function(){
            Route::get('/',[
                'as'    => 'student.notifications',
                'uses'  => 'UserController@notifications'
            ]);
            Route::get('/delete',[
                'as'    => 'student.notification.delete',
                'uses'  => 'UserController@deleteNotify'
            ]);
            Route::post('/update',[
                'as'    => 'student.notification.updateNotify',
                'uses'  => 'UserController@updateNotify'
            ]);
        });
        
        /**
         * Register company you want to intern
         */
        Route::get('/{id}/dang-ki-thuc-tap',[
            'as'    => 'student.regis.index',
            'uses'  => 'RegisController@index',
        ]);
        Route::post('/{id}/dang-ki-thuc-tap',[
            'as'    => 'student.regis.store',
            'uses'  => 'RegisController@store'
        ]);
        Route::get('/dang-ki-thuc-tap/search-result',[
            'as'    => 'student.regis.search_ajax',
            'uses'  => 'RegisController@search_ajax'
        ]);
        
        Route::get('/{id}/dang-ki-thuc-tap/{company_id}',[
            'as'    => 'student.regis.companyDetail',
            'uses'  => 'RegisController@companyDetail' 
        ]);
        /**
         * Weekly Report For Topic Process
         */
        Route::get('/{id}/bao-cao',[
            'middleware'    => 'auth',
            'as'    => 'student.report.index',
            'uses'  => 'ReportController@index'
        ]);
        Route::get('/{id}/bao-cao/tao-moi',[
            'as'    => 'student.report.add',
            'uses'  => 'ReportController@add'
        ]);
        Route::post('/{id}/bao-cao/tao-moi',[
            'as'    => 'student.report.store',
            'uses'  => 'ReportController@store'
        ]);

        
        /**
         * Register Status
         */
        Route::get('/{id}/tinh-trang-dang-ki',[
            'middleware' => 'auth',
            'as'         =>  'student.status.indentify',
            'uses'       => 'StatusController@status_identify'  
        ]);
        Route::post('/tinh-trang-dang-ki/{id}',[
            'middleware'=> 'auth',
            'as'        => 'student.status.confirm_choosen_company',
            'uses'      => 'StatusController@confirm_choosen_company'
        ]);

        /**
        * News process
        */
       Route::group(['prefix'=> 'tin-tuc','middleware'=>'auth'],function(){
            Route::get('/',[
                'as'   => 'student.news.index',
                'uses' => 'NewsController@index'
            ]);
            Route::get('/{slug}',[
                'as'    => 'student.news.detail',
                'uses'  => 'NewsController@detail'
            ]);

       });

       /**
         * Feedback
         */
        Route::get('/phan-hoi',[
            'as'   => 'student.feedback.getForm',
            'uses' =>  'FeedbackController@getForm'
        ]);
        Route::post('/phan-hoi',[
            'as'   => 'student.feedback.saveForm',
            'uses' =>  'FeedbackController@saveForm'
        ]);

        /**
         * List all teacher with information
         */
        Route::get('/danh-sach-giang-vien',[
            'as'    => 'student.teacherList',
            'uses'  => 'TeacherController@teacherList'
        ]);

        /**
         * Change password 
         */
        Route::get('/{id}/doi-mat-khau',[
            'as'    => 'student.changePassword.getView',
            'uses'  => 'UserController@viewChangePassword'
        ]);

        Route::post('/{id}/doi-mat-khau',[
            'as'    => 'student.changePassword.postData',
            'uses'  => 'UserController@postChangePassword'
        ]);

        Route::post('/{id}/check-old-password',[
            'as'    => 'student.changePassword.check',
            'uses'  => 'UserController@checkOldPassword'
        ]);
    });

    /**=========================================================
     * =========== Admin panel =================================
     * =========================================================
     */
    Route::group(['prefix'=> 'admin'],function (){
        Route::get('/',[
            'as'    => 'admin.index',
            'uses'  => 'AdminController@index'
        ]);
        /**
         *  News management
         */
        Route::group(['prefix'=>'tin-tuc','middleware'=> 'admins'],function(){
            Route::get('/',[
             'as'  => 'admin.news.index',
             'uses'=> 'NewsController@index' 
             ]);
            Route::get('/tao-moi',[
                'as'  => 'admin.news.add',
                'uses'=> 'NewsController@add'
            ]);
            Route::post('/tao-moi',[
                'as'  => 'admin.news.store',
                'uses'=> 'NewsController@store'
            ]);
            Route::get('/{id}/sua',[
                'as'  => 'admin.news.edit',
                'uses'=> 'NewsController@edit'
            ]);
            Route::post('/{id}/sua',[
                'as'  => 'admin.news.update',
                'uses'=> 'NewsController@update'  
            ]);
            Route::get('/{id}/delete',[
                'as'  => 'admin.news.delete',
                'uses'=> 'NewsController@delete'
            ]);

        });
        //End news process
        
        /**
         * Company process
         */
        Route::group(['prefix'=> 'cong-ty'],function(){
            Route::get('/',[
                'as'    => 'admin.companies.index',
                'uses'  => 'CompanyController@index'
            ]);
            Route::get('/them',[
                'as'    => 'admin.companies.add',
                'uses'  => 'CompanyController@add'
            ]);
            Route::post('/them',[
                'as'    => 'admin.companies.store',
                'uses'  => 'CompanyController@store'
            ]);
            Route::get('/{id}/edit',[
                'as'    => 'admin.companies.edit',
                'uses'  => 'CompanyController@edit'
            ]);
            Route::post('/{id}/edit',[
                'as'    => 'admin.companies.update',
                'uses'  => 'CompanyController@update'
            ]);
             Route::get('/{id}/delete',[
                'as'    => 'admin.companies.delete',
                'uses'  => 'CompanyController@delete'
            ]);
            
        });
        //End compnaies manange process

        /**
         * Register Time Management
         */
        Route::group(['prefix'=>'configuration'],function(){
            Route::get('/',[
                'as'    => 'admin.configuration.index',
                'uses'  => 'ConfigurationController@index'
            ]) ;
            Route::post('/save',[
                'as'    => 'admin.configuration.save',
                'uses'  => 'ConfigurationController@save'
            ]);
        });


        /**
         * Feedback management
         */
        Route::group(['prefix'=> 'feed-back'],function(){
            Route::get('/',[
                'as'    => 'admin.feedback.index',
                'uses'  => 'FeedbackController@index'
            ]);
            Route::post('/{id}/edit',[
                'as'    => 'admin.feedback.update',
                'uses'  => 'FeedbackController@update'
            ]);
            Route::get('/{id}/detail',[
                'as'    => 'admin.feedback.detail',
                'uses'  => 'FeedbackController@detail'
            ]);
            Route::post('/{id}/delete',[
                'as'    => 'admin.feedback.delete',
                'uses'  => 'FeedbackController@delete'
            ]);
        });
        //End feedback process

        /**
         * Infos management process: About, Contact 
         */
        Route::group(['prefix'=> 'thong-tin-nha-phat-trien'],function(){
            Route::get('/',[
                'as'    => 'admin.infos.index',
                'uses'  => 'InfoController@index'
            ]);
            Route::post('/sua',[
                'as'    => 'admin.infos.update',
                'uses'  => 'InfoController@update'
            ]);
        });
        //End of infos process
        
        /**
         * Slide management
         */
        Route::group(['prefix'=> 'slide'],function(){
            Route::get('/',[
                'as'    => 'admin.slides.index',
                'uses'  => 'SlideController@index'
            ]);
            Route::get('/them-moi',[
                'as'    => 'admin.slides.add',
                'uses'  => 'SlideController@add'
            ]);
            Route::post('/them-moi',[
                'as'    => 'admin.slides.store',
                'uses'  => 'SlideController@store'
            ]);
            Route::get('/{id}/xoa',[
                'as'    => 'admin.slides.delete',
                'uses'  => 'SlideController@delete'
            ]);
            Route::get('/{id}/sua',[
                'as'    => 'admin.slides.edit',
                'uses'  => 'SlideController@edit'
            ]);
            Route::post('/{id}/sua',[
                'as'    => 'admin.slides.update',
                'uses'  => 'SlideController@update'
            ]);
        });
        //End slide 
        
        /**
         * Student Management
         */
        Route::group(['prefix'=>'sinh-vien','middleware'=>'admins'],function(){
            Route::get('/',[
                'as'    => 'admin.students.manageStudents',
                'uses'  => 'UserController@manageStudents'
            ]);

            Route::post('/phan-cong-giang-vien',[
                'as'    => 'admin.students.allocateTeacher',
                'uses'  => 'UserController@allocateTeacher'
            ]);
        });

        /**
         *  Schoolyear managements
         */
        Route::group(['prefix'=> 'khoa-hoc'],function(){
            Route::get('/',[
                'as'    => 'admin.schoolyears.index',
                'uses'  => 'SchoolyearController@index'
            ]);
            Route::post('/{id}/sua',[
                'as'    => 'admin.shoolyears.edit',
                'uses'  => 'SchoolyearController@edit'
            ]);
            Route::post('/them',[
                'as'    => 'admin.schoolyears.add',
                'uses'  => 'SchoolyearController@add'
            ]);
            Route::get('/{id}/delete',[
                'as'    => 'admin.shoolyears.delete',
                'uses'  => 'SchoolyearController@delete'
            ]);
        });
        //End schoolyear process
        
        /**
         * Status Register Manage
         */
        Route::group(['prefix'=> 'tinh-trang-dang-ki','middleware'=> 'admins'],function(){
            Route::get('/',[
                'as'    => 'admin.status.index',
                'uses'  => 'StatusController@index'
            ]);
            Route::post('/{id}/cap-nhat',[
                'as'    => 'admin.status.update',
                'uses'  => 'StatusController@update'
            ]);
        });

        /**
         * List all topic of student with teacher instructor and company intern
         */
        Route::get('/danh-sach-chu-de-dang-ki',[
            'middleware'=> 'admins',
            'as'        => 'admin.listTopic',
            'uses'      => 'TopicController@listTopic'
        ]);

        /**
         * Notify Management
         */
        
        Route::group(['prefix'=>'thong-bao'],function(){
            Route::post('/sua',[
                'as'    => 'admin.notify.editNotify',
                'uses'  => 'AdminController@editNotify' 
            ]);
            Route::get('/danh-sach',[
                'as'    => 'admin.notify.listNotify',
                'uses'  => 'AdminController@listNotify'
            ]);
            Route::get('/{id}',[
                'as'    => 'admin.notify.notifyDetail',
                'uses'  => 'AdminController@notifyDetail'
            ]);
            Route::post('/lien-he/cap-nhat',[
                'as'    => 'admin.notify.contacted',
                'uses'  => 'AdminController@contacted'
            ]);
            Route::get('/{user_id}/cv',[
                'as'    => 'admin.notify.cvView',
                'uses'  => 'CvController@view'
            ]);

        });

        /**
         * Partner images 
         */
        Route::group(['prefix'=>'partner'],function(){
            Route::get('/',[
                'as'    => 'admin.partner.index',
                'uses'  => 'PartnerController@index'
            ]);
            Route::get('/add',[
                'as'    => 'admin.partner.add',
                'uses'  => 'PartnerController@add'
            ]);
            Route::post('/add',[
                'as'    => 'admin.partner.store',
                'uses'  => 'PartnerController@store'
            ]);
            Route::get('/{id}/delete',[
                'as'    => 'admin.partner.delete',
                'uses'  => 'PartnerController@delete'
            ]);
        });
    });
    //End of admin process
    

    /*=========================================================
     *============== Teacher Panel ============================
     *========================================================= 
     */
    Route::group(['prefix'=>'giang-vien','middleware'=>'teachers'],function(){
        Route::get('/',[
            'as'   => 'teacher.index',
            'uses' => 'TeacherController@index'    
        ]);

        /**
         * Profile
         */
        Route::group(['prefix'=>'/{id}/thong-tin-ca-nhan'],function(){
            Route::get('/chi-tiet',[
                'as'    => 'teacher.pfofile.detail',
                'uses'  => 'TeacherController@getProfile'
            ]);
            Route::get('/cap-nhat',[
                'as'    => 'teacher.profile.edit',
                'uses'  => 'TeacherController@edit'
            ]);
            Route::post('/cap-nhat',[
                'as'    => 'teacher.profile.update',
                'uses'  => 'TeacherController@update'
            ]);

        });

        /**
        * News process
        */
       Route::group(['prefix'=> 'tin-tuc','middleware'=>'teachers'],function(){
            Route::get('/',[
                'as'   => 'teacher.news.index',
                'uses' => 'NewsController@index'
            ]);
            Route::get('/{slug}',[
                'as'    => 'teacher.news.detail',
                'uses'  => 'NewsController@detail'
            ]);
       });

       /**
        * List student involved
        */
       Route::group(['prefix'=> '/{teacher_id}/danh-sach-sv-huong-dan'],function(){
            Route::get('/',[
                'middleware'=> 'teachers',
                'as'    => 'teacher.students.list',
                'uses'  => 'UserController@listStudents'
            ]);
       });
       Route::get('/sinh-vien-huong-dan/{user_id}/bao-cao',[
            'middleware'    => 'teachers',
            'as'            => 'teacher.student.report',
            'uses'          => 'ReportController@index'
        ]);

        /**
         * Notification 
         */
         Route::group(['prefix'=>'/{teacher_id}/thong-bao'],function(){
            Route::get('/',[
                'as'    => 'teacher.notifications',
                'uses'  => 'TeacherController@notifications'
            ]);
            Route::get('/delete',[
                'as'    => 'teacher.notification.delete',
                'uses'  => 'TeacherController@deleteNotify'
            ]);
            Route::post('/{id}/chap-nhan',[
                'as'    => 'teacher.notification.acceptance',
                'uses'  => 'UserController@teacherAcceptance'
            ]);
            Route::post('/cap-nhat',[
                'as'    => 'teacher.notification.update',
                'uses'  => 'TeacherController@updateNotify'
            ]);
        });

        /**
         *  View cv of student
         */
        Route::get('/xem/sinh-vien/{user_id}/cv',[
            'as'    => 'teacher.student.cvView',
            'uses'  => 'CvController@view'
        ]);

        /**
         * Feedback
         */
        Route::get('/phan-hoi',[
            'as'   => 'teacher.feedback.getForm',
            'uses' =>  'FeedbackController@getForm'
        ]);
        Route::post('/phan-hoi',[
            'as'   => 'teacher.feedback.saveForm',
            'uses' =>  'FeedbackController@saveForm'
        ]);
        /**
         * Change password 
         */
        Route::get('/{id}/doi-mat-khau',[
            'as'    => 'teacher.changePassword.getView',
            'uses'  => 'TeacherController@viewChangePassword'
        ]);

        Route::post('/{id}/doi-mat-khau',[
            'as'    => 'teacher.changePassword.postData',
            'uses'  => 'TeacherController@postChangePassword'
        ]);

        Route::post('/{id}/check-old-password',[
            'as'    => 'teacher.changePassword.check',
            'uses'  => 'TeacherController@checkOldPassword'
        ]);
    });

    
    
    /*==========================================================
     *== Route to shared process and view among 3 layer using ==
     *==========================================================
     */
    
    /**
    * Comment weekly report process
    */
    Route::post('/bao-cao/{report_id}/binh-luan',[
        'as'    => 'report.comment',
        'uses'  => 'ReportController@comment'
    ]);

    Route::get('/', 'HomeController@index');

    Route::get('/export/{id}',[
        'as'    => 'export.pdf',
        'uses'  => 'CvController@export'
    ]);
   
});
