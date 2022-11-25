@component('mail::message')
{{-- Hi : {{Auth::user()->name}} --}}

.Welcome to Mora Soft

{{-- @component('mail::button', ['url' => ''])
Click Your Post
@endcomponent --}}

Thanks<br>
{{-- {{Auth::user()->name}} --}}
@endcomponent