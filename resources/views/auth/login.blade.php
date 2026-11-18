<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Penghuni Kos</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] } } }
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow p-8 w-full max-w-sm">
        <h1 class="text-2xl font-bold text-green-700 mb-1">Sistem Penghuni Kos</h1>
        <p class="text-gray-500 text-sm mb-6">Silakan login untuk melanjutkan</p>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded-lg mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-sm mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-full hover:bg-green-700">
                Login
            </button>
        </form>
    </div>
</body>
</html>