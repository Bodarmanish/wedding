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
				{{$title}}
				<span class="kt-subheader-search__desc">
					@if($db_data->id > 0)
					Edit {{$title}}
					@else
					Create {{$title}}
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
								@if($db_data->id > 0)
								Edit {{$title}}
								@else
								Create {{$title}}
								@endif
							</h3>
						</div>
					</div>
					<form class="kt-form add__form" method="POST">
						@csrf
						<div class="kt-portlet__body">

							<div class="form-group">
								<label for="service_name">Service Name <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Enter Service Name" id="service_name" name="service_name" value="{{$db_data->service_name}}">
							</div>
							<div class="form-group">
								<label for="service_description">Service Description <span style="color: red;">*</span></label>
								<textarea type="text" class="form-control" placeholder="Enter Service Description" id="service_description" name="service_description">{{$db_data->service_description}}</textarea>
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<div class="row loader_div" style="display: none;">
									<img src="{{ asset('assets/media/icons/final-loader.gif') }}" style="width: 50px; height: 45px;"> <span style="margin-top: 12px;">Please Wait...</span>
								</div>
								<input type="hidden" name="type" value="{{ $db_data->type }}">
                				<input type="hidden" name="id" value="{{ $db_data->id }}">
								<button type="submit" class="btn btn-primary" id="save">Submit</button>
								<a href="{{ route('admin.service.services') }}" id="cancel" class="btn btn-secondary">Cancel</a>
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


		$(".add__form").validate({
			rules:
			{
				service_name:
				{
					required: true
				},
				service_description:
				{
					required: true
				}
			},
			messages:
			{
				service_name:
				{
					required: "Enter Service Name"
				},
				service_description:
				{
					required: "Enter Service Description"
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
					url: "{{ route('admin.service.services.store') }}",
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
								window.location = "{{ route('admin.service.services') }}";
							};

							toastr["success"]("{{$title}} Added Successfully", "Success");
						}
						else if (data.status === 'duplicate') 
						{
							toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							
							toastr["warning"]("{{$title}} already exist", "Warning");
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
