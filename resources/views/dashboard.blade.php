@extends('layouts.main')

@section('title', 'Panel de Usuario - Compured Perú')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col md:flex-row gap-8">

    <aside class="w-full md:w-1/4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <ul class="divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                <li><a href="/dashboard" class="block px-4 py-3 bg-gray-50 dark:bg-gray-700 font-semibold text-gray-800 dark:text-white border-l-4 border-blue-600">Dashboard</a></li>
                <li><a href="#" class="block px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Elementos comprados</a></li>
                <li><a href="#" class="block px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Deposito</a></li>
                <li><a href="#" class="block px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Transacciones</a></li>
                <li><a href="#" class="block px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Seguimiento de pedido</a></li>
                <li><a href="#" class="block px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Vendedores favoritos</a></li>
                <li><a href="#" class="block px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">mensajes</a></li>
                <li><a href="#" class="block px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Tickets</a></li>
                <li><a href="#" class="block px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">conversaciones</a></li>
                <li><a href="/dashboard/perfil" class="block px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Editar perfil</a></li>
                <li><a href="#" class="block px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Restablecer la contraseña</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Salir</button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <section class="w-full md:w-3/4 space-y-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Información de cuenta</h3>
                <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                    <p class="font-semibold text-gray-800 dark:text-white uppercase">{{ auth()->user()->nombre_completo ?? 'Deybi Gavidia Perez' }}</p>
                    <p>Correo: {{ auth()->user()->correo ?? 'deybipro2006@gmail.com' }}</p>
                    <p>Teléfono: 960900386</p>
                    <p>ciudad: trujillo</p>
                    <p>Postal codigo: 13002</p>
                    <p>direccion: dfsdf</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Mi billetera</h3>
                    <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                        <div>
                            <p>Bono de afiliado:</p>
                            <p class="font-bold text-gray-900 dark:text-white">S/0</p>
                        </div>
                        <div>
                            <p>Saldo de billetera:</p>
                            <p class="font-bold text-gray-900 dark:text-white">S/0</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex gap-2">
                    <button class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-blue-600 dark:text-blue-400 font-semibold py-1 px-4 rounded text-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition">+ AGREGAR</button>
                    <button class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-blue-600 dark:text-blue-400 font-semibold py-1 px-4 rounded text-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition uppercase">DEPÓSITO</button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 flex flex-col items-center justify-center text-center">
                <div class="w-24 h-24 rounded-full border-8 border-teal-400 flex items-center justify-center text-3xl font-bold text-gray-800 dark:text-white mb-4">
                    0
                </div>
                <h4 class="font-bold text-gray-800 dark:text-gray-100">Total pedidos</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400">Todo el tiempo</p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 flex flex-col items-center justify-center text-center">
                <div class="w-24 h-24 rounded-full border-8 border-yellow-400 flex items-center justify-center text-3xl font-bold text-gray-800 dark:text-white mb-4">
                    0
                </div>
                <h4 class="font-bold text-gray-800 dark:text-gray-100">pedidos pendientes</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400">Todo el tiempo</p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Pedidos recientes</h3>

            <div class="flex justify-between items-center mb-4 text-sm">
                <div class="text-gray-600 dark:text-gray-300">
                    mostrando <select class="border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-800 dark:text-white p-1 focus:ring-blue-500"><option>10</option></select> entrantes
                </div>
                <div class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                    Search: <input type="text" class="border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-800 dark:text-white p-1 focus:ring-blue-500 w-32">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-bold border-t border-b border-gray-200 dark:border-gray-600">
                            <th class="p-3">#Pedido</th>
                            <th class="p-3">Fecha</th>
                            <th class="p-3">Pedido Total</th>
                            <th class="p-3">Estado pedido</th>
                            <th class="p-3">Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="p-6 text-center text-sm text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-750">
                                No data available in table
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center mt-4 text-sm text-gray-600 dark:text-gray-300">
                <div>mostrando 0 de 0 a 0 entrantes</div>
                <div class="flex gap-1 border border-gray-300 dark:border-gray-600 rounded overflow-hidden">
                    <button class="px-3 py-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition" disabled>Previous</button>
                    <button class="px-3 py-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition" disabled>Next</button>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection
