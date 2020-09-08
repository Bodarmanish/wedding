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
								<label for="full_name">Full Name <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Enter Full Name" id="full_name" name="full_name" value="{{$db_data->full_name}}">
							</div>

							<div class="form-group">
								<label for="business_name">Business Name <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Enter Business Name" id="business_name" name="business_name" value="{{$db_data->business_name}}">
							</div>

							<div class="form-group">
								<label for="mobile">Mobile <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Enter Mobile" id="mobile" name="mobile" value="{{$db_data->mobile}}">
							</div>

							<div class="form-group">
								<label for="email">Email <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Enter Email" id="email" name="email" value="{{$db_data->email}}">
							</div>
							<div class="form-group">
								<label for="password">Password <span style="color: red;">*</span></label>
								<input type="password" class="form-control" placeholder="Enter Password" id="password" name="password" value="{{$db_data->password}}">
							</div>

							<div class="form-group">
								<label for="address">Address <span style="color: red;">*</span></label>
								<textarea type="text" class="form-control" placeholder="Enter Address" id="address" name="address">{{$db_data->address}}</textarea>
							</div>

							<div class="form-group">
                                <label>Service <span style="color: red;">*</span></label>
                                <select class="form-control kt-select2" autocomplete="off" id="kt_select2_service" name="service[]" multiple="multiple">
                                    @foreach($services as $val)
                                    	@if(isset($vendor_services) && in_array($val->id, $vendor_services))
                                    		<option selected value="{{$val->id}}">{{$val->service_name}}</option>
                                    	@else
                                    		<option value="{{$val->id}}">{{$val->service_name}}</option>
                                    	@endif
                                    @endforeach
                                </select>
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
								<a href="{{ route('admin.vendor.vendors') }}" id="cancel" class="btn btn-secondary">Cancel</a>
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

		$('#kt_select2_service').select2({
	        placeholder: 'Select Service'
	    });


		$(".add__form").validate({
			rules:
			{
				full_name:{
					required: true
				},
				business_name :{
					required: true
				},
				mobile:{
					required: true
				},
				email:{
					required:true,
					email:true
				},
				address:{
					required: true
				},
				'service[]':{
					required: true
				}
			},
			messages:
			{
				full_name:{
					required: "Enter Full Name"
				},
				business_name:{
					required:"Enter Business Name"
				},
				mobile:{
					required:"Enter Mobile"
				},
				email:{
					required:"Enter Email",
					email:"Enter Valid Email"
				},
				address:{
					required: "Enter Address"
				},
				'service[]':{
					required: "Select Service"
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
					url: "{{ route('admin.vendor.vendors.store') }}",
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
								window.location = "{{ route('admin.vendor.vendors') }}";
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
