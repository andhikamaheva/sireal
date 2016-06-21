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
			{{ $pageTitle }} <small> {{$pageDesc}} </small>
			</h3>
			<div class="page-bar">
				{!! Breadcrumbs::render('roles.edit',  $role->id) !!}
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

					<form role="form" method="post" action="{{route('roles.update', ['id' => $role->id])}}" style="padding-top:10px;">
						@include('flash::message')
						 @include('sweet::alert')
							<input type="hidden" name="_method" value="PATCH">
						{{csrf_field()}}
						<div class="form-body">
							<div class="form-group">
								<label>Roles Name</label>
								<div class="input-group">
									<span class="input-group-addon">
									</span>
									<input type="text" name="name" value="{{$role->name or old('name')}}" class="form-control" placeholder="Role Name">

								</div>
								For example : manage-content
							</div>
							<div class="form-group">
								<label>Display Name</label>
								<div class="input-group">
									<span class="input-group-addon ">
									<i class="fa fa-ask"></i>
									</span>
									<input type="text" name="display_name"  value="{{$role->display_name or old('display_name')}}" class="form-control" placeholder="Display Name">
								</div>
							</div>
							<div class="form-group">
								<label>Description</label>
								<div class="input-group">
									<span class="input-group-addon ">
									<i class="fa fa-question-circle" aria-hidden="true"></i>
									</span>
									<textarea type="text" name="description" value="" class="form-control" placeholder="Description">{{$role->description or old('description')}}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label>Permissions</label>
									<select data-tags="true" value="" class="form-control" name="permissions[]" id="permissions" multiple>
										@if(!(old('permissions')))
											@foreach($permissions as $permission)
													<option value="{{$permission->id}}"
														@foreach($permissionRole as $key)
															@if($key->permission_id == $permission->id)
																selected
															@endif
														@endforeach

														>{{$permission->name}}</option>
											@endforeach
										@endif

										@if(old('permissions'))
											@foreach($permissions as $permission)
												<option value="{{$permission->id}}"
													@foreach(old('permissions') as $old)
														@if($old == $permission->id)
															selected
														@endif
													@endforeach
													>{{$permission->name}}</option>
											@endforeach
										@endif
									</select>
								</div>
						<script>
						$('#permissions').select2({
							createTag: function(params) { return undefined; },
							tags: true,
							multiple: true,
							tokenSeparators: [',']
						});
						</script>

						</div>
						<div class="form-actions" style="background-color:#FFFFFF;align:center;text-align:center;">
							<button type="submit" class="btn blue">Submit</button>
							<a href="{{ route('roles.index') }}"><button type="button" class="btn default">Cancel</button></a>
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
		jQuery(document).ready(function() {
		   // initiate layout and plugins
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		QuickSidebar.init(); // init quick sidebar
		Demo.init(); // init demo features
		});
		</script>
	@stop
