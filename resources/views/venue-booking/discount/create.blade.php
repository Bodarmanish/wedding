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
				Discount
				<span class="kt-subheader-search__desc">
					@if(isset($edit))
					Edit Discount
					@else
					Create Discount
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
								Edit Discount
								@else
								Create Discount
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
								<label>From Date <span style="color: red;">*</span></label>
								<input type="text" class="form-control" autocomplete="off" readonly="" placeholder="Select Date" id="from_date" name="from_date" value="{{ date('d-m-Y',strtotime($edit->from_date)) }}">
							</div>
							<div class="form-group">
								<label>To Date <span style="color: red;">*</span></label>
								<input type="text" class="form-control" autocomplete="off" readonly="" placeholder="Select Date" id="to_date" name="to_date" value="{{ date('d-m-Y',strtotime($edit->to_date)) }}">
							</div>
							<div class="form-group">
								<label>Discount type <span style="color: red">*</span></label>
								<div class="kt-radio-inline">
									@if($edit->discount_type == 1)
									<label class="kt-radio">
										<input type="radio" class="discount_type" checked="checked" id="discount_type" name="discount_type" value="1"> Discount On Amount
										<span></span>
									</label>
									<label class="kt-radio">
										<input type="radio" class="discount_type" id="discount_type" name="discount_type" value="2"> Discount On Venue
										<span></span>
									</label>
									@else
									<label class="kt-radio">
										<input type="radio" class="discount_type" id="discount_type" name="discount_type" value="1"> Discount On Amount
										<span></span>
									</label>
									<label class="kt-radio">
										<input type="radio" class="discount_type" checked="checked" id="discount_type" name="discount_type" value="2"> Discount On Venue
										<span></span>
									</label>
									@endif
								</div>
							</div>
							<div class="discount_on_amount_div" style="display: none;">
								<div class="form-group">
									<label>Discount In % <span style="color: red;">*</span></label>
									<input type="number" class="form-control" placeholder="Enter Discount %" id="discount_in_percentage" name="discount_in_percentage" value="{{ $edit->discount_in_percentage }}">
								</div>
								<div class="form-group">
									<label>Discount In Amount <span style="color: red;">*</span></label>
									<input type="number" class="form-control" placeholder="Enter Discount In Amount" id="discount_in_amount" name="discount_in_amount" value="{{ $edit->discount_in_amount }}">
								</div>
							</div>
							<div class="discount_on_venue_div" style="display: none;">
								<div class="form-group">
									<label>Discount In Amount <span style="color: red;">*</span></label>
									<input type="number" class="form-control" placeholder="Enter Discount In Amount" id="venue_discount_in_amount" name="venue_discount_in_amount" value="{{ $edit->venue_discount_in_amount }}">
								</div>
								<div class="form-group">
									<label>Venue Type <span style="color: red;">*</span></label>
									<select class="form-control" id="venue_type" name="venue_type">
										<option value="">Select Venue Type</option>
										@foreach($venue_types as $venue)
										<?php
										$selected = '';
										if($venue->id == $edit->venue_type) {
											$selected = ' selected';
										}
										?>
										<option {{ $selected }} value="{{ $venue->id }}">{{ $venue->venue_type }}</option>
										@endforeach
									</select>
								</div>
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-primary" id="update">Update</button>
								<a href="{{ route('admin.venue-booking.discount') }}" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
					</form>

					@else

					<form class="kt-form add__form" method="POST">
						@csrf
						<div class="kt-portlet__body">

							<div class="form-group">
								<label>From Date <span style="color: red;">*</span></label>
								<input type="text" class="form-control" autocomplete="off" readonly="" placeholder="Select Date" id="from_date" name="from_date">
							</div>
							<div class="form-group">
								<label>To Date <span style="color: red;">*</span></label>
								<input type="text" class="form-control" autocomplete="off" readonly="" placeholder="Select Date" id="to_date" name="to_date">
							</div>
							<div class="form-group">
								<label>Discount type <span style="color: red">*</span></label>
								<div class="kt-radio-inline">
									<label class="kt-radio">
										<input type="radio" class="discount_type" id="discount_type" name="discount_type" value="1"> Discount On Amount
										<span></span>
									</label>
									<label class="kt-radio">
										<input type="radio" class="discount_type" id="discount_type" name="discount_type" value="2"> Discount On Venue
										<span></span>
									</label>
								</div>
							</div>
							<div class="discount_on_amount_div" style="display: none;">
								<div class="form-group">
									<label>Discount In % <span style="color: red;">*</span></label>
									<input type="number" class="form-control" placeholder="Enter Discount %" id="discount_in_percentage" name="discount_in_percentage">
								</div>
								<div class="form-group">
									<label>Discount In Amount <span style="color: red;">*</span></label>
									<input type="number" class="form-control" placeholder="Enter Discount In Amount" id="discount_in_amount" name="discount_in_amount">
								</div>
							</div>
							<div class="discount_on_venue_div" style="display: none;">
								<div class="form-group">
									<label>Discount In Amount <span style="color: red;">*</span></label>
									<input type="number" class="form-control" placeholder="Enter Discount In Amount" id="venue_discount_in_amount" name="venue_discount_in_amount">
								</div>
								<div class="form-group">
									<label>Venue Type <span style="color: red;">*</span></label>
									<select class="form-control" id="venue_type" name="venue_type">
										<option value="">Select Venue Type</option>
										@foreach($venue_types as $venue)
										<option value="{{ $venue->id }}">{{ $venue->venue_type }}</option>
										@endforeach
									</select>
								</div>
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-primary" id="save">Submit</button>
								<a href="{{ route('admin.venue-booking.discount') }}" class="btn btn-secondary">Cancel</a>
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

		$("#from_date").datepicker({
			format: "dd-m-yyyy",
			autoclose: true,
			todayHighlight: true,
		}).on("changeDate", function (selected) {
			endDate = new Date(selected.date.valueOf());
			endDate.setDate(endDate.getDate(new Date(selected.date.valueOf())));
			$('#to_date').datepicker('setStartDate', endDate);
		});

		$("#to_date").datepicker({
			format: "dd-m-yyyy",
			autoclose: true,
			todayHighlight: true,
		}).on("changeDate", function (selected) {
			startDate = new Date(selected.date.valueOf());
			startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
			$('#from_date').datepicker('setEndDate', startDate);
		});


		$('input:radio[name="discount_type"]').change(function() {
			// alert($(this).val());
			if ($(this).val() == '1') {
				$('.discount_on_venue_div').hide();
				$('.discount_on_amount_div').show();
			} else {
				$('.discount_on_amount_div').hide();
				$('.discount_on_venue_div').show();
			}
		});

		var radio_val = $("input[type=radio][name='discount_type']:checked").val();
		if (radio_val == '1') {
			$('.discount_on_venue_div').hide();
			$('.discount_on_amount_div').show();
		} else {
			$('.discount_on_amount_div').hide();
			$('.discount_on_venue_div').show();
		}		


		$(".add__form").validate({
			rules:
			{
				from_date:
				{
					required: true
				},
				to_date:
				{
					required: true
				},
				discount_type:
				{
					required: true
				}
			},
			messages:
			{
				from_date:
				{
					required: "Select Date"
				},
				to_date:
				{
					required: "Select Date"
				},
				discount_type:
				{
					required: "Select Discount Type"
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
				$.ajax({
					type: "POST",
					url: "{{ route('admin.venue-booking.discount.store') }}",
					data: new FormData($('.add__form')[0]),
					processData: false,
					contentType: false,
					success: function (data)
					{
						if (data.status === 'success') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							toastr.options.onHidden = function(){
								window.location.reload();
							};

							toastr["success"]("Discount Added Successfully", "Success");
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
				from_date:
				{
					required: true
				},
				to_date:
				{
					required: true
				},
				discount_type:
				{
					required: true
				}
			},
			messages:
			{
				from_date:
				{
					required: "Select Date"
				},
				to_date:
				{
					required: "Select Date"
				},
				discount_type:
				{
					required: "Select Discount Type"
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
				$.ajax({
					type: "POST",
					url: "{{ route('admin.venue-booking.discount.update') }}",
					data: new FormData($('.edit__form')[0]),
					processData: false,
					contentType: false,
					success: function (data)
					{
						if (data.status === 'success') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							toastr.options.onHidden = function(){
								window.location = "{{ route('admin.venue-booking.discount') }}"
							};

							toastr["success"]("Discount Updated Successfully", "Success");
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
