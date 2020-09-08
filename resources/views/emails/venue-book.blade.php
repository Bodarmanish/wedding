@component('mail::message')
# Hello {{ $user_data['customer_name'] }}

You Have Booked a Venue.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
