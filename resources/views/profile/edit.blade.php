@extends('layouts.main')
@section('title', 'Editar Perfil – Compured Perú')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 style="font-family:'Rajdhani',sans-serif;font-size:1.6rem;font-weight:800;color:#172B4D;margin-bottom:24px" class="dark:text-white">Editar perfil</h1>
    @foreach(['update-profile-information-form','update-password-form','delete-user-form'] as $partial)
    <div class="cp-card" style="padding:28px;margin-bottom:16px">
        @include('profile.partials.'.$partial)
    </div>
    @endforeach
</div>
@endsection
