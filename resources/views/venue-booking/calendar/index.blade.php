@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

<style type="text/css">
	.invalid-feedback
	{
		/*color: red;*/
		font-size: 13px;
	}
	.fc-unthemed .fc-event .fc-title, .fc-unthemed .fc-event-dot .fc-title {
		color: white !important;
	}
</style>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader-search ">
		<div class="kt-container  kt-container--fluid ">
			<h3 class="kt-subheader-search__title">
				Booking Calendar
				<span class="kt-subheader-search__desc">
					Calendar View
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
								Booking Calendar
							</h3>
						</div>
					</div>
					
					<div class="kt-portlet__body">
						<!-- <div id="kt_calendar"></div>2 -->
						<div id='calendar'></div>
						{{--{!! $calendar->calendar() !!}--}}
					</div>
					

				</div>
			</div>

		</div>
	</div>
</div>

<script src="{{ asset('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<!--begin::Page Scripts(used by this page) -->
<!-- <script src="{{ asset('assets/js/pages/components/calendar/basic.js') }}" type="text/javascript"></script> -->

<script>
	$(document).ready(function () {

		 // page is now ready, initialize the calendar...
		 $('#calendar').fullCalendar({
            // put your options and callbacks here
            events : [
            @foreach($tasks as $task)
            {
            	title : '{{ $task->customer_name }} - {{ $task->venue_type_name }}',
            	start : '{{ $task->event_from_date }}',
            	end : '{{ date("Y-m-d", strtotime($task->event_to_date . ' +1 day')) }}',
            	backgroundColor: '#22B9FF',
            	color : '#444444',
            },
            @endforeach
            ]
        });

		});
	</script>



	@stop

