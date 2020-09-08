@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css" />

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
						Venue Complimetory Items
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<div class="kt-portlet__head-actions">
							<a href="{{ route('admin.add.venueComItems',$new_id) }}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add Complimetory Items
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
					@csrf
					<thead>
						<tr>
							<th>Item Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($comitems as $items)
						<tr id="{{ $items->id }}">
							<td>{{ ($items->item_name) }}</td>
							<td>
								<a href="{{ url('admin/edit/comitems'.'/'.$items->id.'/'.$new_id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
									<i class="la la-edit"></i>
								</a>
								<button type="button" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" id="delete_comitems">
									<i class="la la-trash"></i>
								</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/data-sources/html.js') }}" type="text/javascript"></script>
<script src="{{ asset('sweetalert/dist/sweetalert.min.js')}}" type="text/javascript"></script>

<script>

	$(document).ready(function(){

		$(document).on('click', '#delete_comitems', function ()
		{
			var obj = $(this);
			var id = $(this).parents("tr").attr("id");

			swal({
				title: "Are you sure?",
				text: "You will not be able recover this record",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes delete it!",
				closeOnConfirm: false
			},
			function () {
				$.ajax({
                url: '/admin/comitemsdelete/'+id,
                type: 'get',
                success: function(res) {
                    if (res == 'true') {
						obj.closest('tr').remove();
                        swal("Deleted!", "Your record has been deleted.", "success");
                        // location.reload();
                    }
                },
                error: function() {
                    alert('Something is wrong');
                },
				});
			});
		});
	});

</script>
<script>
	@if(session()->has("add"))
		toastr.success("{{ Session::get('add') }}");
	@endif
	@if(session()->has("edit"))
		toastr.success("{{ Session::get('edit') }}");
	@endif
	@if(session()->has("delete"))
		toastr.error("{{ Session::get('delete') }}");
	@endif
</script>

@stop
