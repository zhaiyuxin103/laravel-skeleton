<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-label for="password" value="{{ __('Password') }}" />

                <div class="relative" x-data="{ password: true }">
                    <x-input
                        id="password"
                        class="mt-1 block w-full"
                        x-bind:type="password ? 'password' : 'text'"
                        name="password"
                        required
                        autocomplete="current-password"
                        autofocus
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

            <div class="mt-4 flex justify-end">
                <x-button class="ms-4">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
