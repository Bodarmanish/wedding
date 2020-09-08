@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css" />

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Venues
				<span class="kt-subheader-search__desc">Venue Management</span>
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
						Venue List
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						@if(isset($module_permission['create']))
						<div class="kt-portlet__head-actions">
							<a href="{{ route('admin.create.venue') }}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add Venue
							</a>
						</div>
						@endif
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
					@csrf
					<thead>
						<tr>
							<th>Venue Name</th>
							<th>Venue Email</th>
							<th>Venue District</th>
							<th>Venue Mobile</th>
							<th>Owner Name</th>
							<th>Owner Email</th>
							<th>Owner Mobile</th>
							<th>Venue Type</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($all_venues as $venue)
						<tr>
							<td>{{ ucfirst($venue->venue_name) }}</td>
							<td>{{ $venue->venue_email }}</td>
							<td>{{ ucfirst($venue->venue_district) }}</td>
							<td>{{ $venue->venue_mobile }}</td>
							<td>{{ ucfirst($venue->owner_name) }}</td>
							<td>{{ $venue->owner_email }}</td>
							<td>{{ $venue->owner_mobile_1 }}</td>
							<td>{{ ucfirst($venue->venue_type) }}</td>
							<td nowrap="">
								@if(isset($module_permission['settings']))
								<span class="dropdown">
									<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
										<i class="la la-gear"></i>
									</a>

									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="{{ route('admin.add.termsconditions' , $venue->id) }}">
											<i class="la la-edit"></i> Terms Conditions
										</a>

										<a class="dropdown-item" href="{{ route('admin.add.policy' , $venue->id) }}">
											<i class="la la-edit"></i> Cancellation Policies
										</a>

										<a class="dropdown-item" href="{{ route('admin.add.document', $venue->id) }}">
											<i class="la la-edit"></i> Required documents
										</a>

										<a class="dropdown-item" href="{{ route('admin.venueComItems',$venue->id) }}">
											<i class="la la-edit"></i> Items provided as complimetory
										</a>

										<a class="dropdown-item" href="{{ route('admin.venueCostItems',$venue->id) }}">
											<i class="la la-edit"></i> Items provided with extra cost
										</a>

										<a class="dropdown-item" href="{{ route('admin.add.instructions' ,$venue->id) }}">
											<i class="la la-edit"></i> Instructions
										</a>

										<a class="dropdown-item" href="{{ route('admin.show.media' ,$venue->id) }}">
											<i class="la la-edit"></i> Photo & Video Gallery
										</a>
									</div>
								</span>
								@endif
								
								<a href="{{ route('admin.edit.venue',$venue->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
									<i class="la la-edit"></i>
								</a>
							
								<input type="hidden" id="venue_hidden_id" name="venue_hidden_id" value="{{ $venue->id }}">
								@if(isset($module_permission['delete']))
								<button type="button" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" id="delete_venue">
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


<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/data-sources/html.js') }}" type="text/javascript"></script>
<script src="{{ asset('sweetalert/dist/sweetalert.min.js')}}" type="text/javascript"></script>

<script>

	$(document).ready(function(){

		$(document).on('click', '#delete_venue', function ()
		{
			var obj = $(this);
			var venue_hidden_id = $(this).closest('td').find("#venue_hidden_id").val();
			
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
					url: '{{ route('admin.delete.venue') }}',
					data: 
					{
						'_token': $('input[name="_token"]').val(),
						'venue_hidden_id': venue_hidden_id
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
