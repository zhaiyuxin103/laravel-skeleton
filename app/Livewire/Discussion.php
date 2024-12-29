<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\DiscussionStatusEnum;
use App\Enums\DiscussionTypeEnum;
use App\Models\Discussion as DiscussionModel;
use Illuminate\View\View;

class Discussion extends Component
{
    public array $state = [
        'name'    => '',
        'title'   => '',
        'email'   => '',
        'phone'   => '',
        'content' => '',
    ];

    public function rules(): array
    {
        return [
            'state.name'    => ['required', 'min:3', 'max:50'],
            'state.title'   => ['min:3', 'max:50'],
            'state.email'   => ['required', 'email'],
            'state.phone'   => ['phone:US,CN,JP', 'min:3'],
            'state.content' => ['required', 'min:3', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'state.phone.phone' => trans('validation.messages.phone.phone'),
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'state.name'    => trans('validation.attributes.name'),
            'state.title'   => trans('validation.attributes.title'),
            'state.email'   => trans('validation.attributes.email'),
            'state.phone'   => trans('validation.attributes.phone'),
            'state.content' => trans('validation.attributes.content'),
        ];
    }

    public function save(): void
    {
        $this->validate();

        DiscussionModel::create([
            'type'    => DiscussionTypeEnum::FEED->value,
            'name'    => data_get($this->state, 'name'),
            'title'   => data_get($this->state, 'title'),
            'user_id' => auth()->id(),
            'email'   => data_get($this->state, 'email'),
            'phone'   => data_get($this->state, 'phone'),
            'content' => data_get($this->state, 'content'),
            'status'  => DiscussionStatusEnum::PENDING->value,
        ]);

        $this->reset();

        $this->success(trans('messages.success.created'));
    }

    public function render(): View
    {
        return view('livewire.discussion');
    }
}
