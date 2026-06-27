<nav class="bg-white dark:bg-slate-900 border-b border-gray-200 dark:border-slate-800 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <div class="flex-shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="Compured" class="h-10">
            </div>

            <div class="flex-1 mx-8">
                <input type="text" placeholder="Buscar producto..."
                    class="w-full bg-gray-100 dark:bg-slate-800 border-none rounded-lg py-2 px-4 focus:ring-2 focus:ring-blue-500 text-gray-900 dark:text-white">
            </div>

            <div class="flex items-center space-x-4">
                <button id="theme-toggle" class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-slate-700">
                    <span class="dark:hidden">🌙</span>
                    <span class="hidden dark:inline">☀️</span>
                </button>
                <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-200 font-medium">Entrar</a>
            </div>
        </div>
    </div>
</nav>
