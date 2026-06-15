<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-6">
        <a href="/" class="inline-flex items-center gap-2 text-2xl font-bold text-emerald-600 dark:text-emerald-400 mb-1">
            <i class="ph-duotone ph-leaf" aria-hidden="true"></i>
            SegarBuah
        </a>
        <p class="text-sm text-gray-500 dark:text-gray-400">Sign in to your account</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="your@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1.5 w-full" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-700 text-emerald-600 focus:ring-emerald-500 bg-white dark:bg-gray-800 shrink-0" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 hover:underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 dark:focus:ring-offset-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="w-full justify-center">
            {{ __('Log in') }}
        </x-primary-button>

        <p class="text-center text-sm text-gray-500 dark:text-gray-400">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-emerald-600 dark:text-emerald-400 hover:underline font-medium">Register</a>
        </p>
    </form>
</x-guest-layout>
