<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Privacy as PrivacyModel;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;

class Privacy extends Component
{
    #[Computed]
    public function privacies(): Collection
    {
        return PrivacyModel::where('state', true)->get();
    }

    #[Layout('layouts.guest')]
    public function render(): View
    {
        return view('livewire.privacy');
    }
}
