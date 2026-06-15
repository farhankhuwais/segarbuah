<x-guest-layout>
    <div class="text-center mb-6">
        <a href="/" class="inline-flex items-center gap-2 text-2xl font-bold text-emerald-600 dark:text-emerald-400 mb-1">
            <i class="ph-duotone ph-leaf" aria-hidden="true"></i>
            SegarBuah
        </a>
        <p class="text-sm text-gray-500 dark:text-gray-400">Create your account</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1.5 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Your full name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="your@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1.5 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Min. 8 characters" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1.5 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <x-primary-button class="w-full justify-center">
            {{ __('Register') }}
        </x-primary-button>

        <p class="text-center text-sm text-gray-500 dark:text-gray-400">
            Already have an account?
            <a href="{{ route('login') }}" class="text-emerald-600 dark:text-emerald-400 hover:underline font-medium">Log in</a>
        </p>
    </form>
</x-guest-layout>
