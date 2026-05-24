<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Εργαζόμενοι
        </h2>
    </x-slot>

    <div class="py-12 px-3">
        <div class="max-w-7xl mx-auto sm:px-6  lg:px-8">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-100 dark:border-indigo-800 rounded-full">
                    <svg class="w-4 h-4 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span
                        class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">{{ $users->count() }}</span>
                    <span class="text-sm text-indigo-500 dark:text-indigo-400">εργαζόμενοι</span>
                </div>
                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white text-sm font-medium rounded-full transition-all duration-150 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Νέος Εργαζόμενος
                </a>
            </div>

            {{-- Desktop Table --}}
            <div class="hidden lg:block bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Όνομα</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Σύνολο Ημερών</th>
                                <th class="px-6 py-3">Υπόλοιπο</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                @continue(auth()->id() === $user->id)
                                <tr class="cursor-pointer hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors duration-150"
                                    @click="window.location='{{ route('users.show', $user) }}'">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center shrink-0">
                                                <span
                                                    class="text-indigo-600 dark:text-indigo-400 font-semibold text-xs">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <span class="font-medium">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">{{ $user->annual_leave_days }}</td>
                                    <td class="px-6 py-4">{{ $user->remainingDays() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Δεν υπάρχουν
                                        εργαζόμενοι</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Mobile Cards --}}
            <div class="lg:hidden grid grid-cols-1 md:grid-cols-2 gap-3">
                @forelse ($users as $user)
                    @continue(auth()->id() === $user->id)
                    <div
                        class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-4 border border-gray-100 dark:border-gray-700 ">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center shrink-0">
                                    <span class="text-indigo-600 dark:text-indigo-400 font-semibold text-sm">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                                        {{ $user->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                                </div>
                            </div>
                            <span
                                class="text-xs px-2 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 capitalize">
                                {{ $user->role }}
                            </span>
                        </div>

                        <div class="mt-3 flex justify-end">
                            <a href="{{ route('users.show', $user) }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-indigo-100 hover:bg-indigo-200 dark:bg-indigo-900/30 dark:hover:bg-indigo-900/50 text-indigo-700 dark:text-indigo-400 rounded-full transition-all duration-150">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>

                            </a>
                        </div>
                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Σύνολο Αδειών</p>
                                <p class="text-xl font-bold text-gray-800 dark:text-gray-200 mt-1">
                                    {{ $user->annual_leave_days }}</p>
                            </div>
                            <div class="bg-indigo-50 dark:bg-indigo-900/30 rounded-lg p-3 text-center">
                                <p class="text-xs text-indigo-500 dark:text-indigo-400">Υπόλοιπο</p>
                                <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mt-1">
                                    {{ $user->remainingDays() }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-8">Δεν υπάρχουν εργαζόμενοι</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
