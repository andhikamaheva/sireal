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
                {!! Breadcrumbs::render('subjects.edit',  $subject->id) !!}
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

                                    <form role="form" method="post"
                                          action="{{route('subjects.update', ['id' => $subject->id])}}"
                                          style="padding-top:10px;">
                                        @include('flash::message')
                                        @include('sweet::alert')
                                        <input type="hidden" name="_method" value="PATCH">
                                        {{csrf_field()}}
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label>Subject Code</label>
                                                <div class="input-group">
									<span class="input-group-addon">
									</span>
                                                    <input type="text" name="code"
                                                           value="{{$subject->code or old('code')}}"
                                                           class="form-control" placeholder="Subject Code">

                                                </div>
                                                For example : PBD
                                            </div>

                                            <div class="form-group">
                                                <label>Subject Name</label>
                                                <div class="input-group">
									<span class="input-group-addon">
									</span>
                                                    <input type="text" name="name"
                                                           value="{{$subject->name or old('name')}}"
                                                           class="form-control" placeholder="Subject Name">

                                                </div>
                                                For example : Pemrograman Basis Data
                                            </div>

                                            <div class="form-group">
                                                <label>Coordinators</label>
                                                <select data-tags="true" value="" class="form-control" name="users[]"
                                                        id="users" multiple>
                                                    @if(!(old('users')))
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}"
                                                                    @foreach($coordinators as $key)
                                                                    @if($key->user_id == $user->id)
                                                                    selected
                                                                    @endif
                                                                    @endforeach
                                                            >{{$user->name}}</option>
                                                        @endforeach
                                                    @endif

                                                    @if(old('users'))
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}"
                                                                    @foreach(old('users') as $old)
                                                                    @if($old->id == $user->id)
                                                                    selected
                                                                    @endif
                                                                    @endforeach
                                                            >{{$user->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <script>
                                                $('#users').select2({
                                                    createTag: function (params) {
                                                        return undefined;
                                                    },
                                                    tags: true,
                                                    multiple: true,
                                                    tokenSeparators: [',']
                                                });
                                            </script>
                                        </div>

                                        <div class="form-actions"
                                             style="background-color:#FFFFFF;align:center;text-align:center;">
                                            <button type="submit" class="btn blue">Submit</button>
                                            <a href="{{ route('roles.index') }}">
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
