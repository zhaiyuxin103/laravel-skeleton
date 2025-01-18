<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input
                type="hidden"
                name="token"
                value="{{ $request->route('token') }}"
            />

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input
                    id="email"
                    class="mt-1 block w-full"
                    type="email"
                    name="email"
                    :value="old('email', $request->email)"
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
                        autocomplete="new-password"
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

            <div class="mt-4">
                <x-label
                    for="password_confirmation"
                    value="{{ __('Confirm Password') }}"
                />
                <div class="relative" x-data="{ password: true }">
                    <x-input
                        id="password_confirmation"
                        class="mt-1 block w-full"
                        x-bind:type="password ? 'password' : 'text'"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
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

            <div class="mt-4 flex items-center justify-end">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
