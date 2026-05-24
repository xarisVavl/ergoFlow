<x-guest-layout>
<x-auth-session-status class="mb-4" :status="session('status')" />

<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Καλώς ήρθες</h2>
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Συνδέσου στο λογαριασμό σου</p>
</div>

<form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf

    <div>
        <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
        <x-text-input
            id="email"
            class="block mt-1.5 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700/50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            type="email"
            name="email"
            :value="old('email')"
            required
            autofocus
            autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="password" :value="__('Κωδικός')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
        <x-text-input
            id="password"
            class="block mt-1.5 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700/50 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            type="password"
            name="password"
            required
            autocomplete="current-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="flex items-center justify-between">
        <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
            <input id="remember_me" type="checkbox"
                class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500"
                name="remember">
            <span class="text-sm text-gray-600 dark:text-gray-400">Να με θυμάσαι</span>
        </label>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}"
                class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-medium transition">
                Ξέχασες τον κωδικό;
            </a>
        @endif
    </div>

    <button type="submit"
        class="w-full flex justify-center items-center gap-2 px-4 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-all duration-150 shadow-sm hover:shadow-md mt-2">
        Σύνδεση
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
        </svg>
    </button>
</form>
</x-guest-layout>
