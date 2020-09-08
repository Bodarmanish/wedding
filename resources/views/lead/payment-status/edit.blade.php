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
				Payment Status
				<span class="kt-subheader-search__desc">
					Edit Payment Status
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
								Edit Payment Status
							</h3>
						</div>
					</div>

					<form class="kt-form edit__form" method="POST">
						@csrf
						<div class="kt-portlet__body">

							<div class="form-group">
								<label>Customer <span style="color: red;">*</span></label>
								<select class="form-control kt-select2 customer" id="customer_select" name="customer_id">
									<option value="">Select Customer</option>
									@foreach($customers as $data)
										<option value="{{ $data->id }}" {{ $data->id == $payment->customer_id ? 'selected' : '' }} >{{ $data->customer_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Venue <span style="color: red;">*</span></label>
								<select class="form-control kt-select2 customer" id="venue" name="vanue_id">
									<option value="">Select Venue</option>
									@foreach($venue as $data)
									<option value="{{ $data->id }}" {{ $data->id == $payment->vanue_id ? 'selected' : '' }} >{{ $data->venue_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Leads <span style="color: red;">*</span></label>
								<select class="form-control kt-select2 customer" id="lead_select" name="lead_id">
									<option value="">Select Lead</option>
								</select>
							</div>
							<div class="form-group received_payment" >
								<label>Received Payment <span style="color: red;">*</span></label>
								<input type="number" name="received_payment" value="{{ $payment->received_payment }}" class="form-control" id="rcce_payment" placeholder="Enter Received Payment Amount">
							</div>
							<div class="form-group payment_date_div" >
								<label>Payment Date <span style="color: red;">*</span></label>
								<input type="text" name="payment_date" value="{{ $payment->payment_date }}" class="form-control" id="payment_date">
							</div>
							<div class="form-group remaining_amount_div" >
								<label>Remaining Amount </label>
								<input type="text" readonly name="remaining_amount" value="{{ $payment->remaining_amount }}" class="form-control" id="remaining_amount">
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-primary" data-id="{{ route('admin.lead.payemnt-status.edit',$payment->id) }}"  id="update">Submit</button>
								<a href="{{ route('admin.lead.payment-status') }}" class="btn btn-secondary">Cancel</a>
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

		var startDate = new Date();
		$( "#payment_date" ).datepicker({
			format: "dd/mm/yyyy",
			autoclose: true,
			todayHighlight: true,
			minDate: new Date(),
		});
		$( "#payment_date" ).datepicker('setDate', 'today');
		// $('#payment_date').datepicker('setStartDate', startDate);

		//remininr amount
		$("#rcce_payment").on('focusout', function() {
			var customer_id = $('#customer_select').val();
			var lead = $('#lead_select').val();
			var venue = $('#venue').val();
			var reamount = $('#rcce_payment').val();
			$.ajax({
				type: "POST",
				url: "{{ route('admin.lead.payment-status.get-remaining-amount') }}",
				data: {
					'_token': $('input[name="_token"]').val(),
					'customer_id': customer_id,
					'lead': lead,
					'venue': venue,
					'reamount': reamount,
				},
				success: function (data)
				{
					console.log(data);
					$('#remaining_amount').val(data);
				}
			});
			
		});

		$("#customer_select").change(function() {
			var customer_id = $(this).children(":selected").val();
			$('#lead_select').empty().append('<option disabled>select</option>'); 
			$.ajax({
				type: "POST",
				url: "{{ route('admin.lead.payment-status.get-amount') }}",
				data: {
					'_token': $('input[name="_token"]').val(),
					'customer_id': customer_id,
				},
				success: function (data)
				{
					var array = data;
					if (array != '')
					{	
						for (i in array) {  
							$("#lead_select").append('<option value="'+array[i].id+'">'+array[i].amount+'</option>');
						}
					}
				}
			});
			
		});

		$(".edit__form").validate({
			rules:
			{
				customer_id:
				{
					required: true
				},
				vanue_id:
				{
					required: true
				},
				lead_id:
				{
					required: true
				},
				received_payment:
				{
					required: true
				},
				payment_date:
				{
					required: true
				},
				remaining_amount:
				{
					required: true
				}
			},
			messages:
			{
				customer_id:
				{
					required: "Select Customer"
				},
				vanue_id:
				{
					required: "Select Vanue"
				},
				lead_id:
				{
					required: "Select Lead"
				},
				received_payment:
				{
					required: "Enter Received Payment"
				},
				payment_date:
				{
					required: "Select Customer"
				},
				remaining_amount:
				{
					required: "Enter Remaining Amount"
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
			var url = $(this).attr("data-id");
			e.preventDefault();
			if ($(".edit__form").valid())
			{
				$.ajax({
					type: "POST",
					url: url,
					data: new FormData($('.edit__form')[0]),
					processData: false,
					contentType: false,
					success: function (data)
					{
						if (data === 'true') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							toastr.options.onHidden = function(){
								window.location = "{{ route('admin.lead.payment-status') }}";
							};

							toastr["success"]("Payment-status Updated Successfully", "Success");
						}
						else if (data === 'duplicate') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							
							toastr["warning"]("Payment-status already exist", "Warning");
						} 
						else if(data === 'error') 
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
