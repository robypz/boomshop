<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="{{asset('images/LOGO COMPLETO TRANSP.png')}}" class="logo" alt="BOOMSHOP Logo">
<br>
{{ $slot }}
@endif
</a>
</td>
</tr>
