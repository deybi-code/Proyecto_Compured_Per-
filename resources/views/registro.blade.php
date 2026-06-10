<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - CompuredPeru</title>
    <!-- CDN de Tailwind: esto asegura que el diseño cargue siempre -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%); transition: 0.5s; }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .btn-gradient { background: linear-gradient(to right, #0056b3, #007bff); }
    </style>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="glass-card w-full max-w-md p-10 rounded-3xl">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-black text-[#0056b3]">Compured<span class="text-[#8cc63f]">Peru</span></h1>
            </div>
            <!-- Asegúrate de mantener el @csrf para que el login funcione -->
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div><label class="block text-sm font-semibold">Nombre Completo</label><input type="text" name="name" class="w-full mt-1 p-4 rounded-xl border" required></div>
                <div><label class="block text-sm font-semibold">Correo Electrónico</label><input type="email" name="email" class="w-full mt-1 p-4 rounded-xl border" required></div>
                <div><label class="block text-sm font-semibold">Contraseña</label><input type="password" name="password" class="w-full mt-1 p-4 rounded-xl border" required></div>
                <div><label class="block text-sm font-semibold">Confirmar</label><input type="password" name="password_confirmation" class="w-full mt-1 p-4 rounded-xl border" required></div>
                <button type="submit" class="btn-gradient w-full text-white py-4 rounded-xl font-bold">Registrarse</button>
            </form>
        </div>
    </div>
</body>
</html>
