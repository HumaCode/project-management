<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentProjects extends TableWidget
{
    use HasWidgetShield;

    protected int | string | array $columnSpan = 'full';

    protected static ?int  $sort = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => Project::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),
                ImageColumn::make('image_path')
                    ->disk('public'),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('creator.name')
                    ->searchable(),
                TextColumn::make('updater.name')
                    ->searchable(),
                TextColumn::make('client.name')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
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
