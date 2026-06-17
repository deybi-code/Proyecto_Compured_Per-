<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <div class="relative w-full h-56 bg-[#0c2354] dark:bg-gray-900 overflow-hidden transition-colors duration-300">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-blue-400 rounded-full mix-blend-overlay filter blur-2xl"></div>
            <div class="absolute bottom-0 right-20 w-72 h-72 bg-blue-600 rounded-full mix-blend-overlay filter blur-3xl"></div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-12 -mt-20 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-lg p-6 border-t-4 border-[#0c2354] dark:border-blue-500 transition-all duration-300">
                    <div class="flex justify-center -mt-16 mb-4">
                        <div class="h-28 w-28 rounded-full border-4 border-white dark:border-gray-800 bg-[#0c2354] dark:bg-blue-600 flex items-center justify-center text-white text-5xl font-black shadow-lg">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </div>

                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-extrabold text-[#0c2354] dark:text-white">{{ auth()->user()->name }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">{{ auth()->user()->email }}</p>

                        <div class="mt-4 inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            Cuenta Verificada
                        </div>
                    </div>

                    <div class="border-t border-gray-100 dark:border-gray-700 pt-4 space-y-3">
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Nivel de Acceso</span>
                            <span class="text-sm font-bold text-[#0c2354] dark:text-blue-400 uppercase">{{ auth()->user()->rol ?? 'Cliente' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Registrado el</span>
                            <span class="text-sm font-bold text-gray-700 dark:text-gray-300">{{ auth()->user()->created_at ? auth()->user()->created_at->format('d/m/Y') : 'N/A' }}</span>
                        </div>

                        <div class="pt-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex justify-center items-center gap-2 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white dark:bg-red-900/20 dark:hover:bg-red-600 border border-red-200 dark:border-red-800 py-2 rounded transition-colors font-bold text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="bg-[#0c2354] dark:bg-gray-800 rounded-lg p-6 text-white shadow-xl relative overflow-hidden border-b-4 border-blue-400">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Mi Actividad
                    </h3>
                    <div class="bg-black/20 p-4 rounded border border-white/10 mb-4">
                        <p class="text-blue-200 text-xs uppercase tracking-wider mb-1">Total Invertido</p>
                        <p class="text-3xl font-black text-white">S/ 0.00</p>
                    </div>
                    <button class="w-full bg-white/10 hover:bg-white/20 border border-white/20 transition-all rounded py-2 text-sm font-bold flex justify-center items-center gap-2">
                        Historial de Compras
                    </button>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-6">
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 sm:p-8 border-t-4 border-[#0c2354] dark:border-gray-700 transition-colors">
                    <div class="max-w-2xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 sm:p-8 border-t-4 border-[#0c2354] dark:border-gray-700 transition-colors">
                    <div class="max-w-2xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 sm:p-8 border-t-4 border-red-500 transition-colors">
                    <div class="max-w-2xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
