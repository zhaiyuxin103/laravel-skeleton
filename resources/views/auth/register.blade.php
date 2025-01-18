<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="flex justify-between gap-4 md:gap-6">
                <div class="basis-1/2">
                    <x-label
                        for="first_name"
                        value="{{ __('fields.first_name') }}"
                    />
                    <x-input
                        id="first_name"
                        class="mt-1 block w-full"
                        type="text"
                        name="first_name"
                        :value="old('first_name')"
                        required
                        autofocus
                    />
                </div>
                <div class="basis-1/2">
                    <x-label
                        for="last_name"
                        value="{{ __('fields.last_name') }}"
                    />
                    <x-input
                        id="last_name"
                        class="mt-1 block w-full"
                        type="text"
                        name="last_name"
                        :value="old('last_name')"
                        required
                    />
                </div>
            </div>

            <div class="mt-4 flex justify-between gap-4 md:gap-6">
                <div class="basis-1/2">
                    <x-label
                        for="first_alias"
                        value="{{ __('fields.first_alias') }}"
                    />
                    <x-input
                        id="first_alias"
                        class="mt-1 block w-full"
                        type="text"
                        name="first_alias"
                        :value="old('first_alias')"
                    />
                </div>
                <div class="basis-1/2">
                    <x-label
                        for="last_alias"
                        value="{{ __('fields.last_alias') }}"
                    />
                    <x-input
                        id="last_alias"
                        class="mt-1 block w-full"
                        type="text"
                        name="last_alias"
                        :value="old('last_alias')"
                    />
                </div>
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input
                    id="email"
                    class="mt-1 block w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autocomplete="username"
                />
            </div>

            <div class="mt-4">
                <x-label for="phone" value="{{ __('fields.phone') }}"></x-label>
                <x-input
                    id="phone"
                    class="mt-1 block w-full"
                    type="text"
                    name="phone"
                    :value="old('phone')"
                ></x-input>
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

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!!
                                    __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="' . route('terms') . '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' . __('Terms of Service') . '</a>',
                                        'privacy_policy' => '<a target="_blank" href="' . route('privacies') . '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' . __('Privacy Policy') . '</a>',
                                    ])
                                !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="mt-4 flex items-center justify-end">
                <a
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    href="{{ route('login') }}"
                >
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
