@extends('dashboard.template.index')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/select2.css')}}"/>
    <script type="text/javascript" src="{{asset('assets/global/plugins/select2/select2.js')}}"></script>
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}"/>

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
                {!! Breadcrumbs::render('batches.create') !!}
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

                                    <form role="form" method="post" action="{{route('batches.store')}}"
                                          style="padding-top:10px;">
                                        @include('flash::message')
                                        @include('sweet::alert')
                                        {{csrf_field()}}
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label>Semester</label>
                                                <div class="input-group">
                                                    <script type="text/javascript">
                                                        $(document).ready(function () {
                                                            $(".semester").select2();
                                                        });
                                                    </script>

                                                    <select class="form-control semester" name="semester">
                                                        @foreach($semesters as $semester)
                                                            <option value="{{$semester->id}}">{{$semester->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label>Batch Name</label>
                                                <div class="input-group">
									<span class="input-group-addon">
									</span>
                                                    <input type="text" name="name" value="{{old('name')}}"
                                                           class="form-control" placeholder="Batch Name">

                                                </div>
                                                For example : Batch 1-16.1
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Start dan End Date</label>
                                                        <div class="input-group input-large date-picker input-daterange"
                                                             data-date="2012-12-12" data-date-format="yyyy-mm-dd">
                                                            <input type="text" class="form-control"
                                                                   placeholder="Start Date" name="start_at"
                                                                   value="{{old('start_at')}}" readonly>
												<span class="input-group-addon">
												to </span>
                                                            <input type="text" class="form-control"
                                                                   placeholder="End Date" name="end_at"
                                                                   value="{{old('end_at')}}" readonly>
                                                        </div>
                                                        <!-- /input-group -->
											<span class="help-block">
										</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <div class="input-group">

                                                    <select class="form-control" name="status">
                                                        <option value="1">Active</option>
                                                        <option value="0">Deactive</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label><strong>Registration</strong></label>
                                                        <div class="input-group input-large date-picker input-daterange"
                                                             data-date="2012-12-12" data-date-format="yyyy-mm-dd">
                                                            <input type="text" class="form-control"
                                                                   placeholder="Start Date" name="regist_start_at"
                                                                   value="{{old('regist_start_at')}}" readonly>
												<span class="input-group-addon">
												to </span>
                                                            <input type="text" class="form-control"
                                                                   placeholder="End Date" name="regist_end_at"
                                                                   value="{{old('regist_end_at')}}" readonly>
                                                        </div>
                                                        <!-- /input-group -->
											<span class="help-block">
										</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label><strong>Practice Test</strong></label>
                                                        <div class="input-group input-large date-picker input-daterange"
                                                             data-date="2012-12-12" data-date-format="yyyy-mm-dd">
                                                            <input type="text" class="form-control"
                                                                   placeholder="Start Date" name="practice_start_at"
                                                                   value="{{old('practice_start_at')}}" readonly>
												<span class="input-group-addon">
												to </span>
                                                            <input type="text" class="form-control"
                                                                   placeholder="End Date" name="practice_end_at"
                                                                   value="{{old('practice_end_at')}}" readonly>
                                                        </div>
                                                        <!-- /input-group -->
											<span class="help-block">
										</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label><strong>TPA</strong></label>
                                                        <div class="input-group input-large date-picker input-daterange"
                                                             data-date="2012-12-12" data-date-format="yyyy-mm-dd">
                                                            <input type="text" class="form-control"
                                                                   placeholder="Start Date" name="tpa_start_at"
                                                                   value="{{old('tpa_start_at')}}" readonly>
												<span class="input-group-addon">
												to </span>
                                                            <input type="text" class="form-control"
                                                                   placeholder="End Date" name="tpa_end_at"
                                                                   value="{{old('tpa_end_at')}}" readonly>
                                                        </div>
                                                        <!-- /input-group -->
											<span class="help-block">
										</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label><strong>Interview</strong></label>
                                                        <div class="input-group input-large date-picker input-daterange"
                                                             data-date="2012-12-12" data-date-format="yyyy-mm-dd">
                                                            <input type="text" class="form-control"
                                                                   placeholder="Start Date" name="interview_start_at"
                                                                   value="{{old('interview_start_at')}}" readonly>
												<span class="input-group-addon">
												to </span>
                                                            <input type="text" class="form-control"
                                                                   placeholder="End Date" name="interview_end_at"
                                                                   value="{{old('interview_end_at')}}" readonly>
                                                        </div>
                                                        <!-- /input-group -->
											<span class="help-block">
										</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions"
                                             style="background-color:#FFFFFF;align:center;text-align:center;">
                                            <button type="submit" class="btn blue">Submit</button>
                                            <button type="button" class="btn default">Cancel</button>
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
    </div>
    <!-- END CONTENT -->
@stop
@section('js')

    <script type="text/javascript"
            src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>


    <script src="{{asset('assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/layout/scripts/layout.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/layout/scripts/quick-sidebar.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/layout/scripts/demo.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/pages/scripts/components-pickers.js')}}"></script>




    <script>
        jQuery(document).ready(function () {
            // initiate layout and plugins
            Metronic.init(); // init metronic core components
            Layout.init(); // init current layout
            Demo.init(); // init demo features
            ComponentsPickers.init();
        });
    </script>


@stop
