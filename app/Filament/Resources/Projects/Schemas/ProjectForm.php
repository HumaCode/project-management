<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                DateTimePicker::make('start_date'),
                DateTimePicker::make('end_date'),
                FileUpload::make('image_path')
                    ->image()
                    ->disk('public')
                    ->preserveFilenames()
                    ->downloadable()
                    ->directory('projects')
                    ->openable(),
                ToggleButtons::make('status')
                    ->options([
                        'pending'       => 'Pending',
                        'on_hold'       => 'On Hold',
                        'in_progress'   => 'In Progress',
                        'completed'     => 'Completed',
                        'cancelled'     => 'Cancelled',
                    ])
                    ->grouped()
                    ->required()
                    ->default('pending'),
                Select::make('created_by')
                    ->relationship('creator', 'name')
                    ->searchable()
                    ->preload()
                    ->disabled()
                    ->dehydrated(true)
                    ->default(Auth::user()->id)
                    ->required(),
                Select::make('updated_by')
                    ->relationship('updater', 'name')
                    ->searchable()
                    ->default(Auth::user()->id)
                    ->preload()
                    ->dehydrated(true)
                    ->disabled()
                    ->required(),
                Select::make('client_id')
                    ->relationship('client', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
