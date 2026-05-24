<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Προφίλ Εργαζόμενου
        </h2>
    </x-slot>

    <div class="py-12 px-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Profile Card --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-16 h-16 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center shrink-0">
                            <span
                                class="text-indigo-600 dark:text-indigo-400 font-bold text-2xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                            <span
                                class="inline-block mt-1 text-xs px-2 py-0.5 rounded-full bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400">
                                {{ $user->role->label() }}
                            </span>
                        </div>
                    </div>

                    <a href="{{ route('users.edit', $user) }}"
                        class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-50 hover:bg-indigo-100 dark:bg-indigo-900/30 dark:hover:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 text-sm font-medium rounded-full border border-indigo-100 dark:border-indigo-800 transition-all duration-150 self-start sm:self-auto">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Επεξεργασία
                    </a>
                </div>

                {{-- Stats --}}
                <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 gap-3">
                    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-3 sm:p-4 text-center">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Σύνολο Αδειών</p>
                        <p class="text-xl font-bold text-gray-800 dark:text-gray-100 mt-1">
                            {{ $user->annual_leave_days }}</p>
                    </div>
                    <div class="bg-indigo-50 dark:bg-indigo-900/20 rounded-xl p-3 sm:p-4 text-center">
                        <p class="text-xs text-indigo-500 dark:text-indigo-400">Χρησιμοποιήθηκαν</p>
                        <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mt-1">{{ $user->usedDays() }}
                        </p>
                    </div>
                    <div
                        class="bg-green-50 dark:bg-green-900/20 rounded-xl p-3 sm:p-4 text-center col-span-2 sm:col-span-1">
                        <p class="text-xs text-green-600 dark:text-green-400">Υπόλοιπο</p>
                        <p class="text-xl font-bold text-green-600 dark:text-green-400 mt-1">
                            {{ $user->remainingDays() }}</p>
                    </div>
                </div>
            </div>

            {{-- Leave History --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">Ιστορικό Αδειών</h3>
                    <span
                        class="text-xs bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 px-2 py-1 rounded-full">{{ $leaveRequests->count() }}
                        εγκεκριμένες</span>
                </div>

                {{-- Desktop Table --}}
                <div class="hidden sm:block p-6 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3">Τύπος</th>
                                <th class="px-4 py-3">Από</th>
                                <th class="px-4 py-3">Έως</th>
                                <th class="px-4 py-3">Διάρκεια</th>
                                <th class="px-4 py-3">Αιτιολογία</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leaveRequests as $request)
                                <tr
                                    class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-4">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full {{ $request->type->badgeClass() }}">{{ $request->type->label() }}</span>
                                    </td>
                                    <td class="px-4 py-4">{{ $request->start_date }}</td>
                                    <td class="px-4 py-4">{{ $request->end_date }}</td>
                                    <td class="px-4 py-4 font-medium">{{ $request->durationInDays() }} μέρες</td>
                                    <td class="px-4 py-4 text-gray-500 dark:text-gray-400 max-w-xs truncate">
                                        {{ $request->description }}</td>
                                </tr>
                            @empty
                                <tr
                                    class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-4">
                                        <p>Ο χρήστης δέν έχει χρησιμοποιήσει απο τις διαθέσιμες άδειες του ακομη</p>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                {{-- Mobile Cards --}}
                <div class="sm:hidden p-4 space-y-3">
                    @forelse ($leaveRequests as $request)
                        <div class="border border-gray-100 dark:border-gray-700 rounded-xl p-4 space-y-3">
                            <div class="flex items-center justify-between">
                                <span
                                    class="px-2 py-1 text-xs rounded-full {{ $request->type->badgeClass() }}">{{ $request->type->label() }}</span>
                                <span
                                    class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $request->durationInDays() }}
                                    μέρες</span>
                            </div>
                            <div class="grid grid-cols-2 gap-2 text-sm">
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Από</p>
                                    <p class="text-gray-800 dark:text-gray-200">{{ $request->start_date }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Έως</p>
                                    <p class="text-gray-800 dark:text-gray-200">{{ $request->end_date }}</p>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $request->description }}</p>
                        </div>
                    @empty
                        <div class="border border-gray-100 dark:border-gray-700 rounded-xl p-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Ο χρήστης δεν έχει χρησιμοποιήσει από
                                τις διαθέσιμες άδειες του ακόμη</p>
                        </div>
                    @endforelse
                </div>



            </div>

        </div>
    </div>
</x-app-layout>
