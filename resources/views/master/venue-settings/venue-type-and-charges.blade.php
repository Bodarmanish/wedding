@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css" />

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Venue Type & Charges
				<span class="kt-subheader-search__desc">Venue Type & Charges List</span>
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
						Venue Type & Charges List
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<div class="kt-portlet__head-actions">
							<a href="{{ route('admin.masters.venue-settings.venue-type-and-charges.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add Venue Type & Charge
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
										<th>Venue Type</th>
										<th>Price Per Plate OR Rent</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($all_rec as $rec)
									<?php 
									$venue_types =  explode(',',$rec->venue_type);
									$venue_names_data = DB::table('venue_master')->whereIn('id',$venue_types)->get()->toArray();
									$venue_names = '';
									foreach($venue_names_data as $vn) {
										$venue_names .= $vn->venue_name.',';
									}

									?>
									<tr>
										<td>{{ rtrim($venue_names,',') }}</td>
										<td>{{ $rec->price_per_plate_or_rent }}</td>
										<td>
											<a href="{{ route('admin.masters.venue-settings.venue-type-and-charges.edit', $rec->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
												<i class="la la-edit"></i>
											</a>
											
											<button class="btn btn-sm btn-clean btn-icon btn-icon-md" value="{{ $rec->id }}" title="Delete" id="delete">
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

		$(document).on('click', '#delete', function ()
		{
			var obj = $(this);
			var id = $(this).val();

			// alert(id);
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
					url: "{{ route('admin.masters.venue-settings.venue-type-and-charges.delete') }}",
					data: {
						'_token': $('input[name="_token"]').val(),
						'id': id
					},
					cache: false,
					success: function (data)
					{
						obj.closest('tr').remove();
					}
				});
				swal("Deleted", "Venue Type & Charge has been deleted.", "success");
			});
		});
	});

</script>

@stop
