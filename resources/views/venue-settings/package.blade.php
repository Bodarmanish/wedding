@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<!-- <link href="{{ asset('assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" /> -->

<style type="text/css">
	.invalid-feedback
	{
		/*color: red;*/
		font-size: 13px;
	}
</style>


<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Venue Setting
				<span class="kt-subheader-search__desc">
					Create Package
				</span>
			</h3>
		</div>
	</div>


	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Create Package
					</h3>
				</div>
			</div>

			<form class="kt-form add__form" method="POST">
				@csrf
				<div class="kt-portlet__body">

					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
								<label>Package Name <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Enter Package Name" id="package_name" name="package_name">
							</div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
								<label>Venue Type <span style="color: red;">*</span></label>
								<select class="form-control" id="venue_type" name="venue_type">
									<option value="">Select Venue Type</option>
									@foreach($venue_type as $vt)
									<option value="{{ $vt->id }}">{{ $vt->venue_type }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12 col-md-4 col-lg-4">
							<div class="form-group">
								<label>Price <span style="color: red;">*</span></label>
								<input type="number" class="form-control" placeholder="Enter Price" id="price" name="price">
							</div>
						</div>
						<div class="col-sm-12 col-md-4 col-lg-4">
							<div class="form-group">
								<label>GST (%)<span style="color: red;">*</span></label>
								<input type="number" class="form-control" placeholder="Enter GST" id="gst" name="gst">
							</div>
						</div>
						<div class="col-sm-12 col-md-4 col-lg-4">
							<div class="form-group">
								<label>Total <span style="color: red;">*</span></label>
								<input type="number" class="form-control" readonly="" placeholder="Total" id="total" name="total">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
								<label>Timing From <span style="color: red;">*</span></label>
								<input type="text" class="form-control" readonly="" placeholder="Select Time" id="timing_from" name="timing_from">
							</div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
								<label>Timing To <span style="color: red;">*</span></label>
								<input type="text" class="form-control" readonly="" placeholder="Select Time" id="timing_to" name="timing_to">
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
						<div class="col-md-2 col-lg-2"></div>
						<div class="col-md-2 col-lg-2"></div>
						<div class="col-md-2 col-lg-2"></div>
						<div class="col-md-2 col-lg-2"></div>
						<div class="col-sm-12 col-md-2 col-lg-2">
							<div class="form-group">
								<label>Grand Total</label>
								<input type="number" class="form-control grand_total" readonly="" placeholder="Grand Total" id="grand_total" name="grand_total">
							</div>
						</div>
						<div class="col-md-2 col-lg-2"></div>
					</div>

				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" class="btn btn-primary" id="save">Submit</button>
						<a href="{{ route('admin.venue-settings.list') }}" class="btn btn-secondary">Cancel</a>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>


<script src="{{ asset('assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/custom/js/vendors/bootstrap-timepicker.init.js') }}" type="text/javascript"></script>


<script>
	$(document).ready(function () {

		$('#timing_from').timepicker();

		$('#timing_to').timepicker();

		// alert($('#timing_from').val());

		


		$("#price").keyup(function(){
			var price = $(this).val();
			var gst = $('#gst').val();

			var gst_price = price * gst / 100;
			var total = parseFloat(price) + parseFloat(gst_price);

			$('#total').val(total);
		});

		$("#gst").keyup(function(){
			var gst = $(this).val();
			var price = $('#price').val();

			var gst_price = gst * price / 100;
			var total = parseFloat(price) + parseFloat(gst_price);

			$('#total').val(total);
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

		$(document).on("keyup", ".facility_quantity", function() {
			var qty = $(this).val();
			var price = $(this).closest('.master_clone_div').find(".facility_price").val();
			var gst = $(this).closest('.master_clone_div').find(".facility_gst").val();

			var gst_total = parseFloat(qty) * parseFloat(price) * parseFloat(gst) / 100;
			var total = parseFloat(qty) * parseFloat(price) + parseFloat(gst_total);

			$(this).closest('.master_clone_div').find(".facility_total").val(total);

			var grand_total = 0;
			$('.facility_total').each(function(){
				grand_total += parseInt($(this).val());
			});

			$('.grand_total').val(grand_total);

		});

		$(document).on("keyup", ".facility_gst", function() {
			var gst = $(this).val();
			var price = $(this).closest('.master_clone_div').find(".facility_price").val();
			var qty = $(this).closest('.master_clone_div').find(".facility_quantity").val();

			var gst_total = (parseFloat(qty) * parseFloat(price) * parseFloat(gst)) / 100;
			var total = parseFloat(qty) * parseFloat(price) + parseFloat(gst_total);

			$(this).closest('.master_clone_div').find(".facility_total").val(total);

			var grand_total = 0;
			$('.facility_total').each(function(){
				grand_total += parseInt($(this).val());
			});

			$('.grand_total').val(grand_total);

		});


		$(".add__form").validate({
			rules:
			{
				package_name:
				{
					required: true
				},
				venue_type:
				{
					required: true
				},
				price:
				{
					required: true
				},
				gst:
				{
					required: true
				},
				timing_from:
				{
					required: true
				},
				timing_to:
				{
					required: true
				}
			},
			messages:
			{
				package_name:
				{
					required: "Enter Package Name"
				},
				venue_type:
				{
					required: "Select Venue Type"
				},
				price:
				{
					required: "Enter Price"
				},
				gst:
				{
					required: "Enter GST"
				},
				timing_from:
				{
					required: "Select Time"
				},
				timing_to:
				{
					required: "Select Time"
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
					url: "{{ route('admin.venue-settings.store') }}",
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

							toastr["success"]("Package Added Successfully", "Success");
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
