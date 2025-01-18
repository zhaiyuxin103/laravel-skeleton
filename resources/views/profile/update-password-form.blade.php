<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label
                for="current_password"
                value="{{ __('Current Password') }}"
            />
            <div class="relative" x-data="{ password: true }">
                <x-input
                    id="current_password"
                    x-bind:type="password ? 'password' : 'text'"
                    class="mt-1 block w-full"
                    wire:model="state.current_password"
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
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('New Password') }}" />
            <div class="relative" x-data="{ password: true }">
                <x-input
                    id="password"
                    x-bind:type="password ? 'password' : 'text'"
                    class="mt-1 block w-full"
                    wire:model="state.password"
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
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label
                for="password_confirmation"
                value="{{ __('Confirm Password') }}"
            />

            <div class="relative" x-data="{ password: true }">
                <x-input
                    id="password_confirmation"
                    x-bind:type="password ? 'password' : 'text'"
                    class="mt-1 block w-full"
                    wire:model="state.password_confirmation"
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
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
