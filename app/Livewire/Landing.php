<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Landing as LandingModel;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;

class Landing extends Component
{
    #[Computed]
    public function landings(): Collection
    {
        return LandingModel::where('state', true)->get();
    }

    #[Layout('layouts.guest')]
    public function render(): View
    {
        return view('livewire.landing');
    }
}
