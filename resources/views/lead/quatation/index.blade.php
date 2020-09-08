@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css" />

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Quatations
				<span class="kt-subheader-search__desc">Quatation list</span>
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
						Quatation list
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						
						<div class="kt-portlet__head-actions">
							<a href="{{ route('admin.lead.quotation.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add Quatation
							</a>
						</div>
						
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<table class="table table-striped- table-bordered table-hover table-checkable" id="quatation_tbl">
					@csrf
					<thead>
						<tr>
							<th>Customer Name</th>
							<th>Quatation</th>
							<th>Amount</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($quatations as $row)
						<tr>
							<td>{{ $row->customer_name }}</td>
							<td>
								<?php
								$extension = pathinfo($row->quatation, PATHINFO_EXTENSION);
								if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
									?>
									<img src="{{ asset($row->quatation) }}" style="width: 50px; height: 50px;">
								<?php } else if($extension == 'pdf') { ?>
									<img src="{{ asset('assets/media/icons/pdf-icon.png') }}" style="width: 50px; height: 50px;">
								<?php } else if($extension == 'doc' || $extension == 'docx') { ?>
									<img src="{{ asset('assets/media/icons/word-icon.png') }}" style="width: 50px; height: 50px;">
								<?php } else if($extension == 'csv' || $extension == 'xls' || $extension == 'xlsx') { ?>
									<img src="{{ asset('assets/media/icons/excel-icon.png') }}" style="width: 50px; height: 50px;">
								<?php } else if($extension == 'ppt' || $extension == 'pptx') { ?>
									<img src="{{ asset('assets/media/icons/powerpoint-icon.png') }}" style="width: 50px; height: 50px;">
								<?php } ?>
							</td>
							<td>{{ number_format($row->amount) }}</td>
							<td>
								<a href="{{ route('admin.lead.quotation.edit', $row->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
									<i class="la la-edit"></i>
								</a>

								<button class="btn btn-sm btn-clean btn-icon btn-icon-md" value="{{ $row->id }}" title="Delete" id="delete">
									<i class="la la-trash"></i>
								</button>

								<a href="{{ route('admin.lead.quotation.show', $row->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
									<i class="la la-eye"></i>
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


<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/data-sources/html.js') }}" type="text/javascript"></script>
<script src="{{ asset('sweetalert/dist/sweetalert.min.js')}}" type="text/javascript"></script>

<script>

	$(document).ready(function(){

		$('#quatation_tbl').dataTable( {
			"ordering": false
		} );

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
					url: "{{ route('admin.lead.quotation.delete') }}",
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
				swal("Deleted", "Quatation has been deleted.", "success");
			});
		});
	});
</script>

@stop
