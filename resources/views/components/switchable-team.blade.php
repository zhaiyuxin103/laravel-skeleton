@props([
    'team',
    'component' => 'dropdown-link',
])

<form method="POST" action="{{ route('current-team.update') }}" x-data>
    @method('PUT')
    @csrf

    <!-- Hidden Team ID -->
    <input type="hidden" name="team_id" value="{{ $team->id }}" />

    <x-dynamic-component
        :component="$component"
        href="#"
        x-on:click.prevent="$root.submit();"
    >
        <div class="flex items-center">
            @if (Auth::user()->isCurrentTeam($team))
                <x-mary-icon
                    name="o-check-circle"
                    class="me-2 h-5 w-5 text-green-400"
                ></x-mary-icon>
            @endif

            <div class="truncate">{{ $team->name }}</div>
        </div>
    </x-dynamic-component>
</form>
