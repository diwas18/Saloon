<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6 max-w-lg mx-auto bg-white p-6 rounded-xl shadow-md">
        @csrf

        <!-- Salon Branding -->
        <div class="text-center mb-6">
                <img src="{{ asset('storage/images/logo.webp') }}"
                alt="Logo" class="w-32 mx-auto mt-4 filter brightness-0 invert">
            <h2 class="text-3xl font-bold text-gray-800 mt-4">Join Sunshine Salon</h2>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-lg font-semibold text-gray-700 dark:text-gray-300" />
            <x-text-input id="name" class="block mt-2 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                          type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email Address')" class="text-lg font-semibold text-gray-700 dark:text-gray-300" />
            <x-text-input id="email" class="block mt-2 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                          type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-lg font-semibold text-gray-700 dark:text-gray-300" />
            <x-text-input id="password" class="block mt-2 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                          type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-lg font-semibold text-gray-700 dark:text-gray-300" />
            <x-text-input id="password_confirmation" class="block mt-2 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                          type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
        </div>

        <!-- Already Registered? Link -->
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Already have an account?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-500 dark:hover:text-indigo-300 font-semibold">
                    {{ __('Log in here') }}
                </a>
            </p>
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
