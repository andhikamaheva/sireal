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
                {!! Breadcrumbs::render('tpas.edit', $oprec->id) !!}
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
                            <div class="col-md-12">
                                <div class="portlet-body form">

                                    <form role="form" method="post"
                                          action="{{route('tpas.update', ['id' => $oprec->id])}}"
                                          style="padding-top:10px;">
                                        <input type="hidden" name="_method" value="PATCH">
                                        @include('flash::message')
                                        @include('sweet::alert')
                                        {{csrf_field()}}

                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Registration ID</label>
                                                        <div class="input-group">
									<span class="input-group-addon">
									</span>
                                                            <input type="text" name="id"
                                                                   value="{{$oprec->id}}"
                                                                   class="form-control" placeholder="Registration ID"
                                                                   readonly>

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
                                                                   class="form-control" placeholder="Student Name"
                                                                   readonly>

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


                                                </div>
                                                <div class="col-md-6">
                                                    @foreach($subjects as $subject)
                                                        <div class="form-group">
                                                            <label>{{$subject->name}}</label>
                                                            <div class="input-group">
									<span class="input-group-addon">
									</span>
                                                                <input type="text" name="score[{{$subject->id}}]"
                                                                       value="{{$subject->pivot->score}}"
                                                                       class="form-control" placeholder="Score"
                                                                       >

                                                            </div>
                                                        </div>
                                                    @endforeach



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
