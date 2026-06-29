<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 transition-colors duration-300">

    {{-- TOP BAR --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            {{-- LOGO --}}
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800 dark:text-white">
                    Compured Perú
                </a>
            </div>

            {{-- MENU DESKTOP --}}
            <div class="hidden sm:flex sm:items-center sm:space-x-6">

                {{-- ADMIN MENU --}}
                @if(Auth::check() && Auth::user()->role === 'admin')

                    <a href="{{ route('admin.productos.index') }}"
                       class="text-gray-700 dark:text-gray-200 hover:text-blue-600">
                        Productos
                    </a>

                    <a href="{{ route('admin.ventas.index') }}"
                       class="text-gray-700 dark:text-gray-200 hover:text-blue-600">
                        Ventas
                    </a>

                    <a href="{{ route('admin.anuncios.index') }}"
                       class="text-gray-700 dark:text-gray-200 hover:text-blue-600">
                        Anuncios
                    </a>

                @endif

            </div>

            {{-- USER DROPDOWN --}}
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <x-dropdown align="right" width="48">

                    {{-- TRIGGER --}}
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-blue-600">
                            {{ Auth::user()->name }}
                        </button>
                    </x-slot>

                    {{-- CONTENT --}}
                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Ver perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();"
                                             class="text-red-600">
                                Cerrar sesión
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            {{-- MOBILE BUTTON --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="text-gray-500">
                    ☰
                </button>
            </div>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">

        <div class="pt-4 pb-1 space-y-1 px-4">

            {{-- USER INFO --}}
            <div class="text-gray-800 dark:text-gray-200 font-medium">
                {{ Auth::user()->name }}
            </div>

            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ Auth::user()->email }}
            </div>

        </div>

        {{-- ADMIN MOBILE MENU --}}
        @if(Auth::check() && Auth::user()->role === 'admin')

            <div class="mt-3 space-y-1 px-4">

                <a href="{{ route('admin.productos.index') }}"
                   class="block text-gray-700 dark:text-gray-200">
                    Productos
                </a>

                <a href="{{ route('admin.ventas.index') }}"
                   class="block text-gray-700 dark:text-gray-200">
                    Ventas
                </a>

                <a href="{{ route('admin.anuncios.index') }}"
                   class="block text-gray-700 dark:text-gray-200">
                    Anuncios
                </a>

            </div>

        @endif

        {{-- PROFILE / LOGOUT --}}
        <div class="mt-3 space-y-1 px-4 pb-4">

            <a href="{{ route('profile.edit') }}"
               class="block text-gray-700 dark:text-gray-200">
                Ver perfil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="block text-red-600 w-full text-left">
                    Cerrar sesión
                </button>

            </form>

        </div>

    </div>

</nav>
