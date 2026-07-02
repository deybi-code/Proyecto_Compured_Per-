@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-slate-900 transition-colors duration-300 py-10 px-4">

    {{-- Hero Section Profesional --}}
    <div class="relative max-w-5xl mx-auto bg-blue-700 dark:bg-blue-950 rounded-3xl shadow-2xl p-8 md:p-12 text-center mb-10 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>

        <div class="relative z-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-4">
                Resultados para: <span class="text-blue-200">"{{ $q }}"</span>
            </h1>
            <p class="text-blue-100 font-medium mb-8">
                {{ $productos->count() }} productos encontrados en nuestra tienda
            </p>

            {{-- Buscador Corregido (Encuadrado y proporcional) --}}
            <form method="GET" action="{{ route('buscar') }}" class="relative max-w-lg mx-auto">
                <input type="text" name="q" value="{{ $q }}"
                    class="w-full pl-12 pr-4 py-4 rounded-full bg-white/10 border border-white/20 text-white placeholder-blue-200 focus:outline-none focus:ring-4 focus:ring-blue-400/30 backdrop-blur-md transition-all text-lg"
                    placeholder="Buscar otro producto...">
                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-blue-200 text-xl">🔎</span>
            </form>
        </div>
    </div>

    {{-- Filtros y Ordenamiento --}}
    <div class="max-w-7xl mx-auto mb-8">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 p-6">
            <form method="GET" action="{{ route('buscar') }}">
                <input type="hidden" name="q" value="{{ $q }}">
                <div class="flex flex-wrap gap-4 items-center justify-between">
                    {{-- Ordenamiento por Precio --}}
                    <div class="flex items-center gap-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Ordenar por:</span>
                        <select name="orden" onchange="this.form.submit()" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="relevancia" {{ $orden === 'relevancia' ? 'selected' : '' }}>Relevancia</option>
                            <option value="precio_asc" {{ $orden === 'precio_asc' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
                            <option value="precio_desc" {{ $orden === 'precio_desc' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
                        </select>
                    </div>

                    {{-- Filtro de Stock --}}
                    <div class="flex items-center gap-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Stock:</span>
                        <select name="stock" onchange="this.form.submit()" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" {{ $stock === '' ? 'selected' : '' }}>Todos</option>
                            <option value="con_stock" {{ $stock === 'con_stock' ? 'selected' : '' }}>Con Stock</option>
                            <option value="sin_stock" {{ $stock === 'sin_stock' ? 'selected' : '' }}>Sin Stock</option>
                        </select>
                    </div>

                    {{-- Filtro de Marca --}}
                    <div class="flex items-center gap-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Marca:</span>
                        <select name="marca" onchange="this.form.submit()" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Todas</option>
                            @foreach($marcas as $m)
                            <option value="{{ $m }}" {{ $marca === $m ? 'selected' : '' }}>{{ $m }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Limpiar Filtros --}}
                    <a href="{{ route('buscar', ['q' => $q]) }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">
                        Limpiar filtros
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Grid de Productos Profesional --}}
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($productos ?? [] as $p)
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 p-5 hover:shadow-xl transition-all duration-300">
            <div class="h-40 flex items-center justify-center bg-gray-50 dark:bg-slate-900 rounded-xl mb-4 overflow-hidden">
                <img src="{{ asset('img/producto.webp') }}" class="h-32 object-contain" alt="{{ $p->nombre }}">
            </div>

            <h3 class="font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 h-12">{{ $p->nombre }}</h3>
            <p class="text-xl font-black text-blue-600 dark:text-blue-400 mb-5">S/ {{ number_format($p->precio, 2) }}</p>

            <div class="flex gap-2">
                <form action="{{ route('carrito.store') }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="id_producto" value="{{ $p->id_producto }}">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-lg font-bold transition">Carrito</button>
                </form>
                <a href="/producto/{{ $p->id_producto }}" class="flex-1 border border-blue-600 text-blue-600 dark:text-blue-400 py-2.5 rounded-lg font-bold text-center hover:bg-blue-50 dark:hover:bg-slate-700 transition">Ver</a>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <div class="text-6xl mb-4">🛒</div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">No encontramos resultados</h2>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Prueba con otra palabra clave.</p>
            <a href="/" class="bg-blue-600 text-white px-8 py-3 rounded-full font-bold">Volver a la tienda</a>
        </div>
        @endforelse
    </div>
</div>
@endsection
