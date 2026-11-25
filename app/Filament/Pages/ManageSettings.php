<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.manage-settings';

    protected static ?string $navigationGroup = 'Admin';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $title = 'Company Settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'company_name' => Setting::getValue('company_name', 'Ironspan Commercial Coatings'),
            'phone' => Setting::getValue('phone', '(713) 555-0148'),
            'email' => Setting::getValue('email', 'hello@ironspan.coatings'),
            'whatsapp' => Setting::getValue('whatsapp', '+17135550148'),
            'address' => Setting::getValue('address', '4200 Navigation Blvd, Houston, TX 77003'),
            'tax_rate' => Setting::getValue('tax_rate', '8.25'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('company_name')->required(),
                Forms\Components\TextInput::make('phone'),
                Forms\Components\TextInput::make('email')->email(),
                Forms\Components\TextInput::make('whatsapp'),
                Forms\Components\Textarea::make('address'),
                Forms\Components\TextInput::make('tax_rate')->numeric()->suffix('%'),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        foreach ($this->form->getState() as $key => $value) {
            Setting::setValue($key, $value);
        }

        Notification::make()->title('Settings saved')->success()->send();
    }
}
