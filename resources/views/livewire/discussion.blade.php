<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="mx-auto max-w-3xl p-6 lg:p-8">
                <p class="text-center text-3xl font-black">お問い合わせ</p>
                <p
                    class="mt-6 px-4 font-semibold text-[#626770] sm:px-6 md:px-8"
                >
                    顧客情報管理システムに関するお問い合わせは以下のフォームからご連絡ください。
                    <br />
                    担当者が確認の上ご連絡いたします。
                </p>
                <x-mary-form
                    wire:submit="save"
                    class="mt-6 px-4 sm:px-6 md:px-8"
                >
                    <x-mary-input
                        label="{{ __('fields.name') }}"
                        wire:model="state.name"
                        required
                        placeholder="{{ __('placeholders.name') }}"
                    ></x-mary-input>
                    <x-mary-input
                        label="{{ __('fields.title') }}"
                        wire:model="state.title"
                        placeholder="{{ __('placeholders.title') }}"
                    ></x-mary-input>
                    <x-mary-input
                        label="{{ __('fields.email') }}"
                        wire:model="state.email"
                        type="email"
                        required
                        placeholder="{{ __('placeholders.email') }}"
                    ></x-mary-input>
                    <x-mary-input
                        label="{{ __('fields.phone') }}"
                        wire:model="state.phone"
                        placeholder="{{ __('placeholders.phone') }}"
                    ></x-mary-input>
                    <x-mary-textarea
                        label="{{ __('fields.content') }}"
                        wire:model="state.content"
                        required
                        placeholder="{{ __('placeholders.content') }}"
                        rows="5"
                    ></x-mary-textarea>
                    <x-slot:actions>
                        <x-mary-button
                            class="btn-primary"
                            spinner="save"
                            type="submit"
                            label="{{ __('labels.submit') }}"
                        />
                    </x-slot>
                </x-mary-form>
            </div>
        </div>
    </div>
</div>
