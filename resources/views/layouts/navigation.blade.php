<nav x-data="{ open: false }" class="bg-white border-b shadow">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- LOGO -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="font-bold text-xl">
                    Compured Perú
                </a>
            </div>

            <!-- MENÚ ADMIN -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">

                @if(Auth::check() && Auth::user()->role === 'admin')

                    <a href="{{ route('admin.panel') }}">Panel Admin</a>

                    <a href="{{ route('admin.productos.index') }}">Productos</a>

                    <a href="{{ route('admin.ventas.index') }}">Ventas</a>

                    <a href="{{ route('admin.anuncios.index') }}">Anuncios</a>

                @endif

            </div>

            <!-- USUARIO -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <x-dropdown align="right">

                    <x-slot name="trigger">
                        <button>
                            {{ Auth::user()->name }}
                        </button>
                    </x-slot>

                    <x-slot name="content">

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

</nav>
