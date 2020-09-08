@extends('BSM.main')
@section('content')

{{-- CONTENT STARTS --}}



<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Dashboard
				<span class="kt-subheader-search__desc">BSM Dashboard</span>
			</h3>
		</div>
	</div>


	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="row">
			<div class="col-xl-6">
				
				


				<div class="kt-portlet kt-portlet--height-fluid">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								All CSM 
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body kt-portlet__body--fluid">
						<div class="kt-widget12">
							<div class="kt-widget12__content">
								<div class="kt-widget12__item">
									<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
										@csrf
										<thead>
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>Mobile</th>
												<th>Email</th>
												<th>Date</th>
												{{-- <th>Action</th> --}}
											</tr>
										</thead>
										<tbody>
											@foreach($bsm as $bsms)
											<tr id="{{ $bsms->id }}">
												<td>{{ $bsms->id }}</td>
												<td>{{ ($bsms->csm_name) }}</td>
												<td>{{ ($bsms->mobile) }}</td>
												<td>{{ ($bsms->email) }}</td>
												<td>{{ ($bsms->updated_at) }}</td>
												{{-- <td>
													<a href="{{ url('admin/edit/Costbsms') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
														<i class="la la-edit"></i>
													</a>
													<button type="button" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-id="{{ url('admin.CostItemsdelete') }}" title="Delete" id="delete_costitems">
														<i class="la la-trash"></i>
													</button>
												</td> --}}
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>




			</div>
		</div>
	</div>
</div>
@stop