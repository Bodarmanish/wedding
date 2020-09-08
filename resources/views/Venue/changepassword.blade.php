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
				<span class="kt-subheader-search__desc">Chage Password</span>
			</h3>
		</div>
	</div>


	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Change Password
					</h3>
				</div>
			</div>
			<form class="kt-form" method="POST" action="">
				@csrf
				<div class="kt-portlet__body">

					<div class="form-group">
						<label>Old Password</label>
						<input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password" value="">
					</div>
					 
					<div class="form-group">
						<label>New Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
					</div>

					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password" class="form-control" id="cnf_password" name="cnf_password" placeholder="Confirm Password" value="">
					</div> 
					
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" class="btn btn-primary" data-id="{{ route('venue.change.password',$venue->id) }}" id="update_pwd">Update</button>
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
	        	old_password:
	        	{
	        		required: true
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
	           old_password:
	        	{
	        		required: "Enter Old Password"
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
		$("#update_pwd").on("click", function (e)
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
	                    	toastr.options.timeOut = 2000;
							toastr.options.fadeOut = 2000;
							toastr.options.progressBar = true;
							toastr.options.onHidden = function()
							{
								window.location.reload();
							};
							
							toastr["success"]("Password Updated Successfully", "Success");
						}
                        else if(data.status === 'error') 
	                    {
	                        toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;

                            toastr["error"]("Opps.. Something Went Wrong", "Error");
	                    }
	                    else if(data.status === 'exist') 
	                    {
	                        toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;

                            toastr["warning"]("Old password does not match", "Warning");
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
