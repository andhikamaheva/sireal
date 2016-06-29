@extends('dashboard.template.index')
@section('css')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/select2.css')}}"/>
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <!-- END PAGE LEVEL STYLES -->
@stop
@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper" id="content">
        <div class="page-content">

            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                {{ $pageTitle }}
                <small>{{$pageDesc}}</small>
            </h3>
            <div class="page-bar">
                {!! Breadcrumbs::render('reports.index') !!}
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet-body form">

                        <form role="form" method="post"
                              action="{{route('reports.store')}}"
                              style="padding-top:10px;">
                            {{--<input type="hidden" name="_method" value="PATCH">--}}
                            @include('flash::message')
                            @include('sweet::alert')
                            {{csrf_field()}}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Batch</label>
                                            <div class="input-group">
									<span class="input-group-addon">
									</span>
                                                <select class="form-control" name="batch">
                                                    @foreach($batches as $batch)
                                                        <option value="{{$batch->id}}">{{$batch->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <div class="input-group">
									<span class="input-group-addon">
									</span>
                                                <select class="form-control" name="subject">
                                                    @foreach($subjects as $subject)
                                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>


                            </div>
                            <div class="form-actions"
                                 style="background-color:#FFFFFF;align:center;text-align:center;">
                                <button type="submit" class="btn blue">Generate</button>
                                <button type="button" class="btn default">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <!-- END CONTENT -->
    <script>
        $(document).ready(function () {
            $('#sample_1').DataTable({});
        });
    </script>
@stop
@section('js')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="{{asset('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/layout/scripts/layout.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/layout/scripts/quick-sidebar.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/layout/scripts/demo.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function () {
            Metronic.init(); // init metronic core components
            Layout.init(); // init current layout
            QuickSidebar.init(); // init quick sidebar
            Demo.init(); // init demo features

        });
    </script>
@stop
