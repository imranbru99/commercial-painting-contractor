<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Operations';

    protected static ?string $navigationLabel = 'Jobs / Projects';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('job_number')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('customer_id')->relationship('customer', 'company_name')->searchable()->required(),
            Forms\Components\Select::make('assigned_to')->relationship('assignee', 'name')->searchable(),
            Forms\Components\TextInput::make('title')->required()->columnSpanFull(),
            Forms\Components\Textarea::make('description')->columnSpanFull(),
            Forms\Components\TextInput::make('site_address')->columnSpanFull(),
            Forms\Components\Select::make('status')->options([
                'estimate' => 'Estimate',
                'scheduled' => 'Scheduled',
                'in_progress' => 'In Progress',
                'punch' => 'Punch List',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
            ])->required(),
            Forms\Components\Select::make('priority')->options([
                'low' => 'Low',
                'normal' => 'Normal',
                'high' => 'High',
                'urgent' => 'Urgent',
            ])->required(),
            Forms\Components\DatePicker::make('start_date'),
            Forms\Components\DatePicker::make('due_date'),
            Forms\Components\TextInput::make('estimated_value')->numeric()->prefix('$'),
            Forms\Components\TextInput::make('actual_value')->numeric()->prefix('$'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('job_number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable()->limit(40),
                Tables\Columns\TextColumn::make('customer.company_name')->label('Customer'),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('priority')->badge(),
                Tables\Columns\TextColumn::make('estimated_value')->money('USD'),
                Tables\Columns\TextColumn::make('due_date')->date(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'estimate' => 'Estimate',
                    'scheduled' => 'Scheduled',
                    'in_progress' => 'In Progress',
                    'punch' => 'Punch List',
                    'completed' => 'Completed',
                ]),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
