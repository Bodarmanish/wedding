@component('mail::message')
# Hello {{ $user_data['customer_name'] }}

Welcome To Wedding Cluster. 

{{--@component('mail::button', ['url' => ''])
Button Text
@endcomponent--}}

Thanks,<br>
Wedding Cluster
@endcomponent
