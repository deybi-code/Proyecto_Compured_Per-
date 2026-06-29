<nav class="cp-navbar">

    <div class="cp-navbar-inner flex justify-between items-center">

        {{-- 🔵 LOGO --}}
        <a href="{{ route('home') }}" class="cp-logo">
            Compured Perú
        </a>

        {{-- 🟡 LINKS CENTRALES (DESKTOP) --}}
        <div class="cp-nav-links">

            {{-- SOLO ADMIN --}}
            @if(Auth::check() && Auth::user()->rol === 'admin')

                {{-- 🔥 PANEL ADMIN (CORRECTO) --}}
                <a href="{{ route('admin.panel') }}" class="cp-btn-primary">
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

            @endif

        </div>

        {{-- 🟣 ACCIONES DERECHA --}}
        <div class="cp-nav-actions">

            {{-- THEME TOGGLE --}}
            <button type="button" class="cp-icon-btn" id="cp-theme-toggle" title="Cambiar tema">
                🌙
            </button>

            {{-- CARRITO --}}
            <a href="{{ route('carrito.index') }}" class="cp-icon-btn" title="Carrito">
                🛒
            </a>

            {{-- USER MENU --}}
            <div class="cp-user-menu" id="cp-user-menu">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="cp-icon-btn">
                            👤
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        {{-- PERFIL --}}
                        <x-dropdown-link :href="route('profile.edit')">
                            Ver perfil
                        </x-dropdown-link>

                        {{-- LOGOUT --}}
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

            {{-- MOBILE TOGGLE --}}
            <button type="button" class="cp-mobile-toggle" id="cp-mobile-toggle">
                ☰
            </button>

        </div>

    </div>

    {{-- 📱 MOBILE MENU --}}
    <div class="cp-mobile-menu" id="cp-mobile-menu">

        {{-- ADMIN MOBILE --}}
        @if(Auth::check() && Auth::user()->rol === 'admin')

            <a href="{{ route('admin.panel') }}">
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

        @endif

        {{-- USER --}}
        <a href="{{ route('profile.edit') }}">
            Mi perfil
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit">
                Cerrar sesión
            </button>

        </form>

    </div>

</nav>
