@extends('dashboard.template.index')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/select2.css')}}"/>
    <script type="text/javascript" src="{{asset('assets/global/plugins/select2/select2.js')}}"></script>
    @stop
    @section('content')
            <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">


            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                {{ $pageTitle }}
                <small> {{$pageDesc}} </small>
            </h3>
            <div class="page-bar">
                {!! Breadcrumbs::render('students.create') !!}
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">

                <div class="col-md-12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet box ">
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <div class="portlet-body form">

                                    <form role="form" method="post" action="{{route('students.store')}}"
                                          style="padding-top:10px;">
                                        @include('flash::message')
                                        @include('sweet::alert')
                                        {{csrf_field()}}
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label>NIM</label>
                                                <div class="input-group">

                                                    <input type="text" name="nim" value="{{old('nim')}}"
                                                           class="form-control" placeholder="Student NIM">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div class="input-group">
									<span class="input-group-addon">

									</span>
                                                    <input type="text" name="name" value="{{old('name')}}"
                                                           class="form-control" placeholder="Full Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Nickname</label>
                                                <div class="input-group">
									<span class="input-group-addon ">
									<i class="fa fa-user"></i>
									</span>
                                                    <input type="text" name="nickname" value="{{old('nickname')}}"
                                                           class="form-control" placeholder="Nickname">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <div class="input-group">
                                                    <input type="text" name="phone"
                                                           value="{{old('phone')}}" class="form-control"
                                                           placeholder="Phone Number">
									<span class="input-group-addon">
									<i class="fa fa-lock"></i>
									</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div class="input-group">
                                                    <input type="email" name="email"
                                                           value="{{old('email')}}" class="form-control"
                                                           placeholder="Email Address">
									<span class="input-group-addon">
									<i class="fa fa-lock"></i>
									</span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-actions"
                                             style="background-color:#FFFFFF;align:center;text-align:center;">
                                            <button type="submit" class="btn blue">Submit</button>
                                            <a href="{{ route('students.index') }}">
                                                <button type="button" class="btn default">Cancel</button>
                                            </a>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END SAMPLE FORM PORTLET-->

                            <div class="col-md-3">
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
    <!-- END CONTENT -->
@stop
@section('js')
    <script src="{{asset('assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/layout/scripts/layout.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/layout/scripts/quick-sidebar.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/layout/scripts/demo.js')}}" type="text/javascript"></script>


    <script>
        jQuery(document).ready(function () {
            // initiate layout and plugins
            Metronic.init(); // init metronic core components
            Layout.init(); // init current layout
            QuickSidebar.init(); // init quick sidebar
            Demo.init(); // init demo features
        });
    </script>
@stop
