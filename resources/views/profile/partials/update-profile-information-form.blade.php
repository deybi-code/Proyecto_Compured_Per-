<section>
    <header>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white border-l-4 border-blue-500 pl-2 transition-colors">
            {{ __('Información del Perfil') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 transition-colors">
            {{ __("Actualiza el nombre y correo de tu cuenta.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            {{-- CORREGIDO: campo 'nombre_completo' (columna real), antes era 'name' que no existe en la BD --}}
            <x-input-label for="nombre_completo" :value="__('Nombre Completo')" />
            <x-text-input id="nombre_completo" name="nombre_completo" type="text"
                class="mt-1 block w-full"
                :value="old('nombre_completo', $user->nombre_completo)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('nombre_completo')" />
        </div>

        <div>
            {{-- CORREGIDO: campo 'correo' (columna real), antes era 'email' que no existe en la BD --}}
            <x-input-label for="correo" :value="__('Correo Electrónico')" />
            <x-text-input id="correo" name="correo" type="email"
                class="mt-1 block w-full"
                :value="old('correo', $user->correo)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('correo')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar Cambios') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Guardado correctamente.') }}</p>
            @endif
        </div>
    </form>
</section>
