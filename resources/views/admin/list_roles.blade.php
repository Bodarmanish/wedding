@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css" />

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Roles
				<span class="kt-subheader-search__desc">Role List</span>
			</h3>
		</div>
	</div>
	


	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">
			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="kt-font-brand flaticon2-line-chart"></i>
					</span>
					<h3 class="kt-portlet__head-title">
						Role List
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<div class="kt-portlet__head-actions">
							<a href="{{ route('admin.role.add') }}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add Role
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
					<div class="row">
						<div class="col-sm-12">
							<table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="role_list" role="grid" aria-describedby="kt_table_1_info">
								@csrf

								<thead>
									<tr role="row">
										<th>ID</th>
										<th>Role Name</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>

									@foreach($all_roles as $role)
									<tr>
										<td>{{ $role->id }}</td>
										<td>{{ $role->role_type }}</td>
										<td>
											<a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
												<i class="la la-edit"></i>
											</a>
											
											<button class="btn btn-sm btn-clean btn-icon btn-icon-md" value="{{ $role->id }}" title="Delete" id="delete_user">
												<i class="la la-trash"></i>
											</button>

											<a href="{{ route('admin.role.permission', $role->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Permission">
												<i class="la la-gear"></i>
											</a>

										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>

<script src="{{ asset('assets/js/pages/crud/datatables/basic/paginations.js')}}" type="text/javascript"></script>

<script>
	$(document).ready(function() {
		$('#role_list').DataTable({
			"ordering": false
		});
	});
</script>

<script src="{{ asset('sweetalert/dist/sweetalert.min.js')}}" type="text/javascript"></script>
<script>

	$(document).ready(function() {

		$(document).on('click', '#delete_user', function ()
		{
			var obj = $(this);
			var role_id = $(this).val();

			// alert(user_id);
			// return;

			swal({
				title: "Are you sure?",
				text: "You will not be able recover this record",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes delete it!",
				closeOnConfirm: false
			},
			function () {
				$.ajax({
					type: "POST",
					url: "{{ route('admin.role.delete') }}",
					data: {
						'_token': $('input[name="_token"]').val(),
						'role_id': role_id
					},
					cache: false,
					success: function (data)
					{
						obj.closest('tr').remove();
					}
				});
				swal("Deleted", "Role has been deleted.", "success");
			});
		});
	});

</script>

@stop
