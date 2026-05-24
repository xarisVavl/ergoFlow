<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data x-bind:class="{ 'dark': $store.theme.isDark }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('theme', {
                    isDark: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),
                    toggle() {
                        this.isDark = !this.isDark;
                        localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
                    }
                });
            });
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex bg-gray-50 dark:bg-gray-900">

            {{-- Left Panel --}}
            <div class="hidden lg:flex lg:w-1/2 xl:w-3/5 bg-indigo-600 flex-col justify-between p-12 relative overflow-hidden">

                {{-- Background decoration --}}
                <div class="absolute inset-0 overflow-hidden">
                    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-indigo-500/40"></div>
                    <div class="absolute -bottom-32 -left-16 w-[500px] h-[500px] rounded-full bg-indigo-700/50"></div>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 rounded-full bg-indigo-500/20"></div>
                </div>

                {{-- Logo --}}
                <div class="relative flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="text-white font-bold text-xl tracking-tight">ergoFlow</span>
                </div>

                {{-- Center content --}}
                <div class="relative space-y-6">
                    <div class="space-y-3">
                        <h1 class="text-4xl xl:text-5xl font-bold text-white leading-tight">
                            Διαχείριση<br>αδειών με<br>ευκολία.
                        </h1>
                        <p class="text-indigo-200 text-lg leading-relaxed max-w-sm">
                            Απλοποιήστε τη διαδικασία αιτήσεων αδειών για ολόκληρη την ομάδα σας.
                        </p>
                    </div>

                    {{-- Stats --}}
                    <div class="flex gap-8 pt-4">
                        <div>
                            <p class="text-3xl font-bold text-white">100%</p>
                            <p class="text-indigo-300 text-sm mt-1">Αυτοματοποιημένο</p>
                        </div>
                        <div class="w-px bg-indigo-400/50"></div>
                        <div>
                            <p class="text-3xl font-bold text-white">0</p>
                            <p class="text-indigo-300 text-sm mt-1">Χαρτιά</p>
                        </div>
                        <div class="w-px bg-indigo-400/50"></div>
                        <div>
                            <p class="text-3xl font-bold text-white">24/7</p>
                            <p class="text-indigo-300 text-sm mt-1">Πρόσβαση</p>
                        </div>
                    </div>
                </div>

                {{-- Bottom --}}
                <div class="relative">
                    <p class="text-indigo-300 text-sm">© {{ date('Y') }} ergoFlow. Όλα τα δικαιώματα διατηρούνται.</p>
                </div>
            </div>

            {{-- Right Panel --}}
            <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 lg:px-16 xl:px-24">

                {{-- Mobile Logo --}}
                <div class="lg:hidden flex items-center gap-3 mb-10">
                    <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="font-bold text-gray-900 dark:text-white text-xl tracking-tight">ergoFlow</span>
                </div>

                <div class="w-full max-w-sm">
                    {{ $slot }}
                </div>

                {{-- Dark mode toggle --}}
                <button @click="$store.theme.toggle()" class="mt-8 flex items-center gap-2 text-sm text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition">
                    <svg x-show="!$store.theme.isDark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <svg x-show="$store.theme.isDark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span x-text="$store.theme.isDark ? 'Light mode' : 'Dark mode'"></span>
                </button>
            </div>

        </div>
    </body>
</html>
