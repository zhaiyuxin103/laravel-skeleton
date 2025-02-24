<nav x-data="{ open: false }" class="border-b border-gray-100 bg-white">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link
                        href="{{ route('dashboard') }}"
                        :active="request()->routeIs('dashboard')"
                    >
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:ms-6 sm:flex sm:items-center">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <x-mary-dropdown>
                        <x-slot:trigger>
                            <span class="inline-flex rounded-md">
                                <button
                                    type="button"
                                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50"
                                >
                                    {{ Auth::user()->currentTeam->name }}

                                    <x-mary-icon
                                        name="o-chevron-up-down"
                                        class="-me-0.5 ms-2 h-4 w-4"
                                    ></x-mary-icon>
                                </button>
                            </span>
                        </x-slot>

                        <!-- Team Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>

                        <!-- Team Settings -->
                        <x-mary-menu-item
                            title="{{ __('Team Settings') }}"
                            @click.stop="Livewire.navigate('{{ route('teams.show', Auth::user()->currentTeam->id) }}')"
                        ></x-mary-menu-item>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-mary-menu-item
                                title="{{ __('Create New Team') }}"
                                @click.stop="Livewire.navigate('{{ route('teams.create') }}')"
                            ></x-mary-menu-item>
                        @endcan

                        <!-- Team Switcher -->
                        @if (Auth::user()->allTeams()->count() > 1)
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team
                                    :team="$team"
                                    component="mary-menu-item"
                                />
                            @endforeach
                        @endif
                    </x-mary-dropdown>
                @endif

                @livewire('components.switchable-locale')

                <!-- Settings Dropdown -->
                <x-mary-dropdown>
                    <x-slot:trigger>
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex rounded-full border-2 border-transparent text-sm transition focus:border-gray-300 focus:outline-none"
                            >
                                <img
                                    class="h-8 w-8 rounded-full object-cover"
                                    src="{{ Auth::user()->getFirstMediaUrl('avatar') }}"
                                    alt="{{ Auth::user()->name }}"
                                />
                            </button>
                        @else
                            <span class="inline-flex rounded-md">
                                <button
                                    type="button"
                                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50"
                                >
                                    {{ Auth::user()->name }}

                                    <x-mary-icon
                                        name="o-chevron-down"
                                        class="-me-0.5 ms-2 h-4 w-4"
                                    ></x-mary-icon>
                                </button>
                            </span>
                        @endif
                    </x-slot>

                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Account') }}
                    </div>

                    <x-mary-menu-item
                        title="{{ __('Profile') }}"
                        @click.stop="Livewire.navigate('{{ route('profile.show') }}')"
                    ></x-mary-menu-item>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-mary-menu-item
                            title="{{ __('API Tokens') }}"
                            @click.stop="Livewire.navigate('{{ route('api-tokens.index') }}')"
                        ></x-mary-menu-item>
                    @endif

                    <div class="border-t border-gray-200"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-mary-menu-item
                            title="{{ __('Log Out') }}"
                            @click.prevent="$root.submit();"
                        ></x-mary-menu-item>
                    </form>
                </x-mary-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                >
                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            :class="{'hidden': open, 'inline-flex': ! open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                        <path
                            :class="{'hidden': ! open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="space-y-1 pb-3 pt-2">
            <x-responsive-nav-link
                href="{{ route('dashboard') }}"
                :active="request()->routeIs('dashboard')"
            >
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="border-t border-gray-200 pb-1 pt-4">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="me-3 shrink-0">
                        <img
                            class="h-10 w-10 rounded-full object-cover"
                            src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}"
                        />
                    </div>
                @endif

                <div>
                    <div class="text-base font-medium text-gray-800">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="text-sm font-medium text-gray-500">
                        {{ Auth::user()->email }}
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link
                    href="{{ route('profile.show') }}"
                    :active="request()->routeIs('profile.show')"
                >
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link
                        href="{{ route('api-tokens.index') }}"
                        :active="request()->routeIs('api-tokens.index')"
                    >
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link
                        href="{{ route('logout') }}"
                        @click.prevent="$root.submit();"
                    >
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link
                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')"
                    >
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link
                            href="{{ route('teams.create') }}"
                            :active="request()->routeIs('teams.create')"
                        >
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team
                                :team="$team"
                                component="responsive-nav-link"
                            />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
