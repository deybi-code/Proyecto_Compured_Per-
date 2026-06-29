@extends('layouts.admin')

@section('title','Productos Pro')

@section('content')

<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">📦 Gestión de Productos</h1>
            <p class="text-gray-500">Admin enterprise panel</p>
        </div>

        <a href="{{ route('admin.productos.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
           + Nuevo Producto
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-xl shadow">

        <table class="w-full">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Imagen</th>
                    <th class="p-3 text-left">Nombre</th>
                    <th class="p-3 text-left">Precio</th>
                    <th class="p-3 text-left">Stock</th>
                    <th class="p-3 text-left">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($productos as $p)

                <tr class="border-b hover:bg-gray-50 transition">

                    <td class="p-3">
                        @if($p->imagen)
                            <img src="{{ asset('storage/'.$p->imagen) }}"
                                 class="w-14 h-14 object-cover rounded-lg">
                        @else
                            <div class="w-14 h-14 bg-gray-200 rounded-lg"></div>
                        @endif
                    </td>

                    <td class="p-3 font-semibold">{{ $p->nombre }}</td>

                    <td class="p-3">S/ {{ $p->precio }}</td>

                    <td class="p-3">
                        <span class="px-2 py-1 rounded bg-green-100 text-green-700">
                            {{ $p->stock }}
                        </span>
                    </td>

                    <td class="p-3 flex gap-2">

                        <a href="{{ route('admin.productos.edit',['producto'=>$p->id_producto]) }}"
                           class="px-3 py-1 bg-yellow-400 rounded text-white">
                           Editar
                        </a>

                        <form method="POST"
                              action="{{ route('admin.productos.destroy',['producto'=>$p->id_producto]) }}">
                            @csrf
                            @method('DELETE')

                            <button class="px-3 py-1 bg-red-500 text-white rounded">
                                Eliminar
                            </button>
                        </form>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection