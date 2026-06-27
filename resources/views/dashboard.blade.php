@extends('layouts.main')

@section('title', 'Panel de Usuario - Compured Perú')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col md:flex-row gap-8">

    <aside class="w-full md:w-1/4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <ul class="divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                <li><a href="/dashboard" class="block px-4 py-3 bg-gray-50 dark:bg-gray-700 font-semibold text-gray-800 dark:text-white border-l-4 border-blue-600">Dashboard</a></li>
                <li><a href="#" class="block px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Elementos comprados</a></li>
                <li><a href="{{ route('perfil') }}" class="block px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Editar perfil</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            Salir
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <section class="w-full md:w-3/4 space-y-6">

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Información de cuenta</h3>
                <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                    {{-- CORREGIDO: se usa nombre_completo y correo (columnas reales de la tabla) --}}
                    <p class="font-semibold text-gray-800 dark:text-white uppercase">
                        {{ $user->nombre_completo ?? '---' }}
                    </p>
                    <p>Correo: {{ $user->correo ?? '---' }}</p>
                    <p>Rol: {{ ucfirst($user->rol ?? 'cliente') }}</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Mi billetera</h3>
                    <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                        <div>
                            <p>Saldo de billetera:</p>
                            <p class="font-bold text-gray-900 dark:text-white">S/0.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 flex flex-col items-center justify-center text-center">
                <div class="w-24 h-24 rounded-full border-8 border-teal-400 flex items-center justify-center text-3xl font-bold text-gray-800 dark:text-white mb-4">
                    {{-- CORREGIDO: conteo dinámico de pedidos --}}
                    {{ $pedidos->count() }}
                </div>
                <h4 class="font-bold text-gray-800 dark:text-gray-100">Total pedidos</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400">Todo el tiempo</p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 flex flex-col items-center justify-center text-center">
                <div class="w-24 h-24 rounded-full border-8 border-yellow-400 flex items-center justify-center text-3xl font-bold text-gray-800 dark:text-white mb-4">
                    {{-- CORREGIDO: conteo dinámico de pedidos pendientes --}}
                    {{ $pedidos->where('estado_pedido', 'Pendiente')->count() }}
                </div>
                <h4 class="font-bold text-gray-800 dark:text-gray-100">Pedidos pendientes</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400">Todo el tiempo</p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Pedidos recientes</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-bold border-t border-b border-gray-200 dark:border-gray-600">
                            <th class="p-3">#Boleta</th>
                            <th class="p-3">Fecha</th>
                            <th class="p-3">Total</th>
                            <th class="p-3">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- CORREGIDO: antes siempre mostraba "No data available", ahora itera $pedidos --}}
                        @forelse($pedidos as $pedido)
                        <tr class="border-b border-gray-100 dark:border-gray-700 text-sm text-gray-600 dark:text-gray-300">
                            <td class="p-3">{{ $pedido->id_boleta }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($pedido->fecha_venta)->format('d/m/Y') }}</td>
                            <td class="p-3 font-bold">S/ {{ number_format($pedido->total_pago, 2) }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-xs font-bold
                                    {{ $pedido->estado_pedido === 'Pagado' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $pedido->estado_pedido }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-6 text-center text-sm text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-750">
                                No tienes pedidos aún.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection
