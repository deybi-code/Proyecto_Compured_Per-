<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            {{-- LOGO --}}
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800 dark:text-white">
                    Compured Perú
                </a>
            </div>

            {{-- ADMIN MENU (CORREGIDO) --}}
            @if(Auth::check() && Auth::user()->role === 'admin')

                <div class="hidden sm:flex sm:items-center sm:space-x-6">

                    <a href="{{ route('admin.panel') }}"
                       class="text-blue-600 font-semibold">
                        Panel Admin
                    </a>

                    <a href="{{ route('admin.productos.index') }}">
                        Productos
                    </a>

                    <a href="{{ route('admin.ventas.index') }}">
                        Ventas
                    </a>

                    <a href="{{ route('admin.anuncios.index') }}">
                        Anuncios
                    </a>

                </div>

            @endif

            {{-- USER MENU --}}
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="text-sm font-medium">
                            {{ Auth::user()->name }}
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        {{-- 🔥 IMPORTANTE: NO MÁS dashboard usuario --}}
                        <x-dropdown-link :href="route('profile.edit')">
                            Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                Cerrar sesión
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div class="sm:hidden px-4 py-2">

        @if(Auth::check() && Auth::user()->role === 'admin')

            <a href="{{ route('admin.panel') }}" class="block">
                Panel Admin
            </a>

            <a href="{{ route('admin.productos.index') }}" class="block">
                Productos
            </a>

            <a href="{{ route('admin.ventas.index') }}" class="block">
                Ventas
            </a>

            <a href="{{ route('admin.anuncios.index') }}" class="block">
                Anuncios
            </a>

        @endif

        <a href="{{ route('profile.edit') }}" class="block mt-2">
            Perfil
        </a>

    </div>

</nav>
