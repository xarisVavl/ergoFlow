<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Πίνακας ελέγχου
        </h2>
    </x-slot>

    <div class="py-12 px-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Stats Cards --}}
            <div class="grid grid-cols-3 gap-4">
                <div
                    class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-5 border border-gray-100 dark:border-gray-700">
                    <div class="flex flex-col gap-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Εκκρεμείς</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-yellow-500 leading-tight">{{ $pendingCount }}</p>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-5 border border-gray-100 dark:border-gray-700">
                    <div class="flex flex-col gap-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Εγκεκριμένες</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-green-500 leading-tight">{{ $approvedCount }}</p>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-5 border border-gray-100 dark:border-gray-700">
                    <div class="flex flex-col gap-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Απορριφθείσες</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-red-500 leading-tight">{{ $rejectedCount }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pending Leave Requests Desktop --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">Εκκρεμείς Αιτήσεις</h3>
                    @if ($pendingCount > 0)
                        <span
                            class="text-xs bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 px-2 py-1 rounded-full">{{ $pendingCount }}
                            σε αναμονή</span>
                    @endif
                </div>

                {{-- Desktop Table --}}
                <div class="hidden sm:block p-6 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3">Εργαζόμενος</th>
                                <th class="px-4 py-3">Τύπος</th>
                                <th class="px-4 py-3">Από</th>
                                <th class="px-4 py-3">Έως</th>
                                <th class="px-4 py-3">Αιτιολογία</th>
                                <th class="px-4 py-3">Ενέργειες</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($requests as $request)
                                <tr
                                    class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-7 h-7 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center shrink-0">
                                                <span
                                                    class="text-indigo-600 dark:text-indigo-400 font-semibold text-xs">
                                                    {{ strtoupper(substr($request->user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <span class="font-medium">{{ $request->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">{{ $request->type->label() }}</td>
                                    <td class="px-4 py-4">{{ $request->start_date }}</td>
                                    <td class="px-4 py-4">{{ $request->end_date }}</td>
                                    <td class="px-4 py-4 max-w-xs truncate text-gray-500 dark:text-gray-400">
                                        {{ $request->description }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex gap-2">
                                            <form action="{{ route('leave-requests.update', $request) }}"
                                                method="POST">
                                                @method('PATCH')
                                                @csrf
                                                <input type="hidden" name="action" value="approve">
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-green-100 hover:bg-green-200 dark:bg-green-900/30 dark:hover:bg-green-900/50 text-green-700 dark:text-green-400 rounded-full transition-all duration-150">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2.5" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Έγκριση
                                                </button>
                                            </form>
                                            <form action="{{ route('leave-requests.update', $request) }}"
                                                method="POST">
                                                @method('PATCH')
                                                @csrf
                                                <input type="hidden" name="action" value="reject">
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:hover:bg-red-900/50 text-red-700 dark:text-red-400 rounded-full transition-all duration-150">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Απόρριψη
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">Δεν υπάρχουν
                                        εκκρεμείς αιτήσεις</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Mobile Cards --}}
                <div class="sm:hidden p-4 space-y-3">
                    @forelse ($requests as $request)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-4 space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center shrink-0">
                                        <span class="text-indigo-600 dark:text-indigo-400 font-semibold text-xs">
                                            {{ strtoupper(substr($request->user->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <span
                                        class="font-medium text-gray-800 dark:text-gray-200">{{ $request->user->name }}</span>
                                </div>
                                <span
                                    class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-2 py-1 rounded-full">{{ $request->type->label() }}</span>
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
                            @if ($request->description)
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                    {{ $request->description }}</p>
                            @endif
                            <div class="flex gap-2 pt-1">
                                <form action="{{ route('leave-requests.update', $request) }}" method="POST"
                                    class="flex-1">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" name="action" value="approve">
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-1.5 py-2 text-xs font-medium bg-green-100 hover:bg-green-200 dark:bg-green-900/30 dark:hover:bg-green-900/50 text-green-700 dark:text-green-400 rounded-full transition-all duration-150">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Έγκριση
                                    </button>
                                </form>
                                <form action="{{ route('leave-requests.update', $request) }}" method="POST"
                                    class="flex-1">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" name="action" value="reject">
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-1.5 py-2 text-xs font-medium bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:hover:bg-red-900/50 text-red-700 dark:text-red-400 rounded-full transition-all duration-150">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Απόρριψη
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-6">Δεν υπάρχουν εκκρεμείς αιτήσεις</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
