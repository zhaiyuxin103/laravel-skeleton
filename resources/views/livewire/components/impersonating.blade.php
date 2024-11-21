<div>
    @impersonating($guard = null)
    <x-mary-alert
        title="{{ __('labels.impersonating') }}"
        description="{{ __('You are currently impersonating a user.') }}"
        icon="o-exclamation-triangle"
        class="alert-info"
    >
        <x-slot:actions>
            <a
                href="{{ route('impersonate.leave') }}"
                class="btn"
                wire:navigate
            >
                {{ __('Leave impersonation') }}
            </a>
        </x-slot>
    </x-mary-alert>
    @endImpersonating
</div>
