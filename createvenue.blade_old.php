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
				Venue
				<span class="kt-subheader-search__desc">Create Venue</span>
			</h3>
		</div>
	</div>


	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet">
			
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Venue Details
					</h3>
				</div>
			</div>
			

			<form class="kt-form kt-form--label-right">
				@csrf
				<div class="kt-portlet__body">
					<div class="form-group row">
						<div class="col-lg-6">
							<label>Venue Name:</label>
							<input type="text" class="form-control" placeholder="Venue Name" id="venue_name" name="venue_name">
						</div>
						<div class="col-lg-6">
							<label>Venue Address:</label>
							<textarea class="form-control" placeholder="Venue Address" id="venue_address" name="venue_address" rows="1"></textarea>
						</div>
					</div>
					

					<div class="form-group row">
						<div class="col-lg-6">
							<label>Venue Email:</label>
							<input type="email" class="form-control" placeholder="Venue email" id="venue_email" name="venue_email">
						</div>
						
						<div class="col-lg-6">
							<label class="">Venue District:</label>
							<input type="text" class="form-control" placeholder="Venue District" id="venue_district" name="venue_district">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-6">
							<label>Venue Mobile:</label>
							<input type="text" class="form-control" placeholder="Venue Mobile" id="venue_mobile" name="venue_mobile">
						</div>
						
						<div class="col-lg-6">
							<label for="exampleSelect1">Venue Type</label>
							<select class="form-control" id="venue_type" name="venue_type">
								<option value="">Select Venue Type</option>
							
								@foreach($venu_types as $venues)
									<option value="{{ $venues->id }}">{{ $venues->venue_type }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Owner Details
						</h3>
					</div>
				</div>

				<div class="kt-portlet__body">
					<div class="form-group row">
						<div class="col-lg-6">
							<label>Owner Name:</label>
							<input type="text" class="form-control" placeholder="Owner Name" id="owner_name" name="owner_name">
						</div>
						<div class="col-lg-6">
							<label>Owner Email:</label>
							<input type="email" class="form-control" placeholder="Owner email" id="owner_email" name="owner_email">
						</div>
					</div>
					

					<div class="form-group row">
						<div class="col-lg-6">
							<label>Owner Mobile 1:</label>
							<input type="text" class="form-control" placeholder="Owner Mobile 1" id="owner_mobile_first" name="owner_mobile_first">
						</div>
						
						<div class="col-lg-6">
							<label class="">Owner Mobile 2:</label>
							<input type="text" class="form-control" placeholder="Owner Mobile 2" id="owner_mobile_second" name="owner_mobile_second">
						</div>
					</div>
				</div>


				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Venue Other Details
						</h3>
					</div>
				</div>


				<div class="kt-portlet__body">
					
					<div class="form-group row">
						<div class="col-lg-12">
							<label>About Venue:</label>
							<textarea class="form-control" placeholder="Enter venue address" id="about_venue" name="about_venue"></textarea>
						</div>
					</div>
				</div>

				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Features
						</h3>
					</div>
				</div>

				<div class="kt-portlet__body">
					<div class="form-group row">
						<div class="col-lg-6">
							<label>Recetion Capacity:</label>
							<input type="text" class="form-control" placeholder="Recetion Capacity" id="recetion_capacity" name="recetion_capacity">
						</div>
						<div class="col-lg-6">
							<label>Floating Capacity:</label>
							<input type="text" class="form-control" placeholder="Floating Capacity" id="floating_capacity" name="floating_capacity">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-6">
							<label>Dinning Capacity:</label>
							<input type="text" class="form-control" placeholder="Dinning Capacity" id="dinning_capacity" name="dinning_capacity">
						</div>
						
						<div class="col-lg-6">
							<label class="">Number of Rooms:</label>
							<input type="text" class="form-control" placeholder="Number of Rooms" id="number_of_rooms" name="number_of_rooms">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-6">
							<label>A/c rooms:</label>
							<input type="text" class="form-control" placeholder="A/c rooms" id="ac_rooms" name="ac_rooms">
						</div>
						
						<div class="col-lg-6">
							<label class="">Non A/c Rooms:</label>
							<input type="text" class="form-control" placeholder="Non A/c" id="non_ac_rooms" name="non_ac_rooms">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-6">
							<label>Total Area:</label>
							<input type="text" class="form-control" placeholder="Total Area" id="total_area" name="total_area">
						</div>
						
						<div class="col-lg-6">
							<label class="">No. of Chairs:</label>
							<input type="text" class="form-control" placeholder="Number Of Chairs" id="no_of_chairs" name="no_of_chairs">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-6">
							<label for="exampleSelect1">LPG Gas</label>
							<select class="form-control" id="lpg_gas" name="lpg_gas">
								<option value="">Select Option</option>
								<option value="0">Not Available</option>
								<option value="1">Available</option>
							</select>
						</div>
						
						<div class="col-lg-6">
							<label for="exampleSelect1">Power Backup</label>
							<select class="form-control" id="power_backup" name="power_backup">
								<option value="">Select Option</option>
								<option value="0">Not Available</option>
								<option value="1">Available</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-6">
							<label for="exampleSelect1">Kitchen Type</label>
							<select class="form-control" id="kitchen_type" name="kitchen_type">
								<option value="">Select Option</option>
								<option value="0">Veg</option>
								<option value="1">Non Veg</option>
								<option value="2">Both</option>
							</select>
						</div>
						
						<div class="col-lg-6">
							<label>Venue is suitable for</label>
							<div class="kt-checkbox-inline">
								@foreach($all_functions as $func)
								<label class="kt-checkbox">
									<input type="checkbox" name="function_type[]" id="function_type" value="{{ $func->id }}"> {{ $func->function_type }}
									<span></span>
								</label>
								@endforeach
							</div>
						</div>
					</div>
				</div>

				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Aminities
						</h3>
					</div>
				</div>

				<div class="kt-portlet__body">
					<div class="form-group row">
						<div class="col-lg-6">
							<label for="exampleSelect1">Hot water avialable.?</label>
							<select class="form-control" id="hot_water" name="hot_water">
								<option value="">Select Option</option>
								<option value="0">Not Available</option>
								<option value="1">Available</option>
							</select>
						</div>
						<div class="col-lg-6">
							<label for="exampleSelect1">Lift avialable.?</label>
							<select class="form-control" id="lift_available" name="lift_available">
								<option value="">Select Option</option>
								<option value="0">Not Available</option>
								<option value="1">Available</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-6">
							<label for="exampleSelect1">CCTV Security.?</label>
							<select class="form-control" id="cctv" name="cctv">
								<option value="">Select Option</option>
								<option value="0">Not Available</option>
								<option value="1">Available</option>
							</select>
						</div>
						
						<div class="col-lg-6">
							<label for="exampleSelect1">Jewellery locker available.?</label>
							<select class="form-control" id="jewellery" name="jewellery">
								<option value="">Select Option</option>
								<option value="0">Not Available</option>
								<option value="1">Available</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-6">
							<label for="exampleSelect1">Generator Facility.?</label>
							<select class="form-control" id="generator" name="generator">
								<option value="">Select Option</option>
								<option value="0">Not Available</option>
								<option value="1">Available</option>
							</select>
						</div>
						
						<div class="col-lg-6">
							<label class="">Security Guards:</label>
							<input type="text" class="form-control" placeholder="Enter number of security guards" id="security_guards" name="security_guards">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-6">
							<label>Bike Parking Capacity:</label>
							<input type="text" class="form-control" placeholder="Number Of Bike Parking Capacity" id="bike_parking" name="bike_parking">
						</div>
						
						<div class="col-lg-6">
							<label class="">Car Parking Capacity:</label>
							<input type="text" class="form-control" placeholder="Number Of Car Parking Capacity" id="car_parking" name="car_parking">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-6">
							<label class="">Toilets:</label>
							<input type="text" class="form-control" placeholder="Number Of Toilets" id="toilets" name="toilets">
						</div>
						
						<div class="col-lg-6">
							<label class="">Helpers:</label>
							<input type="text" class="form-control" placeholder="Number Of helpers" id="total_helpers" name="total_helpers">
						</div>
					</div>

					
				</div>

				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-6">
								{{-- <button type="reset" class="btn btn-primary">Save</button>
								<button type="reset" class="btn btn-secondary">Cancel</button> --}}
							</div>
							<div class="col-lg-6 kt-align-right">
								<button type="submit" id="save_venue" class="btn btn-primary">Add Venue</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<script>
	$(document).ready(function () {

	    $(".kt-form").validate({
	        rules:
	        {
	        	venue_name:
	        	{
	        		required: true
	        	},
	        	venue_address:
	        	{
	        		required: true
	        	},
	            venue_district:
	            {
	                required: true
	            },
	            venue_type:
	            {
	            	required: true
	            },
	            owner_name:
	            {
	                required: true
	            },
	            owner_mobile_first:
	            {
	            	required: true,
	            	number: true,
	            	minlength: 10,
	            	maxlength: 10
	            },
	            owner_mobile_second:
	            {
	            	number: true,
	            	minlength: 10,
	            	maxlength: 10
	            },
	            about_venue:
	            {
	            	required: true
	            },
	            recetion_capacity:
	            {
	            	required: true,
	            	number: true
	            },
	            floating_capacity:
	            {
	            	required: true,
	            	number: true
	            },
	            dinning_capacity:
	            {
	            	required: true,
	            	number: true
	            },
	            number_of_rooms:
	            {
	            	required: true,
	            	number: true
	            },
	            ac_rooms:
	            {
	            	required: true,
	            	number: true
	            },

	            non_ac_rooms:
	            {
	            	required: true,
	            	number: true
	            },
	            total_area:
	            {
	            	required: true,
	            	number: true
	            },
	            no_of_chairs:
	            {
	            	required: true,
	            	number: true
	            },
	            lpg_gas:
	            {
	            	required: true
	            },
	            power_backup:
	            {
	            	required: true
	            },
	            kitchen_type:
	            {
	            	required: true
	            },
	            function_type:
	            {
	            	required: true
	            },

	            hot_water:
	            {
	            	required: true
	            },
	            lift_available:
	            {
	            	required: true
	            },
	            cctv:
	            {
	            	required: true
	            },
	            jewellery:
	            {
	            	required: true
	            },
	            generator:
	            {
	            	required: true
	            },
	            security_guards:
	            {
	            	required: true,
	            	number: true
	            },
	            bike_parking:
	            {
	            	required: true,
	            	number: true
	            },
	            car_parking:
	            {
	            	required: true,
	            	number: true
	            },
	            toilets:
	            {
	            	required: true,
	            	number: true
	            },
	            total_helpers:
	            {
	            	required: true,
	            	number: true
	            }
	        },
	        messages:
	        {
	           venue_name:
	        	{
	        		required: "Venue name is required"
	        	},
	        	venue_address:
	        	{
	        		required: "Address is required"
	        	},
	            venue_district:
	            {
	                required: "District is required"
	            },
	            venue_type:
	            {
	            	required: "Select venue type"
	            },
	            owner_name:
	            {
	                required: "Owner name required"
	            },
	            owner_mobile_first:
	            {
	            	required: "Owner mobile number is required",
	            	number: "Enter valid mobile number",
	            	minlength: "Mobile number should be 10 digits",
	            	maxlength: "Mobile number should be 10 digits"
	            },
	            owner_mobile_second:
	            {
	            	number: "Enter valid mobile number",
	            	minlength: "Mobile number should be 10 digits",
	            	maxlength: "Mobile number should be 10 digits"
	            },
	            about_venue:
	            {
	            	required: "Write Something about venue"
	            },
	            recetion_capacity:
	            {
	            	required: "Enter Recetion Capacity",
	            	number: "Enter numeric value only"
	            },
	            floating_capacity:
	            {
	            	required: "Enter Floating Capacity",
	            	number: "Enter numeric value only"
	            },
	            dinning_capacity:
	            {
	            	required: "Enter Dinning Capacity",
	            	number: "Enter numeric value only"
	            },
	            number_of_rooms:
	            {
	            	required: "Enter number of rooms",
	            	number: "Enter numeric value only"
	            },
	            ac_rooms:
	            {
	            	required: "Enter number of ac rooms",
	            	number: "Enter numeric value only"
	            },

	            non_ac_rooms:
	            {
	            	required: "Enter number of Non A/c rooms",
	            	number: "Enter numeric value only"
	            },
	            total_area:
	            {
	            	required: "Total area is required",
	            	number: "Enter numeric value only"
	            },
	            no_of_chairs:
	            {
	            	required: "Number of chairs is required",
	            	number: "Enter numeric value only"
	            },
	            lpg_gas:
	            {
	            	required: "Select an option"
	            },
	            power_backup:
	            {
	            	required: "Select an option"
	            },
	            kitchen_type:
	            {
	            	required: "Select an Option"
	            },
	            function_type:
	            {
	            	required: "Select venue is suitable for"
	            },
	            hot_water:
	            {
	            	required: "Select an option"
	            },
	            lift_available:
	            {
	            	required: "Select an option"
	            },
	            cctv:
	            {
	            	required: "Select an option"
	            },
	            jewellery:
	            {
	            	required: "Select an option"
	            },
	            generator:
	            {
	            	required: "Select an optioin"
	            },
	            security_guards:
	            {
	            	required: "Select an option",
	            	number: "Enter numeric value only"
	            },
	            bike_parking:
	            {
	            	required: "Bike parking is required",
	            	number: "Enter numeric value only"
	            },
	            car_parking:
	            {
	            	required: "Car parking is required",
	            	number: "Enter numeric value only"
	            },
	            toilets:
	            {
	            	required: "Enter number of toilets available in venue",
	            	number: "Enter numeric value only"
	            },
	            total_helpers:
	            {
	            	required: "Enter number of helpers available in venue",
	            	number: "Enter numeric value only"
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
		$("#save_venue").on("click", function (e)
	    {
	    	// alert('test');
	    	// return;
	        e.preventDefault();
	        if ($(".kt-form").valid())
	        {
	            $.ajax({
	                type: "POST",
	                url: "{{ route('admin.save.venue') }}",
	                data: new FormData($('.kt-form')[0]),
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

							toastr["success"]("User Added Successfully", "Success");
	                    }
	                    else if (data.status === 'user_exist') 
	                    {
	                    	toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							
                            toastr["warning"]("User with the same Role and Email is already exist", "Warning");
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
