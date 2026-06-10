<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border-t-4 border-[#0056b3]">

            <div class="text-center mb-6">
                <h1 class="text-3xl font-extrabold text-[#0056b3]">Compured<span class="text-[#8cc63f]">Peru</span></h1>
                <p class="text-sm text-gray-500">Regístrate para continuar</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Nombre Completo</label>
                    <input type="text" name="name" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8cc63f] outline-none" required autofocus>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Correo Electrónico</label>
                    <input type="email" name="email" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8cc63f] outline-none" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Contraseña</label>
                    <input type="password" name="password" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8cc63f] outline-none" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8cc63f] outline-none" required>
                </div>

                <button type="submit" class="w-full bg-[#0056b3] text-white p-3 rounded-lg font-bold hover:bg-[#004494] transition duration-300">
                    Registrarse
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-[#8cc63f] font-semibold hover:underline">¿Ya tienes cuenta? Inicia sesión</a>
            </div>
        </div>
    </div>
</x-guest-layout>
