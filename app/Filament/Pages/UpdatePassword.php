<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use Exception;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns;
use Filament\Pages\Page;
use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Js;
use Illuminate\Validation\Rules\Password;
use Throwable;

use function Filament\Support\is_app_url;

/**
 * @property ComponentContainer $form
 */
class UpdatePassword extends Page
{
    use Concerns\InteractsWithFormActions;

    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.update-password';

    protected static bool $shouldRegisterNavigation = false;

    public static function getLabel(): string
    {
        return trans('labels.update_password');
    }

    public function getTitle(): string|Htmlable
    {
        return static::getLabel();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('current_password')
                    ->password()
                    ->required()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->rule(Password::default())
                    ->placeholder(trans('placeholders.current_password'))
                    ->label(trans('fields.current_password')),
                // TODO: 校验新密码和旧密码是否相同
                Forms\Components\TextInput::make('password')
                    ->label(trans('fields.password'))
                    ->password()
                    ->required()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->rule(Password::default())
                    ->autocomplete('new-password')
                    ->dehydrated(fn ($state): bool => filled($state))
                    ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                    ->live(debounce: 500)
                    ->placeholder(trans('placeholders.new_password'))
                    ->same('password_confirmation'),
                Forms\Components\TextInput::make('password_confirmation')
                    ->label(trans('fields.password_confirmation'))
                    ->password()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->required()
                    ->placeholder(trans('placeholders.password_confirmation'))
                    ->dehydrated(false),
            ])
            ->operation('edit')
            ->statePath('data');
    }

    public function getCancelFormAction(): Action
    {
        return Action::make('back')
            ->label(__('filament-panels::pages/auth/edit-profile.actions.cancel.label'))
            ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = ' . Js::from(filament()->getUrl()) . ')')
            ->color('gray');
    }

    /**
     * @throws Exception
     */
    public function getUser(): Authenticatable&Model
    {
        $user = Filament::auth()->user();
        if (! $user instanceof Model) {
            throw new Exception('The authenticated user object must be an Eloquent model to allow the profile page to update it.');
        }

        return $user;
    }

    /**
     * @throws Throwable
     */
    public function save(): void
    {
        $data = $this->form->getState();
        $this->handleRecordUpdate($this->getUser(), $data);
        if (request()->hasSession() && array_key_exists('password', $data)) {
            request()->session()->put([
                'password_hash_' . Filament::getAuthGuard() => $data['password'],
            ]);
        }
        $this->data['current_password']      = null;
        $this->data['password']              = null;
        $this->data['password_confirmation'] = null;
        $this->getSavedNotification()?->send();
        if ($redirectUrl = $this->getRedirectUrl()) {
            $this->redirect($redirectUrl, navigate: FilamentView::hasSpaMode() && is_app_url($redirectUrl));
        }
    }

    protected function getRedirectUrl(): ?string
    {
        return null;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        return $record;
    }

    protected function getSavedNotification(): ?Notification
    {
        $title = $this->getSavedNotificationTitle();
        if (blank($title)) {
            return null;
        }

        return Notification::make()
            ->success()
            ->title($this->getSavedNotificationTitle());
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return __('filament-panels::pages/auth/edit-profile.notifications.saved.title');
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
            $this->getCancelFormAction(),
        ];
    }

    protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label(__('filament-panels::pages/auth/edit-profile.form.actions.save.label'))
            ->submit('save')
            ->keyBindings(['mod+s']);
    }
}
