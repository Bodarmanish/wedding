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
				Feedback
				<span class="kt-subheader-search__desc">
					@if(isset($edit))
					Edit Feedback
					@else
					Create Feedback
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
								Edit Feedback
								@else
								Create Feedback
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
								<label>Customer <span style="color: red;">*</span></label>
								<select class="form-control kt-select2 customer" id="customer" name="customer">
									@foreach($customers as $data)
									<?php
									$selected = '';
									if($data->id == $edit->customer_id) {
										$selected = ' selected';
									}
									?>
									<option {{ $selected }} value="{{ $data->id }}">{{ $data->customer_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Feedback <span style="color: red;">*</span></label>
								<textarea class="form-control" rows="5" id="feedback" name="feedback">{{ $edit->feedback }}</textarea>
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-primary" id="update">Update</button>
								<a href="{{ route('admin.lead.feedback') }}" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
					</form>

					@else

					<form class="kt-form add__form" method="POST">
						@csrf
						<div class="kt-portlet__body">

							<div class="form-group">
								<label>Customer <span style="color: red;">*</span></label>
								<select class="form-control kt-select2 customer" id="customer" name="customer">
									@foreach($customers as $data)
									<option value="{{ $data->id }}">{{ $data->customer_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Feedback <span style="color: red;">*</span></label>
								<textarea class="form-control" rows="5" id="feedback" name="feedback"></textarea>
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-primary" id="save">Submit</button>
								<a href="{{ route('admin.lead.feedback') }}" class="btn btn-secondary">Cancel</a>
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

		$('.customer').select2({
			placeholder: 'Select Customer'
		});


		$(".add__form").validate({
			rules:
			{
				customer:
				{
					required: true
				},
				feedback:
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
				feedback:
				{
					required: "Enter Feedback"
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
					url: "{{ route('admin.lead.feedback.store') }}",
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
								window.location = "{{ route('admin.lead.feedback') }}";
							};

							toastr["success"]("Feedback Added Successfully", "Success");
						}
						else if (data.status === 'duplicate') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							
							toastr["warning"]("Feedback already exist", "Warning");
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
				customer:
				{
					required: true
				},
				feedback:
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
				feedback:
				{
					required: "Enter Feedback"
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
					url: "{{ route('admin.lead.feedback.update') }}",
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
								window.location = "{{ route('admin.lead.feedback') }}"
							};

							toastr["success"]("Feedback Updated Successfully", "Success");
						}
						else if (data.status === 'duplicate') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							
							toastr["warning"]("Feedback already exist", "Warning");
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
