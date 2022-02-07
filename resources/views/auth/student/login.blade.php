


<x-guest-layout>
    <x-auth-card>
        <h1>O'quvchi kirish oynasi</h1>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('studentLogin') }}">
        @csrf

        <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('ID')" />

                <x-input id="email" class="block mt-1 w-full" type="text" name="username" :value="old('email')" required autofocus />
            </div>
           

            <div class="flex items-center justify-end mt-4">
               

                <x-button class="ml-3">
                    {{ __('Kirish') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
