<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <div class="relative w-full h-56 bg-gradient-to-r from-blue-900 via-indigo-800 to-gray-900 overflow-hidden transition-colors duration-300">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-blue-500 rounded-full mix-blend-overlay filter blur-2xl animate-pulse"></div>
            <div class="absolute bottom-0 right-20 w-72 h-72 bg-indigo-500 rounded-full mix-blend-overlay filter blur-3xl"></div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-12 -mt-20 relative z-10">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <div class="lg:col-span-4 space-y-6">

                <div class="bg-white dark:bg-gray-800/95 backdrop-blur-md shadow-2xl rounded-3xl p-6 border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-blue-500/20">
                    <div class="flex justify-center -mt-16 mb-4">
                        <div class="h-28 w-28 rounded-full border-4 border-white dark:border-gray-800 bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center text-white text-5xl font-black shadow-xl transform transition hover:scale-105">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </div>

                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ auth()->user()->name }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">{{ auth()->user()->email }}</p>

                        <div class="mt-4 inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800/50 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            Cuenta Verificada
                        </div>
                    </div>

                    <div class="border-t border-gray-100 dark:border-gray-700 pt-4">
                        <div class="flex justify-between items-center py-2">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Nivel de Acceso</span>
                            <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">{{ auth()->user()->rol ?? 'Cliente' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Registrado el</span>
                            <span class="text-sm font-bold text-gray-700 dark:text-gray-300">{{ auth()->user()->created_at ? auth()->user()->created_at->format('d/m/Y') : 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl p-6 text-white shadow-2xl relative overflow-hidden border border-gray-700 group">
                    <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-blue-500/20 blur-2xl group-hover:bg-blue-500/30 transition-all"></div>

                    <h3 class="text-lg font-bold mb-5 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Mi Actividad
                    </h3>

                    <div class="space-y-5 relative z-10">
                        <div class="bg-gray-800/50 p-4 rounded-2xl border border-gray-600/50">
                            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Total Invertido</p>
                            <p class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">S/ 0.00</p>
                        </div>
                        <button class="w-full bg-white/10 hover:bg-white/20 border border-white/10 transition-all rounded-xl py-3 text-sm font-semibold backdrop-blur-sm flex justify-center items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Historial de Compras
                        </button>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-8 space-y-8">

                <div class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl p-6 sm:p-10 border border-gray-100 dark:border-gray-700 transition-colors duration-300">
                    <div class="max-w-2xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl p-6 sm:p-10 border border-gray-100 dark:border-gray-700 transition-colors duration-300">
                    <div class="max-w-2xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="bg-red-50 dark:bg-red-900/10 shadow-xl rounded-3xl p-6 sm:p-10 border-2 border-red-100 dark:border-red-900/20 transition-all duration-300 hover:border-red-400 dark:hover:border-red-600/50">
                    <div class="max-w-2xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
