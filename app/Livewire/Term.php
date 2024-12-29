<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Term as TermModel;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Term extends Component
{
    #[Computed]
    public function terms(): Collection
    {
        return TermModel::where('state', true)->get();
    }

    #[Layout('layouts.guest')]
    public function render(): View
    {
        return view('livewire.term');
    }
}
