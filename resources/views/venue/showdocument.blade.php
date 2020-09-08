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
						Show Photo & Video
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<div class="kt-portlet__head-actions">
							<a href="{{ route('admin.create.media',$new_id) }}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add Photo & Video
							</a>
						</div>
					</div>
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
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td style="width:auto">id</td>
                                                <td style="width:auto">Image</td>
                                                <td style="width:auto">Video link</td>
                                                <td style="width:auto">Date</td>
                                                <td style="width:auto">Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($media as $medias)
                                            <tr id="{{ $medias->id }}">
                                                <td>{{ $medias->id }}</td>
                                                <td>@if(isset($medias->image))<img src="{{ asset('venuemedia/'.$medias->image) }}" style=" width: 70px;height: 70px;" />@endif</td>
                                                <td>{{ $medias->video_link }}</td>
                                                <td>{{ $medias->created_at }}</td>
                                                <td>
                                                    <a href="{{ url('/editmedia/'.$medias->id.'/'.$new_id) }}" class="btn btn-brand" >Edit</a>
                                                    <a href="{{ url('/media/delete/'.$medias->id) }}" class="btn btn-danger btn-mini ">Delete</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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

{{-- 
<script>
    CKEDITOR.replace( 'terms_conditions' );
</script>        
--}}
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

 <script src="{{ asset('sweetalert/dist/sweetalert.min.js')}}" type="text/javascript"></script>



@stop
