@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    @if(session('success'))
        <div class="bg-green-600 text-white p-4 rounded mb-6 font-bold shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-600 text-white p-4 rounded mb-6 font-bold shadow-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 p-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Punto de Venta (POS)</h1>

        <form action="{{ route('ventas.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Seleccionar Producto</label>
                        <select name="id_producto" class="w-full p-4 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none" required>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id_producto }}">
                                    {{ $producto->nombre }} - Stock: {{ $producto->stock }} | S/ {{ $producto->precio }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Cantidad</label>
                        <input type="number" name="cantidad" value="1" min="1" class="w-full p-4 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nombre del Cliente</label>
                        <input type="text" name="nombre_cliente" class="w-full p-4 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded text-gray-900 dark:text-white" required placeholder="Ej: Juan Perez">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">DNI / RUC</label>
                        <input type="text" name="dni_cliente" class="w-full p-4 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded text-gray-900 dark:text-white" required placeholder="Ej: 71234567">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Método de Pago</label>
                        <select name="metodo_pago" class="w-full p-4 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded text-gray-900 dark:text-white">
                            <option value="efectivo">Pago en Efectivo</option>
                            <option value="tarjeta">Pago con Tarjeta</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex justify-end">
                <button type="submit" class="w-full md:w-auto bg-green-600 hover:bg-green-700 text-white font-black py-4 px-12 rounded-lg transition-all duration-300 shadow-lg transform hover:scale-105">
                    PROCESAR VENTA
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
