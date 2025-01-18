<x-action-section>
    <x-slot name="title">
        {{ __('Delete Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete your account.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </div>

        <div class="mt-5">
            <x-danger-button
                wire:click="confirmUserDeletion"
                wire:loading.attr="disabled"
            >
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Delete Account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}

                <div
                    class="mt-4"
                    x-data="{}"
                    x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)"
                >
                    <div class="relative w-3/4" x-data="{ password: true }">
                        <x-input
                            x-bind:type="password ? 'password' : 'text'"
                            class="mt-1 block w-full"
                            autocomplete="current-password"
                            placeholder="{{ __('Password') }}"
                            x-ref="password"
                            wire:model="password"
                            wire:keydown.enter="deleteUser"
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
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button
                    wire:click="$toggle('confirmingUserDeletion')"
                    wire:loading.attr="disabled"
                >
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button
                    class="ms-3"
                    wire:click="deleteUser"
                    wire:loading.attr="disabled"
                >
                    {{ __('Delete Account') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
