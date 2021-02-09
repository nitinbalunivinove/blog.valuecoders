<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo"></x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="user">
            @csrf

            <div class="form-group">
                <x-jet-input id="email" class="form-control form-control-user" placeholder="Enter Email Address..."
                type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="form-group">
                <x-jet-input id="password" class="form-control form-control-user" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
            </div>

            <div class="form-group">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="form-group">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
        <div class="text-center">
            <a class="small" href="{{url('register')}}">Create an Account!</a>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
