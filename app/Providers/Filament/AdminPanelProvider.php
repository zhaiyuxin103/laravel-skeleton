<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\Pages\EditProfile;
use App\Models\Admin;
use DutchCodingCompany\FilamentDeveloperLogins\Exceptions\ImplementationException;
use DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin;
use Filament\Forms;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use RalphJSmit\Livewire\Urls\Middleware\LivewireUrlsMiddleware;
use Stephenjude\FilamentDebugger\DebuggerPlugin;
use Stephenjude\FilamentFeatureFlag\FeatureFlagPlugin;

class AdminPanelProvider extends PanelProvider
{
    /**
     * @throws ImplementationException
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->domain(config('admin.domain'))
            ->path(config('admin.path'))
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                LivewireUrlsMiddleware::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                FilamentDeveloperLoginsPlugin::make()
                    ->enabled(app()->isLocal())
                    ->switchable(true)
                    ->users([
                        'Super Admin' => 'zhaiyuxin103@hotmail.com',
                        'Admin'       => 'zhaiyuxin103@gmail.com',
                    ])
                    ->modelClass(Admin::class),
                DebuggerPlugin::make()
                    ->navigationGroup(label: trans('labels.debuggers')),
                FeatureFlagPlugin::make(),
            ])
            ->authGuard('admin')
            ->profile(EditProfile::class, isSimple: false)
            ->darkMode(false);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Forms\Components\Toggle::configureUsing(function (Forms\Components\Toggle $toggle): void {
            $toggle->inline(false);
        });
        Forms\Components\Select::configureUsing(function (Forms\Components\Select $select): void {
            $select->native(false);
        });
        Forms\Components\DatePicker::configureUsing(function (Forms\Components\DatePicker $datePicker): void {
            $datePicker->native(false);
        });
        Forms\Components\TimePicker::configureUsing(function (Forms\Components\TimePicker $timePicker): void {
            $timePicker->native(false);
        });
        Forms\Components\DateTimePicker::configureUsing(function (Forms\Components\DateTimePicker $dateTimePicker): void {
            $dateTimePicker->native(false);
        });
    }
}
