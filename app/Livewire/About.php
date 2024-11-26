<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\About as AboutModel;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class About extends Component
{
    #[Computed]
    public function abouts(): Collection
    {
        return AboutModel::where('state', true)->get();
    }

    public function render(): View
    {
        return view('livewire.about');
    }
}
