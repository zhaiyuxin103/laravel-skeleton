<x-mary-dropdown>
    <x-slot:trigger>
        <x-mary-button
            icon="o-language"
            class="btn-circle btn-ghost text-gray-500 hover:bg-white"
        />
    </x-slot>
    <x-mary-menu-item
        title="{{ __('labels.locales.en') }}"
        wire:click.stop="switchable('en')"
        @class([
            'font-bold' => $this->currentLocale === 'en',
        ])
    ></x-mary-menu-item>
    <x-mary-menu-item
        title="{{ __('labels.locales.ja') }}"
        wire:click.stop="switchable('ja')"
        @class([
            'font-bold' => $this->currentLocale === 'ja',
        ])
    ></x-mary-menu-item>
    <x-mary-menu-item
        title="{{ __('labels.locales.zh_CN') }}"
        wire:click.stop="switchable('zh_CN')"
        @class([
            'font-bold' => $this->currentLocale === 'zh_CN',
        ])
    ></x-mary-menu-item>
</x-mary-dropdown>
