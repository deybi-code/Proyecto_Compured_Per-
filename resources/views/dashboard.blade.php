@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <aside class="sidebar">
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('pedidos') }}">Elementos comprados</a></li>
            <li><a href="#">Depósitos</a></li>
            <li><a href="#">Tickets</a></li>
            <li><a href="{{ route('perfil') }}">Editar perfil</a></li>
        </ul>
    </aside>

    <main class="content">
        <h1>Bienvenido, {{ Auth::user()->nombre_completo }}</h1>
        </main>
</div>
@endsection
