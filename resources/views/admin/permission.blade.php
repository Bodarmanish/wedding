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
				Permission
				<span class="kt-subheader-search__desc">
					Permission
				</span>
			</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			

			<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								{{ $role_dedtails->role_type }}'s Permission
							</h3>
						</div>
					</div>

					<form method="post" class="payment_borm kt-form edit__form" accept-charset="utf-8">
						@csrf
						<input type="hidden" name="role_id" id="role_id" value="{{ $role_id }}">
						<div class="row">
							<?php
							// echo "<pre>";
							// print_r($role_modules);
							$users_exist_permissions = array();
							foreach ($role_modules as $rm) {
								array_push($users_exist_permissions, $rm->id.'_'.$rm->action_name);
							}
							$old_mod_name = '';
							$i = 0;
							foreach ($all_modules as $mod) {
								if ($old_mod_name == '' || $old_mod_name != $mod->module_name) {
									if ($old_mod_name != '') {
										echo '</div>';
										$i++;
									}
									if ($i == 4) {
										$i = 0;
										echo '</div>';
										echo '<div class="row">';
									}
									echo '<div class="col-md-3" style="margin-left:10px; margin-top:10px;"><b><big><font color=red>' . strtoupper($mod->module_name) . '</font></big></b><br><br>';
								}
								$value = 0;
								$checked = '';
								if (in_array($mod->id.'_'.$mod->action_name, $users_exist_permissions)) {
									$value = 1;
									$checked = ' checked=""';
								}
								echo '<label class="switch">
								<input type="checkbox" id="mod_switch" module_master_id="' . $mod->id . '" ' . $checked . ' class="mod_switch" value="' . $value . '" style="margin-top:17px;">
								<span class="slider round"></span>
								</label>';
								echo '&nbsp' . $mod->action_name . '<br>';
								$old_mod_name = $mod->module_name;
							}
							?>
						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<div id="loading" style="display: none;">
									<p><img src="{{ asset('/images/loading.gif') }}" style="width: 25px;"> Please Wait...</p>
								</div>
								<button type="button" class="btn btn-primary" id="save">Submit</button>
								<a href="{{ route('admin.list.roles') }}" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
					</form>
					
				</div>
			</div>

		</div>
	</div>
</div>


<script>
	$(document).ready(function () {

		$(".mod_switch").click(function () {
			if ($(this).prop("checked")) {
				$(this).val("1");
			} else {
				$(this).val("0");
			}
		});

		$(document).on('click', '#save', function () {
			$('#loading').show();
			$('#save').attr('disabled', true);
			var role_id = $('#role_id').val();
			var i = 0;
			var module_master_id_arr = [];
			var status_arr = [];
			$('.mod_switch').each(function () {
				var module_master_id = $(this).attr('module_master_id');
				var status = $(this).val();
				module_master_id_arr.push(module_master_id);
				status_arr.push(status);
				i++;
			});
			// alert('status:'+status_arr+'|module:'+module_master_id_arr);
			// return;
			$.ajax({
				type: "POST",
				url: "{{ route('admin.permision.store') }}",
				data: {
					'_token': $('input[name="_token"]').val(),
					'role_id': role_id,
					'module_master_id_arr': module_master_id_arr,
					'status_arr': status_arr
				},
				success: function (data) {
					if (data.status === 'success') 
					{
						toastr.options.timeOut = 3000;
						toastr.options.fadeOut = 3000;
						toastr.options.progressBar = true;
						toastr.options.onHidden = function(){
							window.location.reload();
						};

						toastr["success"]("Role Permission Added Successfully", "Success");
					}
					else if (data.status === 'update') 
					{
						toastr.options.timeOut = 3000;
						toastr.options.fadeOut = 3000;
						toastr.options.progressBar = true;
						toastr.options.onHidden = function(){
							window.location.reload();
						};

						toastr["success"]("Role Permission Updated Successfully", "Success");
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
			$('#loading').hide();
			$('#save').removeAttr('disabled');
		});

	});
</script>



@stop
