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
				Roles
				<span class="kt-subheader-search__desc">
					@if(isset($edit))
					Edit Venue Type & Charge
					@else
					Add Venue Type & Charge
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
								Edit Venue Type & Charge
								@else
								Add Venue Type & Charge
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
								<label>Venue Type <span style="color: red;">*</span></label>
								<select class="form-control kt-selectpicker venue_type" id="venue_type" name="venue_type[]" multiple>
									@foreach($venue_type as $vt)
									<?php
									 $venue_types =  explode(',',$edit->venue_type);
									 
									 // print_r($venue_types);
									 // return;
									
									// dd($venue_types);
									// foreach ($venue_types as $vty) {
									$selected = '';
									if (in_array($vt->id,$venue_types)) {
										// if($vt->id == $venue_types) {
										$selected = ' selected';
									}
									// }
									?>
									<option {{ $selected }} value="{{ $vt->id }}">{{ $vt->venue_type }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Price Per Plate OR Rent <span style="color: red;">*</span></label>
								<input type="number" name="price_per_plate_or_rent" class="form-control" value="{{ $edit->price_per_plate_or_rent }}" id="price_per_plate_or_rent" placeholder="Enter Price Per Plate">
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-primary" id="update">Update</button>
								<a href="{{ route('admin.masters.venue-settings.venue-type-and-charges') }}" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
					</form>

					@else

					<form class="kt-form add__form" method="POST">
						@csrf
						<div class="kt-portlet__body">
							<div class="form-group">
								<label>Venue Type <span style="color: red;">*</span></label>
								<select class="form-control kt-selectpicker venue_type" id="venue_type" name="venue_type[]" multiple>
									@foreach($venue_type as $vt)
									<option value="{{ $vt->id }}">{{ $vt->venue_type }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Price Per Plate OR Rent <span style="color: red;">*</span></label>
								<input type="number" name="price_per_plate_or_rent" class="form-control" id="price_per_plate_or_rent" placeholder="Enter Price Per Plate">
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-primary" id="save">Submit</button>
								<a href="{{ route('admin.masters.venue-settings.venue-type-and-charges') }}" class="btn btn-secondary">Cancel</a>
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
				venue_type:
				{
					required: true
				},
				price_per_plate_or_rent:
				{
					required: true
				}
			},
			messages:
			{
				venue_type:
				{
					required: "Select Venue Type"
				},
				price_per_plate_or_rent:
				{
					required: "Enter Price Per Plate OR Rent"
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
					url: "{{ route('admin.masters.venue-settings.venue-type-and-charges.save') }}",
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

							toastr["success"]("Venue Type & Charge Added Successfully", "Success");
						}
						else if (data.status === 'duplicate') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							
							toastr["warning"]("Venue Type & Charge already exist", "Warning");
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
				venue_type:
				{
					required: true
				},
				price_per_plate_or_rent:
				{
					required: true
				}
			},
			messages:
			{
				venue_type:
				{
					required: "Select Venue Type"
				},
				price_per_plate_or_rent:
				{
					required: "Enter Price Per Plate OR Rent"
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
					url: "{{ route('admin.masters.venue-settings.venue-type-and-charges.update') }}",
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

							toastr["success"]("Venue Type & Charges Updated Successfully", "Success");
						}
						else if (data.status === 'duplicate') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							
							toastr["warning"]("Venue Type & Charges already exist", "Warning");
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
