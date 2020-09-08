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
						Add Complimetory Items
					</h3>
				</div>
			</div>
			<div class="kt-portlet">
				<div class="kt-portlet__body">
                    <!--Begin::Tab Content-->
                    <div class="tab-content">

                        <!--begin::tab 1 content-->
                        <div class="tab-pane active" id="kt_widget11_tab1_content">

                            <!--begin::Widget 11-->
                            <div class="kt-widget11">
                                    <!--begin::Form-->
                                    <form class="kt-form kt-form--label-right add__form" action="{{ route('admin.add.venueComItems',$new_id) }}" method="POST" id="res" enctype="multipart/form-data">
                                        @csrf
                                        <div class="kt-portlet__body">
                                            <div class="kt-section">
                                                <div class="kt-section__content">
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <label class="form-control-label">* Items Name :</label>
                                                            <input type="text" name="item_name[]" required class="form-control" placeholder="Enter Items Name" multiple>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
        												<button type="button" class="btn btn-bold btn-sm btn-label-brand add_btn">
        													<i class="la la-plus"></i> Add
        												</button>
        											</div>
                                                    <div class="new_div"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__foot">
                                            <div class="kt-form__actions">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-brand">Submit</button>
                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                            </div>
                            <!--end::Widget 11-->
                        </div>
                    </div>
                    <!--End::Tab Content-->
                </div>
			</div>
		</div>
	</div>
</div>

<?php 
$exid = $new_id;
?>


<script>
	
	$(document).ready(function () {
        
        $(document).ready(function() {
            var max = 5;
            var x = 1; 
            $('.add_btn').click(function(e){
                e.preventDefault();
                if(x < max){ 
                    x++; 
                    $('.new_div').append('<div><input type="text" name="item_name[]" required class="form-control col-lg-6" placeholder="Enter Items Name" ><button type="button" value="" class="btn-sm btn btn-label-danger btn-bold delete_btn"><i class="la la-trash-o"></i>Delete</button></div>'); //add input field
                }
            });  
            $('.new_div').on("click",".delete_btn", function(e){ 
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });

        //
        $(".add__form").validate({
			rules:
			{
				item_name:
				{
					required: true
				},
				
			},
			messages:
			{
				item_name:
				{
					required: "Enter Item Name"
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
        //

	});

</script>   
<script src="{{ asset('sweetalert/dist/sweetalert.min.js')}}" type="text/javascript"></script>

@stop
