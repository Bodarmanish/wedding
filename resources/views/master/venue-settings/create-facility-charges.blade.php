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


<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Facility Charges
				<span class="kt-subheader-search__desc">
					@if(isset($edit))
					Edit Facility Charge
					@else
					Create Facility Charge
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
								Edit Facility Charge
								@else
								Create Facility Charge
								@endif
							</h3>
						</div>
					</div>
					@if(isset($edit))

					<form class="kt-form edit__form" method="POST">
						@csrf
						<div class="kt-portlet__body">
							<input type="hidden" name="facility_id" value="{{ $edit->id }}">
							<div class="form-group">
								<label>Facility Name <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Enter Facility Name" id="facility_name" name="facility_name" value="{{ $edit->facility_name }}">
							</div>
							<div class="form-group">
								<label>Price <span style="color: red;">*</span></label>
								<input type="number" class="form-control" placeholder="Enter Price" id="price" name="price" value="{{ $edit->price }}">
							</div>
							<div class="form-group">
								<label>Complementory? </label>
								<div class="kt-radio-inline">
									@if($edit->complementory == 1)
									<label class="kt-radio">
										<input type="radio" name="complementory" checked="checked" value="1"> Yes
										<span></span>
									</label>
									<label class="kt-radio">
										<input type="radio" name="complementory" value="2"> No
										<span></span>
									</label>
									@else
									<label class="kt-radio">
										<input type="radio" name="complementory" value="1"> Yes
										<span></span>
									</label>
									<label class="kt-radio">
										<input type="radio" name="complementory" checked="checked" value="2"> No
										<span></span>
									</label>
									@endif
								</div>
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-primary" id="update">Update</button>
								<a href="{{ route('admin.masters.venue-settings.facility-charges') }}" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
					</form>

					@else

					<form class="kt-form add__form" method="POST">
						@csrf
						<div class="kt-portlet__body">

							<div class="form-group">
								<label>Facility Name <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Enter Facility Name" id="facility_name" name="facility_name">
							</div>
							<div class="form-group">
								<label>Price <span style="color: red;">*</span></label>
								<input type="number" class="form-control" placeholder="Enter Price" id="price" name="price">
							</div>
							<div class="form-group">
								<label>Complementory? </label>
								<div class="kt-radio-inline">
									<label class="kt-radio">
										<input type="radio" name="complementory" checked="checked" value="1"> Yes
										<span></span>
									</label>
									<label class="kt-radio">
										<input type="radio" name="complementory" value="2"> No
										<span></span>
									</label>
								</div>
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-primary" id="save">Submit</button>
								<a href="{{ route('admin.masters.venue-settings.facility-charges') }}" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
					</form>

					@endif
				</div>
			</div>

		</div>
	</div>
</div>


<script>
	$(document).ready(function () {

		$(".add__form").validate({
			rules:
			{
				facility_name:
				{
					required: true
				},
				price:
				{
					required: true
				}
			},
			messages:
			{
				facility_name:
				{
					required: "Enter Facility Name"
				},
				price:
				{
					required: "Enter Price"
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
					url: "{{ route('admin.masters.venue-settings.facility-charges.store') }}",
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

							toastr["success"]("Facility Added Successfully", "Success");
						}
						else if (data.status === 'facility_exist') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							
							toastr["warning"]("Facility already exist", "Warning");
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
				facility_name:
				{
					required: true
				},
				price:
				{
					required: true
				}
			},
			messages:
			{
				facility_name:
				{
					required: "Enter Facility Name"
				},
				price:
				{
					required: "Enter Price"
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
					url: "{{ route('admin.masters.venue-settings.facility-charges.update') }}",
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
								window.location.reload();
							};

							toastr["success"]("Facility Updated Successfully", "Success");
						}
						else if (data.status === 'facility_exist') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							
							toastr["warning"]("Facility already exist", "Warning");
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
