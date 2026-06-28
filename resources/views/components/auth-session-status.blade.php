@props(['status'])
@if($status)
<div class="alert-success">{{ $status }}</div>
@endif
