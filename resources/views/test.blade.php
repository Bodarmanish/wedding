@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/pages/wizard/wizard-4.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
	.invalid-feedback
	{
		/*color: red;*/
		font-size: 13px;
	}
</style>


<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Content Head -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					New Venue
				</h3>
				<span class="kt-subheader__separator kt-subheader__separator--v"></span>
				<div class="kt-subheader__group" id="kt_subheader_search">
					<span class="kt-subheader__desc" id="kt_subheader_total">
						Fill the form to create venue</span>
				</div>
			</div>
			<div class="kt-subheader__toolbar">
				<a href="#" class="btn btn-default btn-bold"> Back </a>
				<div class="btn-group">
					<button type="button" class="btn btn-brand btn-bold">Submit</button>
				</div>
			</div>
		</div>
	</div>

	<!-- end:: Content Head -->

	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-wizard-v4" id="kt_user_add_user" data-ktwizard-state="last">
			<!--begin: Form Wizard Nav -->
			<div class="kt-wizard-v4__nav">
				<div class="kt-wizard-v4__nav-items nav">
					<!--doc: Replace A tag with SPAN tag to disable the step link click -->
					<div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step" data-ktwizard-state="done">
						<div class="kt-wizard-v4__nav-body">
							<div class="kt-wizard-v4__nav-number">
								1
							</div>
							<div class="kt-wizard-v4__nav-label">
								<div class="kt-wizard-v4__nav-label-title">
									Venue
								</div>
								<div class="kt-wizard-v4__nav-label-desc">
									Venue Information
								</div>
							</div>
						</div>
					</div>

					<div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step" data-ktwizard-state="done">
						<div class="kt-wizard-v4__nav-body">
							<div class="kt-wizard-v4__nav-number">
								2
							</div>
							<div class="kt-wizard-v4__nav-label">
								<div class="kt-wizard-v4__nav-label-title">
									Owner
								</div>
								<div class="kt-wizard-v4__nav-label-desc">
									Owner Information
								</div>
							</div>
						</div>
					</div>
					<div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step" data-ktwizard-state="done">
						<div class="kt-wizard-v4__nav-body">
							<div class="kt-wizard-v4__nav-number">
								3
							</div>
							<div class="kt-wizard-v4__nav-label">
								<div class="kt-wizard-v4__nav-label-title">
									Venue Features
								</div>
								<div class="kt-wizard-v4__nav-label-desc">
									Venue Information
								</div>
							</div>
						</div>
					</div>
					<div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
						<div class="kt-wizard-v4__nav-body">
							<div class="kt-wizard-v4__nav-number">
								4
							</div>
							<div class="kt-wizard-v4__nav-label">
								<div class="kt-wizard-v4__nav-label-title">
									Venue Aminities
								</div>
								<div class="kt-wizard-v4__nav-label-desc">
									Venue Information
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--end: Form Wizard Nav -->
			<div class="kt-portlet">
				<div class="kt-portlet__body kt-portlet__body--fit">
					<div class="kt-grid">
						<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">
							<!--begin: Form Wizard Form-->
							<form class="kt-form" id="kt_user_add_form" novalidate="novalidate">
								@csrf

								<!--begin: Form Wizard Step 1-->
								<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
									<div class="kt-heading kt-heading--md">Venue Details:</div>
									<div class="kt-section kt-section--first">
										<div class="kt-wizard-v4__form">
											<div class="row">
												<div class="col-xl-12">
			


			<div class="kt-section__body">
				<div class="form-group row">
					<label class="col-xl-3 col-lg-3 col-form-label">Venue Name</label>
					<div class="col-lg-9 col-xl-9">
						<input type="text" class="form-control" placeholder="Venue Name" id="venue_name" name="venue_name" required="">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-xl-3 col-lg-3 col-form-label">Venue Address</label>
					<div class="col-lg-9 col-xl-9">
						<textarea class="form-control" placeholder="Venue Address" id="venue_address" name="venue_address" rows="1" required=""></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-xl-3 col-lg-3 col-form-label">Venue Email</label>
					<div class="col-lg-9 col-xl-9">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="la la-at"></i>
								</span>
							</div>
							<input type="text" class="form-control" placeholder="Venue email" id="venue_email" name="venue_email">
						</div>
						
						
					</div>
				</div>
				<div class="form-group row">
					<label class="col-xl-3 col-lg-3 col-form-label">Venue District</label>
					<div class="col-lg-9 col-xl-9">
						<div class="input-group">

							<input type="text" class="form-control" placeholder="Venue District" id="venue_district" name="venue_district" required="">
						</div>
						
					</div>
				</div>
				<div class="form-group row">
					<label class="col-xl-3 col-lg-3 col-form-label">Venue Mobile</label>
					<div class="col-lg-9 col-xl-9">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="la la-phone"></i>
								</span>
							</div>
							<input type="number" class="form-control" placeholder="Venue Mobile" id="venue_mobile" name="venue_mobile" minlength="10" maxlength="10">
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-xl-3 col-lg-3 col-form-label">Venue Type</label>
					<div class="col-lg-9 col-xl-9">
						<div class="input-group">



							<select class="form-control" required="" id="venue_type" name="venue_type"> 
								<option value="">Select Venue Type</option>
								@foreach($venu_types as $venues)
								<option value="{{ $venues->id }}">{{ $venues->venue_type }}</option>
								@endforeach
							</select>

						</div>
					</div>
				</div>

				<div class="form-group  row">
					<label class="col-xl-3 col-lg-3 col-form-label">About Venue</label>
					<div class="col-lg-9 col-xl-9">
						<div class="input-group">



							<textarea class="form-control" placeholder="Write something about venue" id="about_venue" name="about_venue" ></textarea>

						</div>
					</div>
				</div>
			</div>

			

			
			
												</div>
											</div>
										</div>
									</div>
								</div>
		<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
									<div class="kt-heading kt-heading--md">Owner Details:</div>
									<div class="kt-section kt-section--first">
										<div class="kt-wizard-v4__form">
											<div class="row">
												<div class="col-xl-12">
			


			

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Owner Name</label>
				<div class="col-lg-9 col-xl-9">
					<input type="text" class="form-control" placeholder="Owner Name" id="owner_name" name="owner_name" required="">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Owner Email</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="la la-at"></i>
							</span>
						</div>
						<input type="email" class="form-control" placeholder="Owner email" id="owner_email" name="owner_email" required="">
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Owner Mobile 1</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="la la-phone"></i>
							</span>
						</div>
						<input type="number" class="form-control" placeholder="Owner Mobile 1" id="owner_mobile_first" name="owner_mobile_first" required="" minlength="10" maxlength="10">
					</div>
				</div>
			</div>

			<div class="form-group form-group-last row">
				<label class="col-xl-3 col-lg-3 col-form-label">Owner Mobile 2</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="la la-phone"></i>
							</span>
						</div>
						<input type="tel" class="form-control" placeholder="Owner Mobile 2" id="owner_mobile_second" name="owner_mobile_second">
					</div>
				</div>
			</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--end: Form Wizard Step 1-->

								<!--begin: Form Wizard Step 2-->
								<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
									<div class="kt-section kt-section--first">
										<div class="kt-wizard-v4__form">
											<div class="row">
												<div class="col-xl-12">
													<div class="kt-section__body">
														<div class="form-group row">
															<div class="col-lg-9 col-xl-6">
																<h3 class="kt-section__title kt-section__title-md">Venue Features</h3>
															</div>
														</div>
			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Recetion Capacity</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Recetion Capacity" id="recetion_capacity" name="recetion_capacity" required="">
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Floating Capacity</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Floating Capacity" id="floating_capacity" name="floating_capacity" required="">
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Dinning Capacity</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Dinning Capacity" id="dinning_capacity" name="dinning_capacity" required="">
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Number of Rooms</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Number of Rooms" id="number_of_rooms" name="number_of_rooms" required="">
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">A/c rooms</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="A/c rooms" id="ac_rooms" name="ac_rooms" required="">
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Non A/c Rooms</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Non A/c" id="non_ac_rooms" name="non_ac_rooms" required="">
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Total Area</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Total Area" id="total_area" name="total_area" required="">
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">No. of Chairs</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Number Of Chairs" id="no_of_chairs" name="no_of_chairs" required="">
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">LPG Gas</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<select class="form-control" id="lpg_gas" name="lpg_gas" required="">
								<option value="">Select Option</option>
								<option value="0">Not Available</option>
								<option value="1">Available</option>
							</select>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Power Backup</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<select class="form-control" id="power_backup" name="power_backup" required="">
							<option value="">Select Option</option>
							<option value="0">Not Available</option>
							<option value="1">Available</option>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Kitchen Type</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<select class="form-control" id="kitchen_type" name="kitchen_type" required="">
							<option value="">Select Option</option>
							<option value="0">Veg</option>
							<option value="1">Non Veg</option>
							<option value="2">Both</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Venue is suitable for</label>
				<div class="col-lg-9 col-xl-6">
					<div class="kt-checkbox-inline">
						@foreach($all_functions as $func)
						<label class="kt-checkbox">
							<input type="checkbox" name="function_type[]" id="function_type" value="{{ $func->id }}" required=""> {{ $func->function_type }}
							<span></span>
						</label>
						@endforeach
					</div>
				</div>
			</div>
				
			

			
			
		
			
			
			
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!--end: Form Wizard Step 2-->

								<!--begin: Form Wizard Step 3-->
								<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
									<div class="kt-heading kt-heading--md">Venue Aminities</div>
									<div class="kt-form__section kt-form__section--first">
										<div class="kt-wizard-v4__form">
			
			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Hot water avialable.?</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<select class="form-control" id="hot_water" name="hot_water" required="">
							<option value="">Select Option</option>
							<option value="0">Not Available</option>
							<option value="1">Available</option>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Lift avialable.?</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<select class="form-control" id="lift_available" name="lift_available" required="">
							<option value="">Select Option</option>
							<option value="0">Not Available</option>
							<option value="1">Available</option>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">CCTV Security.?</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<select class="form-control" id="cctv" name="cctv" required="">
							<option value="">Select Option</option>
							<option value="0">Not Available</option>
							<option value="1">Available</option>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Jewellery locker available.?</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<select class="form-control" id="jewellery" name="jewellery" required="">
							<option value="">Select Option</option>
							<option value="0">Not Available</option>
							<option value="1">Available</option>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Generator Facility.?</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<select class="form-control" id="generator" name="generator" required="">
							<option value="">Select Option</option>
							<option value="0">Not Available</option>
							<option value="1">Available</option>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Security Guards</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Enter number of security guards" id="security_guards" name="security_guards" required="">
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Bike Parking Capacity</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Number Of Bike Parking Capacity" id="bike_parking" name="bike_parking" required="">
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Car Parking Capacity</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Number Of Car Parking Capacity" id="car_parking" name="car_parking" required="">
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Toilets</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Number Of Toilets" id="toilets" name="toilets" required="">
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label">Helpers</label>
				<div class="col-lg-9 col-xl-9">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Number Of helpers" id="total_helpers" name="total_helpers" required="">
					</div>
				</div>
			</div>







										</div>
									</div>
								</div>

								<!--end: Form Wizard Step 3-->

								<!--begin: Form Wizard Step 4-->
								{{-- <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
									<div class="kt-heading kt-heading--md">Review your Details and Submit</div>
									<div class="kt-form__section kt-form__section--first">
										<div class="kt-wizard-v4__review">
											<div class="kt-wizard-v4__review-item">
												<div class="kt-wizard-v4__review-title">
													Your Account Details
												</div>
												<div class="kt-wizard-v4__review-content">
													John Wick
													<br> Phone: +61412345678
													<br> Email: johnwick@reeves.com
												</div>
											</div>
											<div class="kt-wizard-v4__review-item">
												<div class="kt-wizard-v4__review-title">
													Your Address Details
												</div>
												<div class="kt-wizard-v4__review-content">
													Address Line 1
													<br> Address Line 2
													<br> Melbourne 3000, VIC, Australia
												</div>
											</div>
											<div class="kt-wizard-v4__review-item">
												<div class="kt-wizard-v4__review-title">
													Payment Details
												</div>
												<div class="kt-wizard-v4__review-content">
													Card Number: xxxx xxxx xxxx 1111
													<br> Card Name: John Wick
													<br> Card Expiry: 01/21
												</div>
											</div>
										</div>
									</div>
								</div> --}}

								<!--end: Form Wizard Step 4-->

								<!--begin: Form Actions -->
								<div class="kt-form__actions">
									<div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
										Previous
									</div>
									<div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" id="save_venue" data-ktwizard-type="action-submit">
										Submit
									</div>
									<div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
										Next Step
									</div>
								</div>
								<!--end: Form Actions -->
							</form>
							<!--end: Form Wizard Form-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end:: Content -->
</div>

<script src="{{ asset('assets/js/pages/custom/user/add-user.js')}}" type="text/javascript"></script>

<script>
	$(document).ready(function () {

	    // $(".kt-form").validate({
	    //     rules:
	    //     {
	    //     	venue_name:
	    //     	{
	    //     		required: true
	    //     	},
	    //     	venue_address:
	    //     	{
	    //     		required: true
	    //     	},
	    //         venue_district:
	    //         {
	    //             required: true
	    //         },
	    //         venue_type:
	    //         {
	    //         	required: true
	    //         },
	    //         owner_name:
	    //         {
	    //             required: true
	    //         },
	    //         owner_mobile_first:
	    //         {
	    //         	required: true,
	    //         	number: true,
	    //         	minlength: 10,
	    //         	maxlength: 10
	    //         },
	    //         owner_mobile_second:
	    //         {
	    //         	number: true,
	    //         	minlength: 10,
	    //         	maxlength: 10
	    //         },
	    //         about_venue:
	    //         {
	    //         	required: true
	    //         },
	    //         recetion_capacity:
	    //         {
	    //         	required: true,
	    //         	number: true
	    //         },
	    //         floating_capacity:
	    //         {
	    //         	required: true,
	    //         	number: true
	    //         },
	    //         dinning_capacity:
	    //         {
	    //         	required: true,
	    //         	number: true
	    //         },
	    //         number_of_rooms:
	    //         {
	    //         	required: true,
	    //         	number: true
	    //         },
	    //         ac_rooms:
	    //         {
	    //         	required: true,
	    //         	number: true
	    //         },

	    //         non_ac_rooms:
	    //         {
	    //         	required: true,
	    //         	number: true
	    //         },
	    //         total_area:
	    //         {
	    //         	required: true,
	    //         	number: true
	    //         },
	    //         no_of_chairs:
	    //         {
	    //         	required: true,
	    //         	number: true
	    //         },
	    //         lpg_gas:
	    //         {
	    //         	required: true
	    //         },
	    //         power_backup:
	    //         {
	    //         	required: true
	    //         },
	    //         kitchen_type:
	    //         {
	    //         	required: true
	    //         },
	    //         function_type:
	    //         {
	    //         	required: true
	    //         },

	    //         hot_water:
	    //         {
	    //         	required: true
	    //         },
	    //         lift_available:
	    //         {
	    //         	required: true
	    //         },
	    //         cctv:
	    //         {
	    //         	required: true
	    //         },
	    //         jewellery:
	    //         {
	    //         	required: true
	    //         },
	    //         generator:
	    //         {
	    //         	required: true
	    //         },
	    //         security_guards:
	    //         {
	    //         	required: true,
	    //         	number: true
	    //         },
	    //         bike_parking:
	    //         {
	    //         	required: true,
	    //         	number: true
	    //         },
	    //         car_parking:
	    //         {
	    //         	required: true,
	    //         	number: true
	    //         },
	    //         toilets:
	    //         {
	    //         	required: true,
	    //         	number: true
	    //         },
	    //         total_helpers:
	    //         {
	    //         	required: true,
	    //         	number: true
	    //         }
	    //     },
	    //     messages:
	    //     {
	    //        venue_name:
	    //     	{
	    //     		required: "Venue name is required"
	    //     	},
	    //     	venue_address:
	    //     	{
	    //     		required: "Address is required"
	    //     	},
	    //         venue_district:
	    //         {
	    //             required: "District is required"
	    //         },
	    //         venue_type:
	    //         {
	    //         	required: "Select venue type"
	    //         },
	    //         owner_name:
	    //         {
	    //             required: "Owner name required"
	    //         },
	    //         owner_mobile_first:
	    //         {
	    //         	required: "Owner mobile number is required",
	    //         	number: "Enter valid mobile number",
	    //         	minlength: "Mobile number should be 10 digits",
	    //         	maxlength: "Mobile number should be 10 digits"
	    //         },
	    //         owner_mobile_second:
	    //         {
	    //         	number: "Enter valid mobile number",
	    //         	minlength: "Mobile number should be 10 digits",
	    //         	maxlength: "Mobile number should be 10 digits"
	    //         },
	    //         about_venue:
	    //         {
	    //         	required: "Write Something about venue"
	    //         },
	    //         recetion_capacity:
	    //         {
	    //         	required: "Enter Recetion Capacity",
	    //         	number: "Enter numeric value only"
	    //         },
	    //         floating_capacity:
	    //         {
	    //         	required: "Enter Floating Capacity",
	    //         	number: "Enter numeric value only"
	    //         },
	    //         dinning_capacity:
	    //         {
	    //         	required: "Enter Dinning Capacity",
	    //         	number: "Enter numeric value only"
	    //         },
	    //         number_of_rooms:
	    //         {
	    //         	required: "Enter number of rooms",
	    //         	number: "Enter numeric value only"
	    //         },
	    //         ac_rooms:
	    //         {
	    //         	required: "Enter number of ac rooms",
	    //         	number: "Enter numeric value only"
	    //         },

	    //         non_ac_rooms:
	    //         {
	    //         	required: "Enter number of Non A/c rooms",
	    //         	number: "Enter numeric value only"
	    //         },
	    //         total_area:
	    //         {
	    //         	required: "Total area is required",
	    //         	number: "Enter numeric value only"
	    //         },
	    //         no_of_chairs:
	    //         {
	    //         	required: "Number of chairs is required",
	    //         	number: "Enter numeric value only"
	    //         },
	    //         lpg_gas:
	    //         {
	    //         	required: "Select an option"
	    //         },
	    //         power_backup:
	    //         {
	    //         	required: "Select an option"
	    //         },
	    //         kitchen_type:
	    //         {
	    //         	required: "Select an Option"
	    //         },
	    //         function_type:
	    //         {
	    //         	required: "Select venue is suitable for"
	    //         },
	    //         hot_water:
	    //         {
	    //         	required: "Select an option"
	    //         },
	    //         lift_available:
	    //         {
	    //         	required: "Select an option"
	    //         },
	    //         cctv:
	    //         {
	    //         	required: "Select an option"
	    //         },
	    //         jewellery:
	    //         {
	    //         	required: "Select an option"
	    //         },
	    //         generator:
	    //         {
	    //         	required: "Select an optioin"
	    //         },
	    //         security_guards:
	    //         {
	    //         	required: "Select an option",
	    //         	number: "Enter numeric value only"
	    //         },
	    //         bike_parking:
	    //         {
	    //         	required: "Bike parking is required",
	    //         	number: "Enter numeric value only"
	    //         },
	    //         car_parking:
	    //         {
	    //         	required: "Car parking is required",
	    //         	number: "Enter numeric value only"
	    //         },
	    //         toilets:
	    //         {
	    //         	required: "Enter number of toilets available in venue",
	    //         	number: "Enter numeric value only"
	    //         },
	    //         total_helpers:
	    //         {
	    //         	required: "Enter number of helpers available in venue",
	    //         	number: "Enter numeric value only"
	    //         }
	    //     },
	    //     highlight: function (element)
	    //     {
	    //         $(element).closest('.form-group').addClass('has-error');
	    //     },
	    //     unhighlight: function (element)
	    //     {
	    //         $(element).closest('.form-group').removeClass('has-error');
	    //     },
	    //     errorElement: 'div',
	    //     errorClass: 'invalid-feedback',
	    //     errorPlacement: function (error, element)
	    //     {
	    //         if (element.parent('.input-group').length) {
	    //             error.insertAfter(element.parent());
	    //         } else {
	    //             error.insertAfter(element);
	    //         }
	    //     }
	    // });
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

							toastr["success"]("Venue Added Successfully", "Success");
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