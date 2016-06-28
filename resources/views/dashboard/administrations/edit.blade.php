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
                {!! Breadcrumbs::render('administrations.edit', $oprec->id) !!}
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">

                <div class="col-md-12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet box ">
                        <div class="row">
                            {{-- <div class="col-md-3">
                             </div>--}}
                            <div class="col-md-6">
                                <div class="portlet-body form">

                                    <form role="form" method="post"
                                          action="{{route('administrations.update', ['id' => $oprec->id])}}"
                                          style="padding-top:10px;">
                                        <input type="hidden" name="_method" value="PATCH">

                                        {{csrf_field()}}
                                        <div class="form-body">
                                            @include('flash::message')
                                            @include('sweet::alert')
                                            <div class="form-group">
                                                <label>Registration ID</label>
                                                <div class="input-group">
									<span class="input-group-addon">
									</span>
                                                    <input type="text" name="id"
                                                           value="{{$oprec->id}}"
                                                           class="form-control" placeholder="Registration ID" readonly>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Registration Date</label>
                                                <div class="input-group">
									<span class="input-group-addon">
									</span>
                                                    <input type="text" name="id"
                                                           value="{{$oprec->created_at}}"
                                                           class="form-control" placeholder="Registration Date"
                                                           readonly>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>NIM</label>
                                                <div class="input-group">
									<span class="input-group-addon">
									</span>
                                                    <input type="text" name="nim"
                                                           value="{{$oprec->students->nim}}"
                                                           class="form-control" placeholder="NIM" readonly>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div class="input-group">
									<span class="input-group-addon">
									</span>
                                                    <input type="text" name="name"
                                                           value="{{$oprec->students->name}}"
                                                           class="form-control" placeholder="Student Name" readonly>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Subjects</label>
                                                <div class="input-group">
                                                    <ul>
                                                        @foreach($oprec->selectedsubjects as $subject)
                                                            <li>{{$subject->name}}</li>
                                                        @endforeach
                                                    </ul>

                                                </div>
                                            </div>

                                            {{--<div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Start dan End Date</label>
                                                        <div class="input-group input-large date-picker input-daterange"
                                                             data-date="2012-12-12" data-date-format="yyyy-mm-dd">
                                                            <input type="text" class="form-control"
                                                                   placeholder="Start Date" name="start_at"
                                                                   value="{{$semester->start_at or old('start_at')}}"
                                                                   readonly>
												<span class="input-group-addon">
												to </span>
                                                            <input type="text" class="form-control"
                                                                   placeholder="End Date" name="end_at"
                                                                   value="{{$semester->end_at or old('end_at')}}"
                                                                   readonly>
                                                        </div>
                                                        <!-- /input-group -->
											<span class="help-block">
										</span>
                                                    </div>
                                                </div>
                                            </div>--}}
                                            <div class="form-group">
                                                <label>Accept ?</label>
                                                <div class="input-group">

                                                    <select class="form-control" name="status">
                                                        <option value="1">
                                                            Accept
                                                        </option>
                                                        <option value="0">
                                                            Decline
                                                        </option>
                                                    </select>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="form-actions"
                                             style="background-color:#FFFFFF;align:center;text-align:center;">
                                            <button type="submit" class="btn blue">Submit</button>
                                            <a href="{{route('administrations.index')}}" type="button"
                                               class="btn default">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END SAMPLE FORM PORTLET-->

                            <div class="col-md-6">
                                <div class="form-body" style="padding-top:10px;">
                                    <div class="row">
                                        <div class="col-md-12" style="align:center;text-align: center">
                                            <img src="{{asset('/upload/'.$oprec->file->photo)}}"
                                                 style="max-size:200px;max-height:200px;align:center;text-align: center"/>
                                            <p>{{$oprec->file->photo}}</p>
                                        </div>

                                    </div>

                                    <div class="row" style="padding-top: 20px;">
                                        <div class="col-md-12">

                                            <ul>
                                                <li><a href="{{asset('/upload/'.$oprec->file->ktp)}}" target="_blank"><h4><i class="fa fa-file-photo-o fa-lg" aria-hidden="true"></i> KTP</h4></a></li>
                                                <li><a href="{{asset('/upload/'.$oprec->file->cv)}}" target="_blank"><h4><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i> Curiculum Vitae</h4></a></li>
                                                <li><a href="{{asset('/upload/'.$oprec->file->app_letter)}}" target="_blank"><h4><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i> App Letter</h4></a></li>
                                                <li><a href="{{asset('/upload/'.$oprec->file->transcript)}}" target="_blank"><h4><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i> Transcript</h4></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
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
