<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use RalphJSmit\Livewire\Urls\Facades\Url;

class SwitchableLocale extends Component
{
    #[Computed]
    public function currentLocale(): string
    {
        return session('locale', config('app.locale'));
    }

    public function switchable(string $locale): void
    {
        session(['locale' => $locale]);

        $this->redirect(Url::current());
    }

    public function render(): View
    {
        return view('livewire.components.switchable-locale');
    }
}
