<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TaskInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                ImageEntry::make('image_path')
                    ->disk('public')
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('priority'),
                TextEntry::make('due_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('assignedUser.name')
                    ->label('Assigned User')
                    ->placeholder('-'),
                TextEntry::make('project.name')
                    ->label('Project'),
                TextEntry::make('creator.name')
                    ->label('Created By'),
                TextEntry::make('updater.name')
                    ->label('Updated By'),
                TextEntry::make('category.name')
                    ->label('Category'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
