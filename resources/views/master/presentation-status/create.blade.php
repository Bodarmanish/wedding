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
				Presentation Status
				<span class="kt-subheader-search__desc">
					@if(isset($edit))
					Edit Presentation Status
					@else
					Create Presentation Status
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
								Edit Presentation Status
								@else
								Create Presentation Status
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
								<label>Presentation Status Name <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Enter Event Type Name" id="presentation_status_name" name="presentation_status_name" value="{{ $edit->presentation_status }}">
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-primary" id="update">Update</button>
								<a href="{{ route('admin.master.presentation-status') }}" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
					</form>

					@else

					<form class="kt-form add__form" method="POST">
						@csrf
						<div class="kt-portlet__body">

							<div class="form-group">
								<label>Presentation Status Name <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Enter Event Type Name" id="presentation_status_name" name="presentation_status_name">
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-primary" id="save">Submit</button>
								<a href="{{ route('admin.master.presentation-status') }}" class="btn btn-secondary">Cancel</a>
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


		$(".add__form").validate({
			rules:
			{
				presentation_status_name:
				{
					required: true
				}
			},
			messages:
			{
				presentation_status_name:
				{
					required: "Enter Presentation Status"
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
					url: "{{ route('admin.master.presentation-status.store') }}",
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
								window.location = "{{ route('admin.master.presentation-status') }}";
							};

							toastr["success"]("Presentation Status Added Successfully", "Success");
						}
						else if (data.status === 'duplicate') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							
							toastr["warning"]("Presentation status already exist", "Warning");
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
				presentation_status_name:
				{
					required: true
				}
			},
			messages:
			{
				presentation_status_name:
				{
					required: "Enter Event Type"
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
					url: "{{ route('admin.master.presentation-status.update') }}",
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
								window.location = "{{ route('admin.master.presentation-status') }}"
							};

							toastr["success"]("Presentation Status Updated Successfully", "Success");
						}
						else if (data.status === 'duplicate') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							
							toastr["warning"]("Presentation status already exist", "Warning");
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
