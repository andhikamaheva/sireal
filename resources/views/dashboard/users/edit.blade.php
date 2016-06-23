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
                {!! Breadcrumbs::render('users.edit',  $user->id) !!}
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

                                    <form role="form" method="POST"
                                          action="{{route('users.update', ['id' => $user->id])}}"
                                          style="padding-top:10px;">
                                        <input type="hidden" name="_method" value="PATCH">
                                        @include('flash::message')
                                        @include('sweet::alert')
                                        {{csrf_field()}}
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div class="input-group">
									<span class="input-group-addon">
									<i class="fa fa-user"></i>
									</span>
                                                    <input type="text" name="name"
                                                           value="{{$user->name or old('name')}}" class="form-control"
                                                           placeholder="Full Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Username</label>
                                                <div class="input-group">
									<span class="input-group-addon ">
									<i class="fa fa-ask"></i>
									</span>
                                                    <input type="text" disabled="" name="username"
                                                           value="{{$user->username or old('username')}}"
                                                           class="form-control" placeholder="Username">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div class="input-group">
									<span class="input-group-addon ">
									<i class="fa fa-envelope"></i>
									</span>
                                                    <input type="text" name="email"
                                                           value="{{$user->email or old('email')}}" class="form-control"
                                                           placeholder="Username">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="user_password"
                                                           value="{{old('user_password')}}" class="form-control"
                                                           placeholder="Password">
									<span class="input-group-addon">
									<i class="fa fa-lock"></i>
									</span>
                                                </div>
                                            </div>
                                            @if(Auth::user()->can('edit-role'))
                                            <div class="form-group">
                                                <label>Roles</label>
                                                <select data-tags="true" value="" class="form-control" name="roles[]"
                                                        id="roles" multiple>
                                                    @if(!(old('roles')))
                                                        @foreach($roles as $role)
                                                            <option value="{{$role->id}}"
                                                                    @foreach($roleUser as $key)
                                                                    @if($key->role_id == $role->id)
                                                                    selected
                                                                    @endif
                                                                    @endforeach
                                                            >{{$role->name}}</option>
                                                        @endforeach
                                                    @endif
                                                    @if(old('roles'))
                                                        @foreach($roles as $role)
                                                            <option value="{{$role->id}}"
                                                                    @foreach(old('roles') as $old)
                                                                    @if($old == $role->id)
                                                                    selected
                                                                    @endif
                                                                    @endforeach
                                                            >{{$role->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <script>
                                                $('#roles').select2({
                                                    createTag: function (params) {
                                                        return undefined;
                                                    },
                                                    tags: true,
                                                    multiple: true,
                                                    tokenSeparators: [',']
                                                });
                                            </script>

                                            @endif

                                        </div>
                                        <div class="form-actions"
                                             style="background-color:#FFFFFF;align:center;text-align:center;">
                                            <button type="submit" class="btn blue">Submit</button>
                                            <a href="{{ route('users.index') }}">
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
