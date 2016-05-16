<?php

/**
 * Student layer
 */
// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Trang chủ', route('student.index'));
});

// Home > Thông tin cá nhân
Breadcrumbs::register('profile', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Thông tin cá nhân', route('student.seeProfile',Auth::user()->id));
});

Breadcrumbs::register('update-profile', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Thông tin cá nhân', route('student.update',Auth::user()->id));
});
 
Breadcrumbs::register('create-cv', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Tạo CV', route('student.cv.init',Auth::user()->id));
});
 
Breadcrumbs::register('create-cv', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Tạo CV', route('student.cv.create',Auth::user()->id));
});

Breadcrumbs::register('update-cv', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Cập nhật CV', route('student.cv.edit',Auth::user()->id));
});
 
 Breadcrumbs::register('notification', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Thông báo', route('student.notifications',Auth::user()->id));
});
 
 Breadcrumbs::register('register', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Đăng kí thực tập', route('student.regis.index',Auth::user()->id));
});

 Breadcrumbs::register('company-detail', function($breadcrumbs,$company)
{
    $breadcrumbs->parent('register');
    $breadcrumbs->push($company->name, route('student.regis.companyDetail',[Auth::user()->id,$company->id]));
});

 Breadcrumbs::register('report', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Báo cáo', route('student.report.index',Auth::user()->id));
});
 
 Breadcrumbs::register('report', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Báo cáo', route('student.report.add',Auth::user()->id));
});

  Breadcrumbs::register('status', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Tình trạng đăng kí', route('student.status.indentify',Auth::user()->id));
});

Breadcrumbs::register('new', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Tin tức ', route('student.news.index'));
});

Breadcrumbs::register('new_detail', function($breadcrumbs ,$new)
{
    $breadcrumbs->parent('new');
    $breadcrumbs->push($new->title, route('student.news.detail',$new->slug));
});

  Breadcrumbs::register('feedback', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Phản hồi', route('student.feedback.getForm'));
});


  Breadcrumbs::register('change-password', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Đổi mật khẩu', route('student.changePassword.getView',Auth::user()->id));
});


Breadcrumbs::register('teacher_list', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Danh sách giảng viên', route('student.teacherList'));
});


/**
 * Teacher layer
 */

Breadcrumbs::register('home_teacher', function($breadcrumbs)
{
    // $breadcrumbs->parent('home');
    $breadcrumbs->push('Trang chủ', route('teacher.index'));
});

Breadcrumbs::register('profile_teacher', function($breadcrumbs)
{
    $breadcrumbs->parent('home_teacher');
    $breadcrumbs->push('Thông tin giảng viên', route('teacher.pfofile.detail',Auth::guard('teachers')->user()->id));
});

Breadcrumbs::register('profile_teacher_update', function($breadcrumbs)
{
    $breadcrumbs->parent('home_teacher');
    $breadcrumbs->push('Cập nhật thông tin ', route('teacher.profile.edit',Auth::guard('teachers')->user()->id));
});

Breadcrumbs::register('new_teacher', function($breadcrumbs)
{
    $breadcrumbs->parent('home_teacher');
    $breadcrumbs->push('Tin tức', route('teacher.news.index'));
});

Breadcrumbs::register('new_detail_teacher', function($breadcrumbs,$new)
{
    $breadcrumbs->parent('new_teacher');
    $breadcrumbs->push($new->title, route('teacher.news.detail',$new->slug));
});

Breadcrumbs::register('list_student', function($breadcrumbs)
{
    $breadcrumbs->parent('home_teacher');
    $breadcrumbs->push('Danh sách sinh viên hướng dẫn', route('teacher.students.list',Auth::guard('teachers')->user()->id));
});

Breadcrumbs::register('student_specify', function($breadcrumbs,$student)
{
    $breadcrumbs->parent('home_teacher');
    $breadcrumbs->push('Sinh viên '.$student->full_name, route('teacher.student.cvView',$student->id));
});

Breadcrumbs::register('student_report', function($breadcrumbs,$student)
{
    $breadcrumbs->parent('student_specify',$student);
    $breadcrumbs->push('Báo cáo', route('teacher.student.report',$student->id));
});

Breadcrumbs::register('notifications', function($breadcrumbs)
{
    $breadcrumbs->parent('home_teacher');
    $breadcrumbs->push('Thông báo', route('teacher.notifications',Auth::guard('teachers')->user()->id));
});

Breadcrumbs::register('feedback_teacher', function($breadcrumbs)
{
    $breadcrumbs->parent('home_teacher');
    $breadcrumbs->push('Phản hồi', route('teacher.feedback.getForm'));
});
 ?>