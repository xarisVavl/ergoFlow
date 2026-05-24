<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Νέος Εργαζόμενος
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="name" value="Όνομα" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                            :value="old('email')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div>
                        <x-input-label for="password" value="Κωδικός" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                            required />
                        <x-input-error class="mt-2" :messages="$errors->get('password')" />
                    </div>

                    <div>
                        <x-input-label for="annual_leave_days" value="Μέρες Άδειας" />
                        <x-text-input id="annual_leave_days" name="annual_leave_days" type="number"
                            class="mt-1 block w-full" :value="old('annual_leave_days', 21)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('annual_leave_days')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>Αποθήκευση</x-primary-button>
                        <a href="{{ route('users.index') }}"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Ακύρωση</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
