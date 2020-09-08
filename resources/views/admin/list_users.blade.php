@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css" />

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Users
				<span class="kt-subheader-search__desc">Users List</span>
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
						Users List
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						@if(isset($module_permission['create']))
						<div class="kt-portlet__head-actions">
							<a href="{{ route('admin.add.users') }}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add User
							</a>
						</div>
						@endif
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
					<div class="row">
						<div class="col-sm-12">
							<table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="user_list" role="grid" aria-describedby="kt_table_1_info">
								@csrf
							
								<thead>
									<tr role="row">
										{{-- <th>User Id</th> --}}
										<th>Role Type</th>
										<th>User Name</th>
										<th>Eamil</th>
										<th>Mobile</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>

									@foreach($all_user as $users)
									<tr>
										{{-- <td>{{ $users->id }}</td> --}}
										<td>{{ ucfirst($users->role_type) }}</td>
										<td>{{ ucfirst($users->name) }}</td>
										<td>{{ $users->email }}</td>
										<td>{{ ucfirst($users->mobile) }}</td>
										<td>
											@if(isset($module_permission['edit']))
											<a href="{{ route('admin.edit.users', $users->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
												<i class="la la-edit"></i>
											</a>
											@endif

											<input type="hidden" value="{{ $users->id }}" name="user_id" id="user_id">
											@if(isset($module_permission['delete']))
											<button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" id="delete_user">
												<i class="la la-trash"></i>
											</button>
											@endif
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
    	$('#user_list').DataTable();
	});
</script>

<script src="{{ asset('sweetalert/dist/sweetalert.min.js')}}" type="text/javascript"></script>
<script>
            
$(document).ready(function() {

	$(document).on('click', '#delete_user', function ()
	{
    	var obj = $(this);
    	var user_id = $(this).closest('td').find("#user_id").val();
    
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
                    url: '{{ route('admin.delete.users') }}',
                    data: {
                        '_token': $('input[name="_token"]').val(),
                        'user_id': user_id
                    },
                    cache: false,
                    success: function (data)
                    {
                        obj.closest('tr').remove();
                    }
                });
	            swal("Deleted", "User has been deleted.", "success");
	        });
	    });
	});
    
    </script>

@stop
