@extends('templates.admins.layouts.master')
@section('head.title','Thời gian đăng kí')
@section('admin.body.content')
    <section class="notificationsTeacher">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h4 class="">
                        Tùy chỉnh hệ thống
                    </h4>
                </div>
                <div class="box-body" >
                    <form action="{{route('admin.configuration.save')}}" id="form_set_date" method="POST">
                        {{ csrf_field() }}
                        <div class="max-register" style="margin-left: 15px">
                            <div class="form-group">
                            <label>Số lượng công ty tối đa sv được phép đăng kí</label>
                            <input class="form-control" type="number" name="max_register" value="{{isset($configuration) ? $configuration->max_register : ''}}" style="width:50%">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr/>
                        <label for="" style="margin-left: 15px">Gửi thông báo(<small>sau khi đã phân công giảng viên và chỉnh sửa hoàn tất</small>)</label>
                        <div class="send-notify-student" style="margin-left: 15px">
                            <div class="form-group">
                                <input type="checkbox" name="send-notify-student" id="send-notify-student-0" value="1" style="margin-left: 20px ; margin-right: 10px"
                                @if($configuration->send_notify_student == 1)
                                    checked
                                @endif
                                >
                                <label class=" control-label" for="send-notify-student">Gửi thông báo cho sinh viên</label>
                                
                             </div>
                        </div>
                        <div class="send-notify-teacher" style="margin-left: 15px">
                            <div class="form-group">
                                <input type="checkbox" name="send-notify-teacher" id="send-notify-teacher-0" value="1" style="margin-left: 20px; margin-right: 10px"
                                @if($configuration->send_notify_teacher == 1)
                                    checked
                                @endif
                                >
                                <label class=" control-label" for="send-notify-teacher">Gửi thông báo cho giảng viên</label>
                                
                             </div>
                        </div>
                        <hr/>
                        <div class="time-start">
                            <div class="container">
                                <div class="row">
                                    <div class='col-sm-6'>
                                        <div class="form-group">
                                            <label>Thời gian bắt đầu đăng kí</label>
                                            <div class='input-group date datetimeRegis' id='datetimepicker1'>

                                                <input type='text' class="form-control" data-format="yyyy-MM-dd hh:mm:ss"  name="time_start"
                                                @if(count($configuration) > 0)
                                                    value="{!! $configuration->time_start !!}"
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
                        <hr/>
                        <div class="time-end">
                            <div class="container">
                                <div class="row">
                                    <div class='col-sm-6'>
                                        <div class="form-group">
                                            <label>Thời gian kêt thúc đăng kí</label>
                                            <div class='input-group date datetimeRegis' id='datetimepicker2'>

                                                <input type='text' class="form-control" name="time_end"
                                                @if(count($configuration) > 0)
                                                    value="{{ $configuration->time_end }}"
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
                        <div class="form-group" style="margin-left: 15px">
                            <button class="btn btn-primary" type="submit">Lưu lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection