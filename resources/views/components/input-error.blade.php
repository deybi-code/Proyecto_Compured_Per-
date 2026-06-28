@props(['messages'])
@if($messages)
<div {{ $attributes }}>
    @foreach((array) $messages as $message)
    <p style="color:#DC2626;font-size:0.78rem;margin-top:4px">{{ $message }}</p>
    @endforeach
</div>
@endif
