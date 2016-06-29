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
                {!! Breadcrumbs::render('tpas.index') !!}
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box grey-cascade">
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group pull-right">
                                            <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i
                                                        class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="javascript:;">
                                                        Save as PDF </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        Export to Excel </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('sweet::alert')
                            @include('flash::message')

                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        NIM
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Register Date
                                    </th>
                                    {{--<th>
                                        Status
                                    </th>--}}
                                    <th style="text-align:center;">
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oprecs as $oprec)
                                    <tr class="odd gradeX">
                                        <td>
                                            {{$oprec->id}}
                                        </td>
                                        <td>
                                            {{$oprec->students->nim}}
                                        </td>
                                        <td>
                                            {{$oprec->students->name}}
                                        </td>
                                        <td>
                                            {{$oprec->created_at}}
                                        </td>
                                      {{--  <td>
                                            {{statusScore($oprec->file->status)}}
                                        </td>--}}

                                        <td align="center">
                                            <a class="btn green"
                                               href="{{route('tpas.edit', ['id' => $oprec->id])}}"><i
                                                        class="fa fa-search-plus" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
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
