<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentTasks extends TableWidget
{
    use HasWidgetShield;


    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Task::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('description')
                    // ->limit(50)
                    ->words(10)
                    ->searchable(),
                ImageColumn::make('image_path')
                    ->disk('public'),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('priority')
                    ->badge()
                    ->searchable(),
                TextColumn::make('due_date')
                    ->date(),
                TextColumn::make('assignedUser.name')
                    ->searchable(),
                TextColumn::make('project.name')
                    ->searchable() ,
                TextColumn::make('creator.name')
                    ->searchable(),
                TextColumn::make('updater.name')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
