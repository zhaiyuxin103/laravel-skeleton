<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div
                x-data="{ photoName: null, photoPreview: null }"
                class="col-span-6 sm:col-span-4"
            >
                <!-- Profile Photo File Input -->
                <input
                    type="file"
                    id="photo"
                    class="hidden"
                    wire:model.live="photo"
                    x-ref="photo"
                    x-on:change="
                        photoName = $refs.photo.files[0].name
                        const reader = new FileReader()
                        reader.onload = (e) => {
                            photoPreview = e.target.result
                        }
                        reader.readAsDataURL($refs.photo.files[0])
                    "
                />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img
                        src="{{ $this->user->profile_photo_url }}"
                        alt="{{ $this->user->name }}"
                        class="h-20 w-20 rounded-full object-cover"
                    />
                </div>

                <!-- New Profile Photo Preview -->
                <div
                    class="mt-2"
                    x-show="photoPreview"
                    style="display: none"
                >
                    <span
                        class="block h-20 w-20 rounded-full bg-cover bg-center bg-no-repeat"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'"
                    ></span>
                </div>

                <x-secondary-button
                    class="me-2 mt-2"
                    type="button"
                    x-on:click.prevent="$refs.photo.click()"
                >
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button
                        type="button"
                        class="mt-2"
                        wire:click="deleteProfilePhoto"
                    >
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <div
            class="col-span-6 flex justify-between gap-4 sm:col-span-4 md:gap-6"
        >
            <div class="basis-1/2">
                <x-label
                    for="first_name"
                    value="{{ __('fields.first_name') }}"
                />
                <x-input
                    id="first_name"
                    class="mt-1 block w-full"
                    type="text"
                    wire:model="state.first_name"
                    required
                />
                <x-input-error for="first_name" class="mt-2" />
            </div>
            <div class="basis-1/2">
                <x-label for="last_name" value="{{ __('fields.last_name') }}" />
                <x-input
                    id="last_name"
                    class="mt-1 block w-full"
                    type="text"
                    wire:model="state.last_name"
                    required
                />
                <x-input-error for="last_name" class="mt-2" />
            </div>
        </div>

        <div
            class="col-span-6 flex justify-between gap-4 sm:col-span-4 md:gap-6"
        >
            <div class="basis-1/2">
                <x-label
                    for="first_alias"
                    value="{{ __('fields.first_alias') }}"
                />
                <x-input
                    id="first_alias"
                    class="mt-1 block w-full"
                    type="text"
                    wire:model="state.first_alias"
                    required
                />
                <x-input-error for="first_alias" class="mt-2" />
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
                    wire:model="state.last_alias"
                    required
                />
                <x-input-error for="last_alias" class="mt-2" />
            </div>
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input
                id="email"
                type="email"
                class="mt-1 block w-full"
                wire:model="state.email"
                required
                autocomplete="username"
            />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="mt-2 text-sm dark:text-white">
                    {{ __('Your email address is unverified.') }}

                    <button
                        type="button"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                        wire:click.prevent="sendEmailVerification"
                    >
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p
                        class="mt-2 text-sm font-medium text-green-600 dark:text-green-400"
                    >
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone" value="{{ __('fields.phone') }}" />
            <x-input
                id="phone"
                type="text"
                class="mt-1 block w-full"
                wire:model="state.phone"
            />
            <x-input-error for="phone" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
