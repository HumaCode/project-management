<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel(),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
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
            ]);
    }
}
