@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<style type="text/css">
	.invalid-feedback
	{
		/*color: red;*/
		font-size: 13px;
	}
</style>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}">

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Lead
				<span class="kt-subheader-search__desc">
					@if(isset($edit))
					Edit Lead
					@else
					Create Lead
					@endif
				</span>
			</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3">
			

			<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								@if(isset($edit))
								Edit Lead
								@else
								Create Lead
								@endif
							</h3>
						</div>
					</div>
					@if(isset($edit))

					<form class="kt-form edit__form" method="POST">
						@csrf
						<div class="kt-portlet__body">
							<input type="hidden" name="rec_id" value="{{ $edit->id }}">
							<div class="form-group">
								<label>Venue <span style="color: red;">*</span></label>
								<select class="form-control" id="venue" name="venue">
									<option value="">Select Venue</option>
									@foreach($venue as $data)
									<?php
									$selected = '';
									if($data->id == $edit->venue) {
										$selected = ' selected';
									}
									?>
									<option {{ $selected }} value="{{ $data->id }}">{{ $data->venue_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Customer Name <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Enter Customer Name" id="customer_name" name="customer_name" value="{{ $edit->customer_name }}">
							</div>
							<div class="form-group">
								<label>Email <span style="color: red;">*</span></label>
								<div class="kt-radio-inline">
									<input type="email" class="form-control" placeholder="Enter Email" name="email" value="{{ $edit->email }}">
								</div>
							</div>
							<div class="form-group">
								<label>Mobile No. <span style="color: red;">*</span></label>
								<input type="number" class="form-control" placeholder="Enter Mobile No." name="mobile_no" value="{{ $edit->mobile }}">
							</div>
							<div class="form-group">
								<label>Alternate Mobile No.</label>
								<input type="number" class="form-control" placeholder="Enter Alterna te Mobile No." name="alternate_mobile_no" value="{{ $edit->alt_mobile }}">
							</div>
							<div class="form-group">
								<label>Event Date <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Select Event Date" name="event_date_edit" id="event_date_edit" value="{{ date('d/m/Y',strtotime($edit->event_date)) }}">
								
							</div>
							<div class="form-group">
								<label>Event Type <span style="color: red;">*</span></label>
								<select class="form-control" id="event_type" name="event_type">
									<option value="">Select Event Type</option>
									@foreach($events as $event)
									<?php
									$selected = '';
									if($event->id == $edit->event_type) {
										$selected = ' selected';
									}
									?>
									<option {{ $selected }} value="{{ $event->id }}">{{ $event->event_type }}</option>
									@endforeach
								</select>
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<div class="row loader_div" style="display: none;">
									<img src="{{ asset('assets/media/icons/final-loader.gif') }}" style="width: 50px; height: 45px;"> <span style="margin-top: 12px;">Please Wait...</span>
								</div>
								<button type="submit" class="btn btn-primary" id="update">Update</button>
								<a href="{{ route('admin.lead.leads') }}" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
					</form>

					@else

					<form class="kt-form add__form" method="POST">
						@csrf
						<div class="kt-portlet__body">

							<div class="form-group">
								<label>Venue <span style="color: red;">*</span></label>
								<select class="form-control" id="venue" name="venue">
									<option value="">Select Venue</option>
									@foreach($venue as $data)
									<option value="{{ $data->id }}">{{ $data->venue_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Customer Name <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Enter Customer Name" id="customer_name" name="customer_name">
							</div>
							<div class="form-group">
								<label>Email <span style="color: red;">*</span></label>
								<div class="kt-radio-inline">
									<input type="email" class="form-control" placeholder="Enter Email" name="email">
								</div>
							</div>
							<div class="form-group">
								<label>Mobile No. <span style="color: red;">*</span></label>
								<input type="number" class="form-control" placeholder="Enter Mobile No." name="mobile_no">
							</div>
							<div class="form-group">
								<label>Alternate Mobile No.</label>
								<input type="number" class="form-control" placeholder="Enter Alterna te Mobile No." name="alternate_mobile_no">
							</div>
							<div class="form-group">
								<label>Event Date <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Select Event Date" name="event_date" id="event_date">
								
							</div>
							<div class="form-group">
								<label>Event Type <span style="color: red;">*</span></label>
								<select class="form-control" id="event_type" name="event_type">
									<option value="">Select Event Type</option>
									@foreach($events as $event)
									<option value="{{ $event->id }}">{{ $event->event_type }}</option>
									@endforeach
								</select>
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<div class="row loader_div" style="display: none;">
									<img src="{{ asset('assets/media/icons/final-loader.gif') }}" style="width: 50px; height: 45px;"> <span style="margin-top: 12px;">Please Wait...</span>
								</div>
								<button type="submit" class="btn btn-primary" id="save">Submit</button>
								<a href="{{ route('admin.lead.leads') }}" id="cancel" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
					</form>

					@endif
				</div>
			</div>

		</div>
	</div>
</div>

<script src="{{ asset('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

<script>
	$(document).ready(function () {

		var startDate = new Date();
		$( "#event_date" ).datepicker({
			format: "dd/mm/yyyy",
			autoclose: true,
			todayHighlight: true,
			minDate: new Date(),
		});
		$( "#event_date" ).datepicker('setDate', 'today');
		$('#event_date').datepicker('setStartDate', startDate);

		$( "#event_date_edit" ).datepicker({
			format: "dd/mm/yyyy",
			autoclose: true,
			todayHighlight: true,
			minDate: new Date(),
		});
		$('#event_date_edit').datepicker('setStartDate', startDate);


		$(".add__form").validate({
			rules:
			{
				venue:
				{
					required: true
				},
				customer_name:
				{
					required: true
				},
				email:
				{
					required: true
				},
				mobile_no:
				{
					required: true
				},
				event_date:
				{
					required: true
				},
				event_type:
				{
					required: true
				}
			},
			messages:
			{
				venue:
				{
					required: "Select Venue"
				},
				customer_name:
				{
					required: "Enter Customer Name"
				},
				email:
				{
					required: "Enter Email"
				},
				mobile_no:
				{
					required: "Enter Mobile No."
				},
				event_date:
				{
					required: "Select Event Date"
				},
				event_type:
				{
					required: "Select Event Type"
				}
			},
			highlight: function (element)
			{
				$(element).closest('.form-group').addClass('has-error');
			},
			unhighlight: function (element)
			{
				$(element).closest('.form-group').removeClass('has-error');
			},
			errorElement: 'div',
			errorClass: 'invalid-feedback',
			errorPlacement: function (error, element)
			{
				if (element.parent('.input-group').length) {
					error.insertAfter(element.parent());
				} else {
					error.insertAfter(element);
				}
			}
		});
		$("#save").on("click", function (e)
		{

			e.preventDefault();
			if ($(".add__form").valid())
			{
				$('.loader_div').show();
				$("#save").attr("disabled", "disabled");

				$.ajax({
					type: "POST",
					url: "{{ route('admin.lead.leads.store') }}",
					data: new FormData($('.add__form')[0]),
					processData: false,
					contentType: false,
					success: function (data)
					{
						$('.loader_div').hide();
						$('#save').removeAttr("disabled");

						if (data.status === 'success') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							toastr.options.onHidden = function(){
								window.location = "{{ route('admin.lead.leads') }}";
							};

							toastr["success"]("Lead Added Successfully", "Success");
						}
						else if (data.status === 'duplicate') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							
							toastr["warning"]("Lead already exist", "Warning");
						} 
						else if(data.status === 'error') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;

							toastr["error"]("Opps.. Something Went Wrong.!", "Error");
						}
					}
				});
			}
			else
			{
				e.preventDefault();
			}
		});

		$(".edit__form").validate({
			rules:
			{
				venue:
				{
					required: true
				},
				customer_name:
				{
					required: true
				},
				email:
				{
					required: true
				},
				mobile_no:
				{
					required: true
				},
				event_date:
				{
					required: true
				}
			},
			messages:
			{
				venue:
				{
					required: "Select Venue"
				},
				customer_name:
				{
					required: "Enter Customer Name"
				},
				email:
				{
					required: "Enter Email"
				},
				mobile_no:
				{
					required: "Enter Mobile No."
				},
				event_date:
				{
					required: "Select Event Date"
				}
			},
			highlight: function (element)
			{
				$(element).closest('.form-group').addClass('has-error');
			},
			unhighlight: function (element)
			{
				$(element).closest('.form-group').removeClass('has-error');
			},
			errorElement: 'div',
			errorClass: 'invalid-feedback',
			errorPlacement: function (error, element)
			{
				if (element.parent('.input-group').length) {
					error.insertAfter(element.parent());
				} else {
					error.insertAfter(element);
				}
			}
		});
		$("#update").on("click", function (e)
		{

			e.preventDefault();
			if ($(".edit__form").valid())
			{

				$('.loader_div').show();
				$("#update").attr("disabled", "disabled");

				$.ajax({
					type: "POST",
					url: "{{ route('admin.lead.leads.update') }}",
					data: new FormData($('.edit__form')[0]),
					processData: false,
					contentType: false,
					success: function (data)
					{
						$('.loader_div').hide();
						$('#update').removeAttr("disabled");

						if (data.status === 'success') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							toastr.options.onHidden = function(){
								window.location = "{{ route('admin.lead.leads') }}";
							};

							toastr["success"]("Lead Updated Successfully", "Success");
						}
						else if (data.status === 'duplicate') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							
							toastr["warning"]("Lead already exist", "Warning");
						} 
						else if(data.status === 'error') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;

							toastr["error"]("Opps.. Something Went Wrong.!", "Error");
						}
					}
				});
			}
			else
			{
				e.preventDefault();
			}
		});

	});
</script>



@stop
