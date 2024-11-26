<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Livewire\Component;
use Illuminate\View\View;

class Impersonating extends Component
{
    public function render(): View
    {
        return view('livewire.components.impersonating');
    }
}
