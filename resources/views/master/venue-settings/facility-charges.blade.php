@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css" />

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Facility Charges
				<span class="kt-subheader-search__desc">Venue Settings</span>
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
						Facility Charges
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						
						<div class="kt-portlet__head-actions">
							<a href="{{ route('admin.masters.venue-settings.facility-charges.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add Facility
							</a>
						</div>
						
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
					@csrf
					<thead>
						<tr>
							<th>Facility Name</th>
							<th>Price</th>
							<th>Complementory</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($all_facility as $fac)
						<tr>
							<td>{{ $fac->facility_name }}</td>
							<td>{{ $fac->price }}</td>
							<td>
								
								@if($fac->complementory == 1)
								<span class="kt-badge kt-badge--inline kt-badge--success">Yes</span>
								@else
								<span class="kt-badge kt-badge--inline kt-badge--danger">No</span>
								@endif
								
							</td>
							<td>
								<a href="{{ route('admin.masters.venue-settings.facility-charges.edit', $fac->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
									<i class="la la-edit"></i>
								</a>
								<button type="button" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" id="delete" value="{{ $fac->id }}">
									<i class="la la-trash"></i>
								</button>
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

		$(document).on('click', '#delete', function ()
		{
			var obj = $(this);
			var facility_id = $(this).val();
			// alert(facility_id);
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
					url: "{{ route('admin.masters.venue-settings.facility-charges.delete') }}",
					data: 
					{
						'_token': $('input[name="_token"]').val(),
						'facility_id': facility_id
					},
					cache: false,
					success: function (data)
					{
						obj.closest('tr').remove();
					}
				});
				swal("Deleted", "Facility has been deleted.", "success");
			});
		});
	});
</script>

@stop
