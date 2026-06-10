<x-guest-layout>
    <style>
        /* Diseño Premium */
        :root { --primary: #0056b3; --secondary: #8cc63f; }
        body { font-family: 'Inter', system-ui, sans-serif; background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%); transition: 0.5s; }
        .dark body { background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%); }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .dark .glass-card { background: rgba(30, 41, 59, 0.8); border: 1px solid rgba(255, 255, 255, 0.1); }

        .btn-gradient { background: linear-gradient(to right, #0056b3, #007bff); transition: 0.3s; }
        .btn-gradient:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,86,179,0.3); }

        input { transition: 0.3s; }
        input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(0,86,179,0.1); }
    </style>

    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="glass-card w-full max-w-md p-10 rounded-3xl">

            <div class="flex justify-end">
                <button onclick="document.documentElement.classList.toggle('dark')" class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    🌙/☀️
                </button>
            </div>

            <div class="text-center mb-8">
                <h1 class="text-4xl font-black text-[#0056b3]">Compured<span class="text-[#8cc63f]">Peru</span></h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Crea tu cuenta profesional</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nombre Completo</label>
                    <input type="text" name="name" class="w-full mt-1 p-4 rounded-xl border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Correo Electrónico</label>
                    <input type="email" name="email" class="w-full mt-1 p-4 rounded-xl border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Contraseña</label>
                        <input type="password" name="password" class="w-full mt-1 p-4 rounded-xl border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Confirmar</label>
                        <input type="password" name="password_confirmation" class="w-full mt-1 p-4 rounded-xl border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>
                </div>

                <button type="submit" class="btn-gradient w-full text-white py-4 rounded-xl font-bold text-lg mt-4">
                    Registrarse
                </button>
            </form>

            <p class="text-center mt-6 text-sm text-gray-600 dark:text-gray-400">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-[#0056b3] font-bold hover:underline">Inicia Sesión</a>
            </p>
        </div>
    </div>
</x-guest-layout>
