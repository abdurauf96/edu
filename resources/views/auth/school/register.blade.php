{{-- @php dd(auth()->guard('school')->user()) @endphp --}}
<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <form method="POST" action="{{ route('schoolRegister') }}">
            @csrf
            
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Company Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required autofocus />
            </div>

            <div>
                <x-label for="name" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus />
            </div>

            
            
            <div>
                <label for="">Addres</label>
                <input type="text" name="addres" value="{{ old('addres') }}">
            </div>

            <div>
                <label for="">Domain</label>
                <input type="text" name="domain" value="{{ old('domain') }}">
            </div>

            <div>
                <label for="">Director</label>
                <input type="text" name="director" value="{{ old('director') }}">
            </div>

            <div>
                <label for="">Card number</label>
                <input type="text" name="card_number" value="{{ old('card_number') }}">
            </div>

            <div>
                <label for="">Card date</label>
                <input type="text"  name="card_date" value="{{ old('card_date') }}">
            </div>

            <div>
                <label for="">Card name</label>
                <input type="text" name="card_name" value="{{ old('card_name') }}">
            </div>

            <!-- User Name -->
            <div class="mt-4">
                <x-label for="email" :value="__('Username')" />

                <x-input class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    </div>
</x-guest-layout>