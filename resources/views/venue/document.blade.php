@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css" />


{{-- <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> --}}


  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Venues
				<span class="kt-subheader-search__desc">Venue Management</span>
			</h3>
		</div>
	</div>
	


	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">
			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="kt-font-brand flaticon2-line-chart"></i>
					</span>
					<h3 class="kt-portlet__head-title">
						Add Required Documents
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<div class="kt-portlet__head-actions">
							<a href="{{ route('admin.create.venue') }}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add Venue
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="kt-portlet">
				

				<form class="kt-form" action="" method="POST" enctype= 'multipart/form-data'>
					@csrf
					<div class="kt-portlet__body">
						<div class="kt-form__section kt-form__section--first">
							<div id="kt_repeater_1">
								<div class="form-group form-group-last row" id="kt_repeater_1">
									<label class="col-lg-2 col-form-label">Upload Documents:</label>
									<div data-repeater-list="" class="col-lg-10">


										<?php if(!empty($documents)){ ?>
										
										@foreach($documents as $data)
										<div data-repeater-item="" class="form-group row align-items-center clone_div">
											<input type="hidden" name="row_id[]" id="row_id" class="row_id" value="{{ $data->id }}">
											<div class="col-md-6">
												<div class="kt-form__group--inline">
													<div class="kt-form__control">
								
							<input type="text" class="form-control document_name" name="document_name[]" id="document_name" required="" value="{{ $data->document_name }}">
													</div>
												</div>
												<div class="d-md-none kt-margin-b-10"></div>
											</div>

											<div class="col-md-6">
												<div class="kt-form__group--inline">
													<div class="kt-form__control">
														

														<div class="custom-file">
								
								<img src="{{ asset('images/'.$data->document_file) }}" height="200" width="200" class="exist_image" id="exist_image">

								<input type="file" class="form-control document_file" id="document_file" name="document_file[]">
								

														
													</div>
													
													</div>
												</div>
											</div>
											
											
											<div class="col-md-4">
												<button type="button" class="btn btn-bold btn-sm btn-label-brand add_btn">
													<i class="la la-plus"></i> Add
												</button>
												<button type="button" value="{{ $data->id }}" class="btn-sm btn btn-label-danger btn-bold delete_btn">
													<i class="la la-trash-o"></i>
													Delete
												</button>
											</div>
										</div>
										@endforeach
										<?php }else{ ?>
										
										<div data-repeater-item="" class="form-group row align-items-center clone_div">
											<input type="hidden" name="row_id[]" id="row_id" class="row_id">
											<div class="col-md-6">
												<div class="kt-form__group--inline">
													<div class="kt-form__control">
							

							<input type="text" class="form-control document_name" name="document_name[]" id="document_name" required="">
							

													</div>
													
												</div>
												<div class="d-md-none kt-margin-b-10"></div>
											</div>

											<div class="col-md-6">
												<div class="kt-form__group--inline">
													<div class="kt-form__control">
														<div class="custom-file">
								

								<input type="file" class="form-control document_file" id="document_file" name="document_file[]">
								
													{{-- 	<label class="custom-file-label" for="customFile">Choose file</label> --}}
													</div>
													
													</div>
												</div>
											</div>


											
											
											<div class="col-md-4">
												<button type="button" class="btn btn-bold btn-sm btn-label-brand add_btn">
													<i class="la la-plus"></i> Add
												</button>
												<button type="button" value="" class="btn-sm btn btn-label-danger btn-bold delete_btn">
													<i class="la la-trash-o"></i>
													Delete
												</button>
											</div>
										</div>
										<?php } ?>
										<div class="new_div"></div>
									</div>
									
								</div>
								{{-- <div class="form-group form-group-last row">
									<label class="col-lg-2 col-form-label"></label>
									<div class="col-lg-4">
										
									</div>
								</div> --}}
							</div>
						</div>
					</div>
					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-lg-2"></div>
								<div class="col-lg-2">
									<button type="button" class="btn btn-success" id="save_tnc">Submit</button>
									
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
$exid = $new_id;
?>

{{-- 
<script>
    CKEDITOR.replace( 'terms_conditions' );
</script>        
--}}

 <script src="{{ asset('sweetalert/dist/sweetalert.min.js')}}" type="text/javascript"></script>

<script>
	
	$(document).ready(function () {

		$(document).on("click", ".add_btn", function (event) {
			
            var div = $(this).closest('.clone_div');
            var clone = div.clone();
            clone.find('.row_id').val('');
            clone.find('.document_name').val('');
            clone.find('.document_file').val('');
            clone.find('.delete_btn').val('');
            clone.find('.exist_image').remove();
            $('.new_div').append(clone);
            // CKEDITOR.replace( 'terms_conditions' );
        });

        $(document).on("click", ".delete_btn", function (event) {
        	var length = $('.clone_div').length;
    		if(length > 1)
    		{
	    		var id = $(this).val();
				var div = $(this).closest('.clone_div');
			
				if(id != '')
				{
					swal({
				        title: "Are you sure?",
				        text: "You will not be able recover this record",
				        type: "warning",
				        showCancelButton: true,
				        confirmButtonColor: "#DD6B55",
				        confirmButtonText: "Yes delete it!",
				        closeOnConfirm: false
			        },
			        function (isConfirm) {
			            $.ajax({
		                    type: "POST",
		                    url: '{{ route('admin.delete.policy') }}',
		                    data: {
		                        '_token': $('input[name="_token"]').val(),
		                        'tnc_id': id
		                    },
		                    cache: false,
		                    success: function (data)
		                    {
		                        swal("Deleted", "User has been deleted.", "success");
		                    }
		                });
			        });
				}
				div.remove();
			}
        });

		$("#save_tnc").on("click", function (e)
	    {
	        e.preventDefault();
	        if ($(".kt-form").valid())
	        {
	            $.ajax({
	                type: "POST",
	                url: "{{ route('admin.save.document', $exid) }}",
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
							
							toastr["success"]("User Updated Successfully", "Success");
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
