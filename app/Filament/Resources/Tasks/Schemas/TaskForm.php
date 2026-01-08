<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                FileUpload::make('image_path')
                    ->disk('public')
                    ->preserveFilenames()
                    ->downloadable()
                    ->openable()
                    ->directory('tasks')
                    ->image(),
                ToggleButtons::make('status')
                    ->options([
                        'pending'       => 'Pending',
                        'on_hold'       => 'On Hold',
                        'in_progress'   => 'In Progress',
                        'completed'     => 'Completed',
                        'cancelled'     => 'Cancelled',
                    ])
                    ->colors([
                        'pending'       => 'secondary',
                        'on_hold'       => 'warning',
                        'in_progress'   => 'info',
                        'completed'     => 'success',
                        'cancelled'     => 'danger',
                    ])
                    ->grouped()
                    ->required()
                    ->default('pending'),
                ToggleButtons::make('priority')
                    ->options([
                        'low'       => 'Low',
                        'medium'    => 'Medium',
                        'high'      => 'High',
                    ])
                    ->colors([
                        'low'       => 'success',
                        'medium'    => 'warning',
                        'high'      => 'danger',
                    ])
                    ->icons([
                        'low'       => Heroicon::OutlinedPencil,
                        'medium'    => Heroicon::OutlinedClock,
                        'high'      => Heroicon::OutlinedCheckCircle,
                    ])
                    ->grouped()
                    ->required()
                    ->default('medium'),
                DatePicker::make('due_date'),
                Select::make('assigned_user_id')
                    ->relationship('assignedUser', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('project_id')
                    ->required()
                    ->relationship('project', 'name')
                    ->searchable()
                    ->preload(),
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
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
