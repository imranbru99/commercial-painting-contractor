<?php

namespace App\Filament\Pages;

use App\Services\AiService;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AiStudio extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static string $view = 'filament.pages.ai-studio';

    protected static ?string $navigationGroup = 'AI Tools';

    protected static ?string $navigationLabel = 'AI Studio';

    protected static ?string $title = 'AI Content & Automation Studio';

    public ?array $data = [];

    public string $output = '';

    public function mount(): void
    {
        $this->form->fill([
            'mode' => 'blog',
            'prompt' => '',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mode')->options([
                    'blog' => 'Blog / KB draft',
                    'description' => 'Service description',
                    'automation' => 'Automation suggestions',
                    'troubleshoot' => 'ERP troubleshooting',
                ])->required(),
                Forms\Components\Textarea::make('prompt')->required()->rows(6)->label('Prompt'),
            ])
            ->statePath('data');
    }

    public function generate(AiService $ai): void
    {
        $state = $this->form->getState();
        $this->output = $ai->generate($state['prompt'], $state['mode']);
        Notification::make()->title('AI response ready')->success()->send();
    }
}
