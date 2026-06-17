
<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <div class="relative w-full h-56 bg-white dark:bg-gray-900 overflow-hidden border-b-4 border-[#27a1eb] transition-colors duration-300">
        <div class="absolute inset-0 opacity-20 dark:opacity-30">
            <div class="absolute -top-20 -left-10 w-72 h-72 bg-[#a4e613] rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 right-10 w-96 h-96 bg-[#27a1eb] rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-3xl"></div>
            <div class="absolute top-10 right-1/2 w-64 h-64 bg-[#0b33a2] rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-3xl"></div>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-10 pointer-events-none">
            <img src="{{ asset('img/logo.png') }}" class="w-96 grayscale" alt="Background Logo">
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-12 -mt-20 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6 border-t-4 border-[#0b33a2] dark:border-[#27a1eb] transition-all duration-300">
                    <div class="flex justify-center -mt-16 mb-4">
                        <div class="h-28 w-28 rounded-full border-4 border-white dark:border-gray-800 bg-[#0b33a2] flex items-center justify-center text-white text-5xl font-black shadow-lg">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </div>

                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-extrabold text-[#0b33a2] dark:text-white">{{ auth()->user()->name }}</h2>
                        <p class="text-sm text-[#27a1eb] font-bold">{{ auth()->user()->email }}</p>

                        <div class="mt-4 inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-bold bg-[#a4e613]/20 text-[#4c6b09] dark:bg-[#a4e613]/10 dark:text-[#a4e613]">
                            <span class="w-2 h-2 rounded-full bg-[#a4e613] animate-pulse"></span>
                            Cuenta Verificada
                        </div>
                    </div>

                    <div class="border-t border-gray-100 dark:border-gray-700 pt-4 space-y-3">
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Nivel de Acceso</span>
                            <span class="text-sm font-bold text-[#27a1eb] uppercase">{{ auth()->user()->rol ?? 'Cliente' }}</span>
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

                <div class="bg-gradient-to-br from-[#0b33a2] to-[#08206b] rounded-lg p-6 text-white shadow-xl relative overflow-hidden border-b-4 border-[#a4e613]">
                    <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-[#27a1eb]/30 blur-2xl"></div>

                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-[#a4e613]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Mi Actividad
                    </h3>
                    <div class="bg-black/20 p-4 rounded border border-white/10 mb-4 relative z-10">
                        <p class="text-[#27a1eb] text-xs uppercase tracking-wider mb-1 font-bold">Total Invertido</p>
                        <p class="text-3xl font-black text-white">S/ 0.00</p>
                    </div>
                    <button class="w-full bg-white/10 hover:bg-[#27a1eb] border border-white/20 transition-all rounded py-2 text-sm font-bold flex justify-center items-center gap-2 relative z-10">
                        Historial de Compras
                    </button>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-6">
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 sm:p-8 border-t-4 border-[#0b33a2] dark:border-[#27a1eb] transition-colors">
                    <div class="max-w-2xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 sm:p-8 border-t-4 border-[#27a1eb] transition-colors">
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
