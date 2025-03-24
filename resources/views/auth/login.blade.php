<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-col justify-center items-center  mt-4 mb-8">
                <p class="text-7xl text-white font-bold max-w-7xl mx-auto text-center" > ICTPro </p>
                <p class="text-4xl text-white font-bold max-w-7xl mx-auto text-center" > ICT OFFICE TRANSACTION PROCESSING SYSTEM</p>
                {{-- <p class="text-3xl text-white drop-shadow-sm mt-3"> </p> --}}
            </div>

        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <div class="flex flex-col justify-center items-center  mt-4 mb-8">
            <p class="text-4xl  font-bold">Sign In</p>
            {{-- <p class="text-md  drop-shadow-sm "> Equipment Tracking Management System</p> --}}
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" >Email</x-label>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" >Password</x-label>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            {{-- <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div> --}}

            <div class="flex items-center justify-end mt-4">
                {{-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif --}}

                <x-button class="w-full flex items-center justify-center py-3" type="submit">
                    {{ __('Log in') }}
                </x-button>


            </div>
        </form>
        <div class="py-4 flex items-center justify-center">
            <p class="text-gray-700 mr-2">Don’t have an account?</p>
            <a href="{{route('register')}}"
               class="text-sksu-600 underline hover:text-sksu-700 rounded"
               aria-label="Create a new account">
                Create Account
            </a>
        </div>


    </x-authentication-card>
</x-guest-layout>
