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
				Venue Booking
				<span class="kt-subheader-search__desc">
					Create Booking
				</span>
			</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			

			<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								Create Booking
							</h3>
						</div>
					</div>
					

					<form class="kt-form add__form" method="POST">
						@csrf
						<div class="kt-portlet__body">
							<div class="row">
								<div class="col-sm-12 col-md-4 col-lg-4">
									<div class="form-group">
										<label>Customer <span style="color: red;">*</span></label>
										<select class="form-control kt-select2 customer" id="customer" name="customer">
											<option value="">Select Customer</option>
											@foreach($customers as $data)
											<option value="{{ $data->id }}">{{ $data->customer_name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4">
									<div class="form-group">
										<label>Event From Date <span style="color: red;">*</span></label>
										<input type="text" class="form-control" readonly="" id="event_from_date" name="event_from_date" placeholder="Select Event From Date">
									</div>
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4">
									<div class="form-group">
										<label>Event To Date <span style="color: red;">*</span></label>
										<input type="text" class="form-control" readonly="" id="event_to_date" name="event_to_date" placeholder="Select Event TO Date">
									</div>
								</div>
								
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-4 col-lg-4">
									<div class="form-group">
										<label>Event Type <span style="color: red;">*</span></label>
										<select class="form-control" id="event_type" name="event_type">
											<option value="">Select Event Type</option>
											@foreach($event_types as $events)
											<option value="{{ $events->id }}">{{ $events->event_type }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4">
									<div class="form-group">
										<label>Select Venue <span style="color: red;">*</span></label>
										<select class="form-control" id="venue_type" name="venue">
											<option value="">Select Venue Type</option>
											@foreach($venue_master as $venue)
											<option value="{{ $venue->id }}">{{ $venue->venue_name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4">
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
								<div class="col-sm-12 col-md-4 col-lg-4">
									<div class="form-group">
										<label>Venue Rent <span style="color: red;">*</span></label>
										<input type="number" class="form-control" name="venue_rent" id="venue_rent" >
									</div>
								</div>
							</div>
							<div class="parent_div" id="parent_div">
								<div class="row master_clone_div">
									<div class="col-sm-12 col-md-3 col-lg-2">
										<div class="form-group">
											<label>Facility <span style="color: red;">*</span></label>
											<select class="form-control facility" id="facility" name="facility[]">
												<option value="">Select Facility</option>
												@foreach($facilities as $fac)
												<option value="{{ $fac->id }}">{{ $fac->facility_name }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-sm-12 col-md-2 col-lg-2">
										<div class="form-group">
											<label>Quantity <span style="color: red;">*</span></label>
											<input type="number" class="form-control facility_quantity" placeholder="Enter Quantity" id="facility_quantity" name="facility_quantity[]">
										</div>
									</div>
									<div class="col-sm-12 col-md-2 col-lg-2">
										<div class="form-group">
											<label>Price <span style="color: red;">*</span></label>
											<input type="number" class="form-control facility_price" readonly="" placeholder="Enter Price" id="facility_price" name="facility_price[]">
										</div>
									</div>
									<div class="col-sm-12 col-md-2 col-lg-2">
										<div class="form-group">
											<label>GST (%)<span style="color: red;">*</span></label>
											<input type="number" class="form-control facility_gst" placeholder="Enter GST" id="facility_gst" name="facility_gst[]">
										</div>
									</div>
									<div class="col-sm-12 col-md-2 col-lg-2">
										<div class="form-group">
											<label>Total <span style="color: red;">*</span></label>
											<input type="number" class="form-control facility_total" readonly="" placeholder="Total" id="facility_total" name="facility_total[]">
										</div>
									</div>
									<div class="col-sm-12 col-md-2 col-lg-2" style="margin-top: 28px;">
										<button type="button" class="btn btn-sm btn-clean btn-icon btn-icon-md add_facility" title="Add" id="add_facility">
											<i class="la la-plus"></i>
										</button>
										<button type="button" class="btn btn-sm btn-clean btn-icon btn-icon-md remove_facility" title="Remove" id="remove_facility">
											<i class="la la-minus"></i>
										</button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-4 col-lg-4">
									<div class="form-group">
										<label>Booking Amount Paid <span style="color: red;">*</span></label>
										<input type="number" class="form-control" name="booking_amount_paid" id="booking_amount_paid" placeholder="Enter Booking Amount">
									</div>
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4">
									<div class="form-group">
										<label>Amount Paid Date <span style="color: red;">*</span></label>
										<input type="text" class="form-control" readonly="" name="amount_paid_date" id="amount_paid_date" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12">
									<div class="form-group">
										<label>About Venue</label>
										<textarea class="form-control" id="about_venue" name="about_venue" placeholder="Enter About Venue" rows="5"></textarea>
									</div>
								</div>
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<div class="row loader_div" style="display: none;">
									<img src="{{ asset('assets/media/icons/final-loader.gif') }}" style="width: 50px; height: 45px;"> <span style="margin-top: 12px;">Please Wait...</span>
								</div>
								<button type="submit" class="btn btn-primary" id="save">Submit</button>
								<a href="{{ route('admin.venue-booking.venue-book') }}" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
					</form>

				</div>
			</div>

		</div>
	</div>
</div>

<script src="{{ asset('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

<script>
	$(document).ready(function () {

		$('.customer').select2({
			placeholder: 'Select Customer'
		});

		// var startDate = new Date();
		// $( "#event_date" ).datepicker({
		// 	format: "dd/mm/yyyy",
		// 	autoclose: true,
		// 	todayHighlight: true,
		// 	minDate: new Date(),
		// });
		// $( "#event_date" ).datepicker('setDate', 'today');

		$("#event_from_date").datepicker({
			format: "dd-m-yyyy",
			autoclose: true,
			todayHighlight: true,
		}).on("changeDate", function (selected) {
			endDate = new Date(selected.date.valueOf());
			endDate.setDate(endDate.getDate(new Date(selected.date.valueOf())));
			$('#event_to_date').datepicker('setStartDate', endDate);
		});

		$("#event_to_date").datepicker({
			format: "dd-m-yyyy",
			autoclose: true,
			todayHighlight: true,
		}).on("changeDate", function (selected) {
			startDate = new Date(selected.date.valueOf());
			startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
			$('#event_from_date').datepicker('setEndDate', startDate);
		});

		var startDate = new Date();
		$( "#amount_paid_date" ).datepicker({
			format: "dd/mm/yyyy",
			autoclose: true,
			todayHighlight: true,
			minDate: new Date(),
		});
		$( "#amount_paid_date" ).datepicker('setDate', 'today');


		// $("#price").keyup(function(){
		// 	var price = $(this).val();
		// 	var gst = $('#gst').val();

		// 	var gst_price = price * gst / 100;
		// 	var total = parseFloat(price) + parseFloat(gst_price);

		// 	$('#total').val(total);
		// });

		// $("#gst").keyup(function(){
		// 	var gst = $(this).val();
		// 	var price = $('#price').val();

		// 	var gst_price = gst * price / 100;
		// 	var total = parseFloat(price) + parseFloat(gst_price);

		// 	$('#total').val(total);
		// });

		$(document).on("keyup", ".facility_quantity", function() {
			var qty = $(this).val();
			var price = $(this).closest('.master_clone_div').find(".facility_price").val();
			var gst = $(this).closest('.master_clone_div').find(".facility_gst").val();

			var gst_total = parseFloat(qty) * parseFloat(price) * parseFloat(gst) / 100;
			var total = parseFloat(qty) * parseFloat(price) + parseFloat(gst_total);

			$(this).closest('.master_clone_div').find(".facility_total").val(total);

			// var grand_total = 0;
			// $('.facility_total').each(function(){
			// 	grand_total += parseInt($(this).val());
			// });

			// $('.grand_total').val(grand_total);

		});

		$(document).on("keyup", ".facility_gst", function() {
			var gst = $(this).val();
			var price = $(this).closest('.master_clone_div').find(".facility_price").val();
			var qty = $(this).closest('.master_clone_div').find(".facility_quantity").val();

			var gst_total = (parseFloat(qty) * parseFloat(price) * parseFloat(gst)) / 100;
			var total = parseFloat(qty) * parseFloat(price) + parseFloat(gst_total);

			$(this).closest('.master_clone_div').find(".facility_total").val(total);

			// var grand_total = 0;
			// $('.facility_total').each(function(){
			// 	grand_total += parseInt($(this).val());
			// });

			// $('.grand_total').val(grand_total);

		});

		$(document).on('click','.add_facility',function() {
			var $row = $(this).closest('.master_clone_div');
			var $clone = $row.clone();
			$clone.find('.facility_quantity').val('');
			$clone.find('.facility_price').val('');
			$clone.find('.facility_gst').val('');
			$clone.find('.facility_total').val('');
			$row.after($clone);

		});
		$(document).on("click", ".remove_facility", function () {
			var num_of_master_clone_div = $('.master_clone_div').length;
			if (num_of_master_clone_div != 1) {
				var obj = $(this).closest('.master_clone_div');
				obj.remove();
			}
		});

		$(document).on("change", "#facility", function ()
		{
			var obj=$(this);
			var id = obj.closest('.master_clone_div').find(".facility").val();
			$.ajax({
				type: "POST",
				url: "{{route('admin.venue-settings.get-facility-price')}}",
				dataType: 'json',
				data: {
					'_token': $('input[name="_token"]').val(),
					'id': id
				},
				success: function (data) 
				{
					obj.closest('.master_clone_div').find(".facility_price").val(data.price);
				}
			});
		});



		$(".add__form").validate({
			rules:
			{
				customer:
				{
					required: true
				},
				event_from_date:
				{
					required: true
				},
				event_to_date:
				{
					required: true
				},
				event_type:
				{
					required: true
				},
				venue_type:
				{
					required: true
				},
				booking_amount_paid:
				{
					required: true
				},
				amount_paid_date:
				{
					required: true
				}
			},
			messages:
			{
				customer:
				{
					required: "Select Customer"
				},
				event_from_date:
				{
					required: "Select Event From Date"
				},
				event_to_date:
				{
					required: "Select Event To Date"
				},
				event_type:
				{
					required: "Select Event type"
				},
				venue_type:
				{
					required: "Select Venue Type"
				},
				booking_amount_paid:
				{
					required: "Enter Booking Amount"
				},
				amount_paid_date:
				{
					required: "Select Amount Paid Date"
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

				var error=0;
				$(".master_clone_div").each(function(){
					var facility=$(this).find(".facility").val();
					var facility_quantity=$(this).find(".facility_quantity").val();
					var facility_gst=$(this).find(".facility_gst").val();
					if(facility==""||facility_quantity==""||facility_gst=="")
					{
						error=1;
						return false;
					} 
				});
				if(error==1){
					toastr.options.timeOut = 3000;
					toastr.options.fadeOut = 3000;
					toastr.options.progressBar = true;

					toastr["warning"]("Please Fill Proper Data...", "Warning");
					return;
				}

				$.ajax({
					type: "POST",
					url: "{{ route('admin.venue-booking.venue-book.store') }}",
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
								window.location = "{{ route('admin.venue-booking.venue-book') }}";
							};

							toastr["success"]("Venue Booked Successfully", "Success");
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
