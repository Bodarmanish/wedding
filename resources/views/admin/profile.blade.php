@extends('main')
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
				Users
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
				<input type="hidden" name="user_id" value="{{ $users->id }}">
				<div class="kt-portlet__body">

					<div class="form-group">
						<label>Full Name</label>
						<input type="text" class="form-control" placeholder="Enter Name" id="full_name" name="full_name" value="{{ $users->name }}">
					</div>


					<div class="form-group">
						<label for="exampleSelect1">Your Role</label>
						<select class="form-control" id="exampleSelect1" id="role" name="role" disabled="">
							<option value="">Select Role</option>
							<?php 
							foreach($all_roles as $role)
							{
								$selected = '';
								if($role->id == $users->role_id)
								{
									$selected = "selected='selected'";
								}
								?>
								<option value="<?php echo $role->id; ?>" <?php echo $selected;?>>{{ $role->role_type }}</option>
							<?php } ?>
							
						</select>
					</div>

					<div class="form-group">
						<label>Email address</label>
						<input type="email" class="form-control" placeholder="Enter email" id="email" name="email" value="{{ $users->email }}">
					</div>


					<div class="form-group">
						<label>Mobile Number</label>
						<input type="text" class="form-control" placeholder="Enter Mobile" id="mobile" name="mobile" value="{{ $users->mobile }}">
					</div>
					
					{{-- 
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ md5($users->password) }}">
					</div>

					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password" class="form-control" id="cnf_password" name="cnf_password" placeholder="Password" value="{{ md5($users->password) }}">
					</div> 
					--}}
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" class="btn btn-primary" id="save_user">Update</button>
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
	        	full_name:
	        	{
	        		required: true
	        	},
	        	role:
	        	{
	        		required: true
	        	},
	            email:
	            {
	                required: true
	            },
	            mobile:
	            {
	            	required: true,
	            	number: true,
	            	minlength: 10,
	            	maxlength: 10
	            },
	            password:
	            {
	                required: true
	            },
	            cnf_password:
	            {
	            	required: true,
	            	equalTo: "#password"
	            }
	        },
	        messages:
	        {
	           full_name:
	        	{
	        		required: "Enter Full Name"
	        	},
	        	role:
	        	{
	        		required: "Select Role"
	        	},
	            email:
	            {
	                required: "Enter Email"
	            },
	            mobile:
	            {
	            	required: "Enter Mobile Number",
	            	number: "Enter valid mobile number",
	            	minlength: "Enter valid mobile number",
	            	maxlength: "Enter valid mobile number"
	            },
	            password:
	            {
	                required: "Enter Paswword"
	            },
	            cnf_password:
	            {
	            	required: "Enter Confirm Password",
	            	equalTo: "Paswword Does not match"
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
	        e.preventDefault();
	        if ($(".kt-form").valid())
	        {
	            $.ajax({
	                type: "POST",
	                url: "{{ route('admin.update.prifle') }}",
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
