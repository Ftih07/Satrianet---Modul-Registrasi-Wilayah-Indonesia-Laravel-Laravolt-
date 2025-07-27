<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;

class ChangePassword extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static string $view = 'filament.pages.change-password';
    protected static ?string $title = 'Ganti Password';
    protected static ?string $navigationGroup = 'Pengaturan';

    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('current_password')
                ->password()
                ->label('Password Sekarang')
                ->required(),

            Forms\Components\TextInput::make('new_password')
                ->password()
                ->label('Password Baru')
                ->rules(['nullable', 'min:8']),

            Forms\Components\TextInput::make('new_password_confirmation')
                ->password()
                ->label('Konfirmasi Password Baru')
                ->same('new_password'),
        ];
    }

    public function changePassword()
    {
        $user = auth()->user();

        // Cek password sekarang
        if (! Hash::check($this->current_password, $user->password)) {
            Notification::make()
                ->title('Password sekarang salah!')
                ->danger()
                ->send();
            return;
        }

        if (filled($this->new_password)) {
            $data['password'] = bcrypt($this->new_password);
        }

        $user->update($data);

        // Logout otomatis setelah update
        auth()->logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('filament.admin.auth.login');
    }
}
