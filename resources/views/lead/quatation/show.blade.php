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
				Quatation
				<span class="kt-subheader-search__desc">
					View Quatation
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
								View Quatation
							</h3>
						</div>
					</div>
					

					<form class="kt-form edit__form" method="POST">
						@csrf
						<div class="kt-portlet__body">
							<div class="form-group">
								<label>Customer Name </label>
								<select class="form-control kt-select2 customer_name" disabled="disabled" id="customer_name" name="customer_name">
									<option value="">Select Customer</option>
									@foreach($customers as $customer)
									<?php
									$selected = '';
									if($customer->id == $edit->customer_id) {
										$selected = ' selected';
									}
									?>
									<option {{ $selected }} value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Quatation </label>
								

								<?php
								$extension = pathinfo($edit->quatation, PATHINFO_EXTENSION);
								if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
									?>
									<img src="{{ asset($edit->quatation) }}" style="width: 80px; height: 80px; margin-left: 10px; margin-top: 10px;">
								<?php } else if($extension == 'pdf') { ?>
									<img src="{{ asset('assets/media/icons/pdf-icon.png') }}" style="width: 80px; height: 80px; margin-left: 10px; margin-top: 10px;">
								<?php } else if($extension == 'doc' || $extension == 'docx') { ?>
									<img src="{{ asset('assets/media/icons/word-icon.png') }}" style="width: 80px; height: 80px; margin-left: 10px; margin-top: 10px;">
								<?php } else if($extension == 'csv' || $extension == 'xls' || $extension == 'xlsx') { ?>
									<img src="{{ asset('assets/media/icons/excel-icon.png') }}" style="width: 80px; height: 80px; margin-left: 10px; margin-top: 10px;">
								<?php } else if($extension == 'ppt' || $extension == 'pptx') { ?>
									<img src="{{ asset('assets/media/icons/powerpoint-icon.png') }}" style="width: 80px; height: 80px; margin-left: 10px; margin-top: 10px;">
								<?php } ?>

								<a href="{{ asset($edit->quatation) }}" id="download" name="download" class="btn btn-default" style="margin-left: 20px;" download><span class="la la-download"></span>  Download</a>

							</div>
							<div class="form-group">
								<label>Amount</label>
								<input type="number" name="amount" class="form-control" id="amount" placeholder="Enter Quatation Amount" disabled="disabled" value="{{ $edit->amount }}">
							</div>

						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-primary" id="update">Update</button>
								<a href="{{ route('admin.lead.quotation') }}" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
					</form>

				</div>
			</div>

		</div>
	</div>
</div>

<script src="{{ asset('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>


@stop
