<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="flex grow flex-col space-y-4">
            <x-validation-errors />

            @session('status')
                <div class="text-sm font-medium text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input
                        id="email"
                        class="mt-1 block w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                    />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <div class="relative" x-data="{ password: true }">
                        <x-input
                            id="password"
                            class="mt-1 block w-full"
                            x-bind:type="password ? 'password' : 'text'"
                            name="password"
                            required
                            autocomplete="current-password"
                        />
                        <x-mary-icon
                            name="o-eye"
                            class="absolute inset-y-1/2 right-4 m-auto size-5 cursor-pointer"
                            x-show="!password"
                            x-on:click="password = !password"
                        ></x-mary-icon>
                        <x-mary-icon
                            name="o-eye-slash"
                            class="absolute inset-y-1/2 right-4 m-auto size-5 cursor-pointer"
                            x-show="password"
                            x-on:click="password = !password"
                        ></x-mary-icon>
                    </div>
                </div>

                <div class="mt-4 block">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600">
                            {{ __('Remember me') }}
                        </span>
                    </label>
                </div>

                <div class="mt-4 flex items-center justify-end">
                    @if (Route::has('password.request'))
                        <a
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            href="{{ route('password.request') }}"
                        >
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-mary-button
                        class="btn-primary btn-sm ms-4"
                        type="submit"
                    >
                        {{ __('Log in') }}
                    </x-mary-button>
                </div>
            </form>

            <hr />

            <div class="text-center">
                <x-mary-button
                    class="btn-outline btn-sm"
                    link="{{ route('register') }}"
                    label="{{ __('First time user') }}"
                ></x-mary-button>
            </div>

            @env(['local', 'staging'])
                <hr />

                @foreach (['zhaiyuxin103@hotmail.com', 'zhaiyuxin103@gmail.com'] as $value)
                    <x-login-link
                        :email="$value"
                        label="{{ __('Login as :email', [
                        'email' => $value,
                    ]) }}"
                        class="btn-sm mx-auto block"
                    />
                @endforeach
            @endenv
        </div>
    </x-authentication-card>
</x-guest-layout>
