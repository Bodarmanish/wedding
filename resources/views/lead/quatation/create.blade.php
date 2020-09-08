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
				Quatation
				<span class="kt-subheader-search__desc">
					@if(isset($edit))
					Edit Quatation
					@else
					Create Quatation
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
								Edit Quatation
								@else
								Create Quatation
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
								<label>Customer Name <span style="color: red;">*</span></label>
								<select class="form-control kt-select2 customer_name" id="customer_name" name="customer_name">
									<option value="">Select Customer</option>
									@foreach($customers as $customer)
									<?php
									$selected = '';
									if($customer->id == $edit->customer_id) {
										$selected = ' selected';
									}
									?>
									<option {{ $selected }} value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Quatation <span style="color: red;">*</span></label>
								<input type="file" class="form-control" id="quatation" name="quatation">
								<span class="form-text text-muted">NOTE : .jpg, .jpeg, .png, .pdf, .doc, .docx, .csv, .xls, .xlsx, .ppt, .pptx files supported.</span>

								<?php
								$extension = pathinfo($edit->quatation, PATHINFO_EXTENSION);
								if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
									?>
									<img src="{{ asset($edit->quatation) }}" style="width: 80px; height: 80px; margin-left: 10px; margin-top: 10px;">
								<?php } else if($extension == 'pdf') { ?>
									<img src="{{ asset('assets/media/icons/pdf-icon.png') }}" style="width: 80px; height: 80px; margin-left: 10px; margin-top: 10px;">
								<?php } else if($extension == 'doc' || $extension == 'docx') { ?>
									<img src="{{ asset('assets/media/icons/word-icon.png') }}" style="width: 80px; height: 80px; margin-left: 10px; margin-top: 10px;">
								<?php } else if($extension == 'csv' || $extension == 'xls' || $extension == 'xlsx') { ?>
									<img src="{{ asset('assets/media/icons/excel-icon.png') }}" style="width: 80px; height: 80px; margin-left: 10px; margin-top: 10px;">
								<?php } else if($extension == 'ppt' || $extension == 'pptx') { ?>
									<img src="{{ asset('assets/media/icons/powerpoint-icon.png') }}" style="width: 80px; height: 80px; margin-left: 10px; margin-top: 10px;">
								<?php } ?>

							</div>
							<div class="form-group">
								<label>Amount <span style="color: red;">*</span></label>
								<input type="number" name="amount" class="form-control" id="amount" placeholder="Enter Quatation Amount" value="{{ $edit->amount }}">
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-primary" id="update">Update</button>
								<a href="{{ route('admin.lead.quotation') }}" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
					</form>

					@else

					<form class="kt-form add__form" method="POST">
						@csrf
						<div class="kt-portlet__body">

							<div class="form-group">
								<label>Customer Name <span style="color: red;">*</span></label>
								<select class="form-control kt-select2 customer_name" id="customer_name" name="customer_name">
									<option value="">Select Customer</option>
									@foreach($customers as $customer)
									<option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Quatation <span style="color: red;">*</span></label>
								<input type="file" class="form-control" id="quatation" name="quatation">
								<span class="form-text text-muted">NOTE : .jpg, .jpeg, .png, .pdf, .doc, .docx, .csv, .xls, .xlsx, .ppt, .pptx files supported.</span>
							</div>
							<div class="form-group">
								<label>Amount <span style="color: red;">*</span></label>
								<input type="number" name="amount" class="form-control" id="amount" placeholder="Enter Quatation Amount">
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-primary" id="save">Submit</button>
								<a href="{{ route('admin.lead.quotation') }}" class="btn btn-secondary">Cancel</a>
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

		$('.customer_name').select2({
			placeholder: 'Select Customer'
		});


		$(".add__form").validate({
			rules:
			{
				customer_name:
				{
					required: true
				},
				quatation:
				{
					required: true,
					extension: "jpg|jpeg|png|pdf|doc|docx|csv|xls|xlsx|ppt|pptx"
				},
				amount:
				{
					required: true
				}
			},
			messages:
			{
				customer_name:
				{
					required: "Select Customer"
				},
				quatation:
				{
					required: "Select File"
				},
				amount:
				{
					required: "Enter Quatation Amount"
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
					url: "{{ route('admin.lead.quotation.store') }}",
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
								window.location = "{{ route('admin.lead.quotation') }}";
							};

							toastr["success"]("Quatation Added Successfully", "Success");
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
				customer_name:
				{
					required: true
				},
				quatation:
				{
					extension: "jpg|jpeg|png|pdf|doc|docx|csv|xls|xlsx|ppt|pptx"
				},
				amount:
				{
					required: true
				}
			},
			messages:
			{
				customer_name:
				{
					required: "Select Customer"
				},
				quatation:
				{
					required: "Select File"
				},
				amount:
				{
					required: "Enter Quatation Amount"
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
					url: "{{ route('admin.lead.quotation.update') }}",
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
								window.location = "{{ route('admin.lead.quotation') }}";
							};

							toastr["success"]("Quatation Updated Successfully", "Success");
						}
						else if (data.status === 'duplicate') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							
							toastr["warning"]("Quatation already exist", "Warning");
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
