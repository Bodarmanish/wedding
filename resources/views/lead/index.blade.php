@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css" />

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Leads
				<span class="kt-subheader-search__desc">Lead list</span>
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
						Lead list
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						
						<div class="kt-portlet__head-actions">
							<a href="{{ route('admin.lead.leads.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add lead
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
							<th>Venue Name</th>
							<th>Customer Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Alternate Mobile</th>
							<th>Event Date</th>
							<th>Event Type</th>
							<th>Event Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($leads as $lead)
						<tr>
							<td>{{ $lead->venue_name }}</td>
							<td>{{ $lead->customer_name }}</td>
							<td>{{ $lead->email }}</td>
							<td>{{ $lead->mobile }}</td>
							<td>{{ $lead->alt_mobile }}</td>
							<td>{{ $lead->event_date }}</td>
							<td>{{ $lead->event_type_name }}</td>
							<td>
								@if($lead->event_date > \Carbon\Carbon::now()->toDateString())
									{{ 'Event done' }}
								@elseif($lead->event_date == \Carbon\Carbon::now()->toDateString()) 
									{{ 'Event Today' }} 
								@else 
									{{ 'Event left' }} 
								@endif
							</td>
							<td>
								<a href="{{ route('admin.lead.leads.edit', $lead->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
									<i class="la la-edit"></i>
								</a>

								<button class="btn btn-sm btn-clean btn-icon btn-icon-md" value="{{ $lead->id }}" title="Delete" id="delete">
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
			var id = $(this).val();
			
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
					url: "{{ route('admin.lead.leads.delete') }}",
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
				swal("Deleted", "Lead has been deleted.", "success");
			});
		});
	});
</script>

@stop
