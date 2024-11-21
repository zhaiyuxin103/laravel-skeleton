<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Illuminate\View\View;
use Livewire\Component;

class Impersonating extends Component
{
    public function render(): View
    {
        return view('livewire.components.impersonating');
    }
}
