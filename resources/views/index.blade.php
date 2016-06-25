<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 4.0.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Pendaftaran Asisten Labkom Stikom Surabaya</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{asset('assets/global/css/components.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/layout/css/layout.css')}}" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="{{asset('assets/admin/layout/css/themes/darkblue.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/admin/layout/css/custom.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/select2.css')}}"/>
    <script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('assets/global/plugins/select2/select2.js')}}"></script>
    <script src="{{asset('assets/global/plugins/sweet-alert/dist/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/sweet-alert/dist/sweetalert.css')}}">
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body style="background-color:#ffffff">

<div class="page-container">

    <div class="">
        <div class="row">
            <div class="col-md-offset-2 col-md-8" style="padding-top:20px;">
                <div class="page-content">

                    <h3 class="page-title" style="text-align:center;align:center;">
                        Pendaftaran Asisten Labkom Stikom Surabaya
                    </h3>

                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box blue" id="form_wizard_1">
                                <div class="portlet-title">
                                    <div class="caption">
                                    </div>

                                </div>
                                <div class="portlet-body form">
                                    <form action="{{route('registration.store')}}" method="post" class="form-horizontal"
                                          id="submit_form" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        @include('flash::message')
                                        @include('sweet::alert')
                                        <div class="form-wizard">
                                            <div class="form-body">
                                                <div class="tab-content">
                                                    <div class="alert alert-danger display-none">
                                                        <button class="close" data-dismiss="alert"></button>
                                                        You have some form errors. Please check below.
                                                    </div>
                                                    <div class="alert alert-success display-none">
                                                        <button class="close" data-dismiss="alert"></button>
                                                        Your form validation is successful!
                                                    </div>
                                                    <div class="tab-pane active" id="tab1">
                                                        <h3 class="block"></h3>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">NIM

                                                            </label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control"
                                                                       name="nim" required/>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Nama

                                                            </label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control"
                                                                       name="name" id="submit_form_password" required/>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Nama Panggilan
                                                            </label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control"
                                                                       name="nickname" required/>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">No. Telp

                                                            </label>
                                                            <div class="col-md-4">
                                                                <input type="text" required class="form-control" name="phone"/>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Email<span
                                                                        class="required">

                                                            </label>
                                                            <div class="col-md-4">
                                                                <input type="email" required class="form-control" name="email"/>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputFile" class="col-md-3 control-label">Scan KTP</label>
                                                            <div class="col-md-9">
                                                                <input type="file" name="ktp" id="exampleInputFile">
                                                                <p class="help-block">
                                                                    Format : JPG, PNG
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputFile" class="col-md-3 control-label">Foto</label>
                                                            <div class="col-md-9">
                                                                <input type="file" name="photo" id="exampleInputFile">
                                                                <p class="help-block">
                                                                    Format : JPG, PNG
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputFile" class="col-md-3 control-label">Scan Surat Lamaran</label>
                                                            <div class="col-md-9">
                                                                <input type="file" name="app_letter" id="exampleInputFile">
                                                                <p class="help-block">
                                                                    Format : PDF
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputFile" class="col-md-3 control-label">CV</label>
                                                            <div class="col-md-9">
                                                                <input type="file" name="cv" id="exampleInputFile">
                                                                <p class="help-block">
                                                                    Format : PDF
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputFile" class="col-md-3 control-label">Transkrip</label>
                                                            <div class="col-md-9">
                                                                <input type="file" name="transcript" id="exampleInputFile">
                                                                <p class="help-block">
                                                                    Format : PDF
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-offset-2 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Mata Praktikum</label>
                                                                    <select data-tags="true" value="" class="form-control" name="subjects[]" id="subjects" multiple>
                                                                        @if(!(old('subjects')))
                                                                            @foreach($subjects as $subject)
                                                                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                                                                            @endforeach
                                                                        @endif

                                                                        @if(old('subjects'))
                                                                            @foreach($subjects as $subject)
                                                                                <option value="{{$subject->id}}"
                                                                                        @foreach(old('subjects') as $old)
                                                                                        @if($old->id == $subject->id)
                                                                                        selected
                                                                                        @endif
                                                                                        @endforeach
                                                                                >{{$subject->name}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <script>
                                                            $('#subjects').select2({
                                                                createTag: function(params) { return undefined; },
                                                                tags: true,
                                                                multiple: true,
                                                                tokenSeparators: [',']
                                                            });
                                                        </script>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">

                                                        <button type="submit" class="btn green button-submit">
                                                            Submit <i class="m-icon-swapright m-icon-white"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE CONTENT-->
                </div>

            </div>

        </div>

    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->


<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script>
    jQuery(document).ready(function () {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
        FormWizard.init();
    });
</script>
<script src="{{asset('assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->

<script src="{{asset('assets/global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{asset('assets/global/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.cokie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript"
        src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/layout/scripts/layout.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/layout/scripts/quick-sidebar.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/layout/scripts/demo.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/pages/scripts/form-wizard.js')}}"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>