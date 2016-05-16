@extends('templates.admins.layouts.master')
@section('head.title','Thời gian đăng kí')
@section('admin.body.content')
    <section class="notificationsTeacher" style="padding-top: 100px">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h4 class="">
                        Tùy chỉnh thời gian đăng kí thực tập
                    </h4>
                </div>
                <div class="box-body" style="margin-top: 50px">
                    <form action="" id="form_set_date">
                        {{ csrf_field() }}
                        <div class="time-start">
                            <div class="container">
                                <div class="row">
                                    <div class='col-sm-6'>
                                        <div class="form-group">
                                            <label>Thời gian bắt đầu đăng kí</label>
                                            <div class='input-group date datetimeRegis' id='datetimepicker1'>

                                                <input type='text' class="form-control" data-format="yyyy-MM-dd hh:mm:ss" 
                                                @if(count($time) > 0)
                                                    value={{ $time->time_start }}
                                                @endif
                                                />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="time-end">
                            <div class="container">
                                <div class="row">
                                    <div class='col-sm-6'>
                                        <div class="form-group">
                                            <label>Thời gian kêt thúc đăng kí</label>
                                            <div class='input-group date datetimeRegis' id='datetimepicker2'>

                                                <input type='text' class="form-control" 
                                                @if(count($time) > 0)
                                                    value={{ $time->time_end }}
                                                @endif
                                                />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection