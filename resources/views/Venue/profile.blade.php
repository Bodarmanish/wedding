@extends('Venue.main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<style type="text/css">
	.help-block
	{
		color: red;
	}
</style>


<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Venue
				<span class="kt-subheader-search__desc">Update Profile</span>
			</h3>
		</div>
	</div>


	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Edit Profile
					</h3>
				</div>
			</div>
			<form class="kt-form" method="POST" action="">
				@csrf
				<input type="hidden" name="user_id" value="{{ $venue->id }}">
				<div class="kt-portlet__body">

					<div class="form-group">
						<label>Full Name</label>
						<input type="text" class="form-control" placeholder="Enter Name" id="venue_name" name="venue_name" value="{{ $venue->venue_name }}">
					</div>

					<div class="form-group">
						<label>Mobile Number</label>
						<input type="text" class="form-control" placeholder="Enter Mobile" id="venue_mobile" name="venue_mobile" value="{{ $venue->venue_mobile }}">
					</div>

					<div class="form-group">
						<label>Address</label>
						<input type="text" class="form-control" placeholder="Enter Address" id="venue_address" name="venue_address" value="{{ $venue->venue_address }}">
					</div>

					<div class="form-group">
						<label>District</label>
						<input type="text" class="form-control" placeholder="Enter District" id="venue_district" name="venue_district" value="{{ $venue->venue_district }}">
					</div>

					<div class="form-group">
						<label>Owner Name</label>
						<input type="text" class="form-control" placeholder="Enter Owner Name" id="owner_name" name="owner_name" value="{{ $venue->owner_name }}">
					</div>

					<div class="form-group">
						<label>Owner Email</label>
						<input type="text" class="form-control" placeholder="Enter Owner Email" id="venue_district" name="owner_email" value="{{ $venue->owner_email }}">
					</div>

					<div class="form-group">
						<label>Owner Mobile</label>
						<input type="text" class="form-control" placeholder="Enter Owner Mobile" id="owner_mobile" name="owner_mobile" value="{{ $venue->owner_mobile_1 }}">
					</div>

				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" class="btn btn-primary" data-id="{{ route('venue.edit.prifle',$venue->id) }}" id="save_user">Update</button>
						{{-- <button type="reset" class="btn btn-secondary">Cancel</button> --}}
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
	        	venue_mobile:
	            {
	            	required: true,
	            	number: true,
	            	minlength: 10,
	            	maxlength: 10
				},
				venue_address:
	        	{
	        		required: true
				},
				venue_district:
	        	{
	        		required: true
				},
				owner_name:
	        	{
	        		required: true
				},
				owner_email:
	        	{
	        		required: true
				},
				owner_mobile:
	        	{
	        		required: true
	        	},
	            
	        },
	        messages:
	        {
	           	venue_name:
	        	{
	        		required: "Enter Name"
	        	},
	            venue_mobile:
	            {
	            	required: "Enter Mobile Number",
	            	number: "Enter valid mobile number",
	            	minlength: "Enter valid mobile number",
	            	maxlength: "Enter valid mobile number"
				},
				venue_address:
	        	{
	        		required: "Enter Venue Address"
				},
				venue_district:
	        	{
	        		required: "Enter Venue District"
				},
				owner_name:
	        	{
	        		required: "Enter Venue Owner Name"
				},
				owner_email:
	        	{
	        		required: "Enter Venue Owner Email"
				},
				owner_mobile:
	        	{
	        		required: "Enter Venue Owner Mobile"
	        	},
	            
	        },
	        highlight: function (element)
	        {
	            $(element).closest('.form-group').addClass('has-error');
	        },
	        unhighlight: function (element)
	        {
	            $(element).closest('.form-group').removeClass('has-error');
	        },
	        errorElement: 'span',
	        errorClass: 'help-block',
	        errorPlacement: function (error, element)
	        {
	            if (element.parent('.input-group').length) {
	                error.insertAfter(element.parent());
	            } else {
	                error.insertAfter(element);
	            }
	        }
	    });
		$("#save_user").on("click", function (e)
	    {   			
            var url = $(this).data("id");

	        e.preventDefault();
	        if ($(".kt-form").valid())
	        {
	            $.ajax({
	                type: "POST",
	                url: url,
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
							toastr.options.onHidden = function()
							{
								window.location.reload();
							};
							
							toastr["success"]("Profile Updated Successfully", "Success");
						}
                        else if(data.status === 'error') 
	                    {
	                        toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;

                            toastr["error"]("Opps.. Something Went Wrong", "Error");
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
