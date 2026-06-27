@extends('layouts.main')

@section('title', 'Proceso de Pago - Compured Perú')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6">
        <a href="/" class="hover:text-blue-600 dark:hover:text-blue-400">Home</a> &raquo;
        <span class="text-gray-700 dark:text-gray-200">Pagos</span>
    </nav>

    <div class="flex justify-center mb-10">
        <div class="flex items-center w-full max-w-3xl">
            <div class="flex-1 flex flex-col items-center">
                <div class="w-full flex items-center">
                    <div class="bg-blue-600 text-white font-bold h-10 w-full flex items-center justify-center rounded-l-md relative clip-path-step">
                        <span class="mr-2">1</span> Dirección
                        <div class="absolute right-0 top-0 h-full w-4 bg-blue-600 transform translate-x-2 rotate-45 origin-top-left z-10" style="clip-path: polygon(0 0, 100% 0, 0 100%);"></div>
                    </div>
                </div>
            </div>
            <div class="flex-1 flex flex-col items-center -ml-2 z-0">
                <div class="w-full flex items-center">
                    <div class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 font-bold h-10 w-full flex items-center justify-center relative">
                        <span class="mr-2">2</span> Pedidos
                    </div>
                </div>
            </div>
            <div class="flex-1 flex flex-col items-center -ml-2 z-0">
                <div class="w-full flex items-center">
                    <div class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 font-bold h-10 w-full flex items-center justify-center rounded-r-md">
                        <span class="mr-2">3</span> Pago
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <div class="w-full lg:w-2/3 space-y-8">

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <h3 class="font-bold text-gray-800 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">Información personal :</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" value="Deybi Gavidia Perez" class="w-full border-gray-300 dark:border-gray-600 rounded bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white p-2 focus:ring-blue-500 focus:border-blue-500" readonly>
                    <input type="email" value="deybipro2006@gmail.com" class="w-full border-gray-300 dark:border-gray-600 rounded bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white p-2 focus:ring-blue-500 focus:border-blue-500" readonly>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <h3 class="font-bold text-gray-800 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">Detalles de facturación</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <select class="w-full border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-800 dark:text-white p-2 focus:ring-blue-500">
                        <option>Recoger</option>
                        <option>Enviar a la dirección</option>
                    </select>
                    <select class="w-full border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-800 dark:text-white p-2 focus:ring-blue-500">
                        <option>DNI</option>
                        <option>RUC</option>
                    </select>
                    <input type="text" placeholder="Número documento" class="w-full border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-800 dark:text-white p-2 focus:ring-blue-500">
                    <input type="text" value="Deybi Gavidia Perez" class="w-full border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-800 dark:text-white p-2 focus:ring-blue-500">
                    <input type="text" value="960900386" class="w-full border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-800 dark:text-white p-2 focus:ring-blue-500">
                    <input type="text" value="dfsdf" class="w-full border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-800 dark:text-white p-2 focus:ring-blue-500">
                    <input type="text" value="Perú" class="w-full border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-800 dark:text-white p-2 focus:ring-blue-500">
                    <input type="text" value="trujillo" class="w-full border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-800 dark:text-white p-2 focus:ring-blue-500">
                    <input type="text" value="13002" class="w-full border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-800 dark:text-white p-2 focus:ring-blue-500">
                </div>

                <div class="mt-4 flex items-center">
                    <input type="checkbox" id="direccion_diferente" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <label for="direccion_diferente" class="ml-2 text-sm text-gray-600 dark:text-gray-300">¿Enviar a una dirección diferente?</label>
                </div>

                <div class="mt-4">
                    <input type="text" placeholder="Nota de pedido (Opcional)" class="w-full border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-800 dark:text-white p-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="mt-6">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded transition shadow">
                    CONTINUAR
                </button>
            </div>
        </div>

        <div class="w-full lg:w-1/3">
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700 shadow-md sticky top-24">
                <h3 class="text-sm font-bold text-gray-800 dark:text-gray-100 mb-4 uppercase tracking-wide">Detalles de Precio</h3>

                <div class="space-y-3 text-sm text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
                    <div class="flex justify-between">
                        <span>SubTotal</span>
                        <span class="font-bold text-gray-900 dark:text-white">S/ 1140</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Total</span>
                        <span class="font-bold text-gray-900 dark:text-white">S/ 1140</span>
                    </div>
                </div>

                <div class="mb-4">
                    <button class="text-blue-600 dark:text-blue-400 text-sm hover:underline font-semibold flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        ¿TIENE UN CÓDIGO DE PROMOCIÓN?
                    </button>
                    <div class="mt-2 flex gap-2">
                        <input type="text" placeholder="Código promocional" class="w-full border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 p-2 text-sm focus:ring-blue-500">
                        <button class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-200 px-4 py-2 rounded text-sm transition">SOLICITAR</button>
                    </div>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mb-4">
                    <h3 class="text-sm font-bold text-gray-800 dark:text-gray-100 mb-2 uppercase">MÉTODO DE ENVÍO</h3>
                    <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                        <input type="radio" name="envio" checked class="text-blue-600 focus:ring-blue-500 border-gray-300">
                        <span>Envío gratis <br><span class="text-xs text-gray-500 dark:text-gray-400">(4-7 días)</span></span>
                    </label>
                </div>

                <div class="flex justify-between text-lg font-bold text-gray-900 dark:text-white mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <span>Precio Total :</span>
                    <span>S/ 1140</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
