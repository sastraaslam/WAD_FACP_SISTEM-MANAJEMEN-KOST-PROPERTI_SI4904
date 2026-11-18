<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Data Penghuni') — RuangKos</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        brand: { 50: '#ecf8f3', 100: '#d3f0e3', 500: '#1f9d6e', 600: '#17855d', 700: '#116b4b' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#f6f8f7] text-slate-800 antialiased">
<div class="min-h-screen md:flex">

    {{-- ============ SIDEBAR ============ --}}
    <aside class="hidden md:flex md:flex-col w-72 shrink-0 bg-white border-r border-slate-100 p-6 sticky top-0 h-screen">
        {{-- Logo --}}
        <div class="flex items-center gap-3 mb-10">
            <div class="w-12 h-12 rounded-2xl bg-brand-600 shadow-lg shadow-brand-600/30 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1v-9.5Z"/></svg>
            </div>
            <div>
                <div class="text-xl font-extrabold leading-none tracking-tight">ruang<span class="text-brand-600">kos</span></div>
                <div class="text-[10px] tracking-[0.2em] text-slate-400 font-semibold mt-1">PROPERTY MANAGEMENT</div>
            </div>
        </div>

        <div class="text-[11px] tracking-[0.15em] font-bold text-slate-400 mb-3 px-2">MENU UTAMA</div>

        @php
            $menu = [
                ['Master Kamar',   'kamar.index',       'M3 10.5 12 3l9 7.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-9.5Z', 'kamar.*'],
                ['Data Penghuni',  'penghuni.index',    'M15 19a4 4 0 0 0-8 0M11 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm9 6a4 4 0 0 0-3-3.87M16 5.13a4 4 0 0 1 0 7.75', 'penghuni.*'],
                ['Housekeeper',    'housekeeper.index', 'M8 2v4M16 2v4M3 9h18M5 4h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Zm4 11 2 2 4-4', 'housekeeper.*'],
                ['Inventaris Aset','inventaris.index',  'M21 8 12 3 3 8v8l9 5 9-5V8ZM3 8l9 5m0 0 9-5m-9 5v8', 'inventaris.*'],
            ];
        @endphp

        <nav class="space-y-2">
            @foreach ($menu as [$label, $route, $icon, $pattern])
                @php $active = request()->routeIs($pattern); @endphp
                <a href="{{ Route::has($route) ? route($route) : '#' }}"
                   class="flex items-center gap-4 px-4 py-3.5 rounded-xl font-semibold transition
                          {{ $active ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/></svg>
                    <span class="flex-1">{{ $label }}</span>
                    @if ($active) <span class="w-2 h-2 rounded-full bg-brand-600"></span> @endif
                </a>
            @endforeach
        </nav>

        {{-- Kartu promo --}}
        <div class="mt-8 rounded-2xl border border-slate-100 bg-gradient-to-b from-brand-50/60 to-white p-5">
            <div class="w-9 h-9 rounded-xl bg-brand-100 text-brand-600 flex items-center justify-center mb-4">✦</div>
            <div class="font-bold text-sm mb-1">Kelola lebih mudah</div>
            <p class="text-xs text-slate-500 leading-relaxed">Kelola kamar, penghuni, staf, dan aset kos dalam satu tempat.</p>
        </div>

        {{-- User --}}
        @auth
        <div class="mt-auto pt-5 border-t border-slate-100 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-brand-100 text-brand-700 text-xs font-bold flex items-center justify-center">
                {{ \Illuminate\Support\Str::of(auth()->user()->name)->substr(0, 2)->upper() }}
            </div>
            <div class="flex-1 min-w-0">
                <div class="text-sm font-bold truncate">{{ auth()->user()->name }}</div>
                <div class="text-xs text-slate-400 capitalize">{{ auth()->user()->role }}</div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" title="Logout" class="p-2 rounded-lg text-slate-400 hover:bg-red-50 hover:text-red-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17l5-5-5-5M20 12H9M12 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7"/></svg>
                </button>
            </form>
        </div>
        @endauth
    </aside>

    {{-- ============ KONTEN ============ --}}
    <main class="flex-1 min-w-0 p-6 md:p-10">
        @if (session('success'))
            <div class="mb-6 flex items-center gap-3 rounded-xl bg-brand-50 border border-brand-100 text-brand-700 px-4 py-3 text-sm font-semibold">
                <span class="w-2 h-2 rounded-full bg-brand-600"></span>{{ session('success') }}
            </div>
        @endif

        @yield('content')

        <p class="text-center text-xs text-slate-400 mt-12">© {{ date('Y') }} RuangKos · Kelola kos dengan lebih tenang.</p>
    </main>
</div>
</body>
</html>