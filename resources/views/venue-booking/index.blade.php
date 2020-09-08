@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css" />

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Venue Booking
				<span class="kt-subheader-search__desc">Venue Booking list</span>
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
						Venue Booking list
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						
						<div class="kt-portlet__head-actions">
							<a href="{{ route('admin.venue-booking.venue-book.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add Booking
							</a>
						</div>
						
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<table class="table table-striped- table-bordered table-hover table-checkable" id="event_type_tbl">
					@csrf
					<thead>
						<tr>
							<th>Customer Name</th>
							<th>Event From Date</th>
							<th>Event To Date</th>
							<th>Event Type</th>
							<th>Venue Type</th>
							<th>About Venue</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($all_bookings as $booking)
						<tr>
							<td>{{ $booking->customer_name }}</td>
							<td>{{ date('d/m/Y',strtotime($booking->event_from_date)) }}</td>
							<td>{{ date('d/m/Y',strtotime($booking->event_to_date)) }}</td>
							<td>{{ $booking->event_type_name }}</td>
							<td>{{ $booking->venue_type_name }}</td>
							<td>{{ $booking->abount_venue }}</td>
							<td>
								<a href="{{ route('admin.venue-booking.venue-book.edit', $booking->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
									<i class="la la-edit"></i>
								</a>

								<button class="btn btn-sm btn-clean btn-icon btn-icon-md" value="{{ $booking->id }}" title="Delete" id="delete">
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

		$('#event_type_tbl').dataTable({
			"ordering": false
		});

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
					url: "{{ route('admin.venue-booking.venue-book.delete') }}",
					data: 
					{
						'_token': $('input[name="_token"]').val(),
						'id': id
					},
					cache: false,
					success: function (data)
					{
						obj.closest('tr').remove();
					}
				});
				swal("Deleted", "Booking has been deleted.", "success");
			});
		});
	});
</script>

@stop
