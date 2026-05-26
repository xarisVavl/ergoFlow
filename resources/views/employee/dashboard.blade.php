<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Το Ταμπλό μου
        </h2>
    </x-slot>
    <div class="py-12 px-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome + New Request --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Καλημέρα, {{ $user->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Παρακάτω βρίσκεις την κατάσταση των αδειών
                        σου.</p>
                </div>
                <a href="#"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white text-sm font-medium rounded-full transition-all duration-150 shadow-sm self-start sm:self-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Νέα Αίτηση
                </a>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm p-5">
                    <div class="flex flex-col gap-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Σύνολο Αδειών</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                                {{ $user->annual_leave_days }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm p-5">
                    <div class="flex flex-col gap-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Χρησιμοποιήθηκαν</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-indigo-500 dark:text-indigo-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ $user->usedDays() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm p-5">
                    <div class="flex flex-col gap-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Υπόλοιπο</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                                {{ $user->remainingDays() }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm p-5">
                    <div class="flex flex-col gap-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Σε Αναμονή</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-yellow-500">{{ $pendingCount }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Leave Progress Bar --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm p-5">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Χρήση Αδειών</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->usedDays() }} /
                        {{ $user->annual_leave_days }} μέρες</p>
                </div>

                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2.5"
                    x-data="{ width: 0 }"
                    x-init="setTimeout(() => width = {{ $usedDaysPercentage }}, 100)">
                    <div class="bg-indigo-500 h-2.5 rounded-full transition-all duration-700 ease-out"
                        :style="'width: ' + width + '%'">
                    </div>
                </div>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">Έχεις χρησιμοποιήσει το
                    {{ $usedDaysPercentage }}% των διαθέσιμων
                    αδειών σου.</p>
            </div>

            {{-- My Requests --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">Οι Αιτήσεις μου</h3>
                    <span
                        class="text-xs bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 px-2 py-1 rounded-full">{{ $pendingCount }}
                        σε αναμονή</span>
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
                                <th class="px-4 py-3">Κατάσταση</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leaveRequests as $item)
                                <tr
                                    class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-4">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full {{ $item->type->badgeClass() }}">{{ $item->type->label() }}</span>
                                    </td>
                                    <td class="px-4 py-4">{{ $item->start_date }}</td>
                                    <td class="px-4 py-4">{{ $item->end_date }}</td>
                                    <td class="px-4 py-4 font-medium">{{ $item->durationInDays() }} μέρες</td>
                                    <td class="px-4 py-4">
                                        <span class="{{ $item->status->outerSpanCss() }}">
                                            <span class="{{ $item->status->innerSpanCss() }}"></span>
                                            {{ $item->status->label() }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr
                                    class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-4">
                                        <p>Δεν έχετε κάνει καμία αίτηση ακόμη</p>
                                    </td>

                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Mobile Cards --}}
                <div class="sm:hidden p-4 space-y-3">
                    @forelse ($leaveRequests as $item)
                        <div class="border border-gray-100 dark:border-gray-700 rounded-xl p-4 space-y-3">
                            <div class="flex items-center justify-between">
                                <span
                                    class="px-2 py-1 text-xs rounded-full {{ $item->type->badgeClass() }}">{{ $item->type->label() }}</span>
                                <span class="{{ $item->status->outerSpanCss() }}">
                                    <span class="{{ $item->status->innerSpanCss() }}"></span>
                                    {{ $item->status->label() }}
                                </span>
                            </div>
                            <div class="grid grid-cols-2 gap-2 text-sm">
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Από</p>
                                    <p class="text-gray-800 dark:text-gray-200">{{ $item->start_date }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Έως</p>
                                    <p class="text-gray-800 dark:text-gray-200">{{ $item->end_date }}</p>
                                </div>
                            </div>
                            <p class="text-xs font-medium text-gray-600 dark:text-gray-400">
                                {{ $item->durationInDays() }} μέρες</p>
                        </div>
                    @empty
                        <div class="border border-gray-100 dark:border-gray-700 rounded-xl p-4 space-y-3">
                            <p>Δεν έχετε κάνει καμία αίτηση ακόμη</p>
                        </div>
                    @endforelse




                </div>

            </div>

        </div>
    </div>
</x-app-layout>
