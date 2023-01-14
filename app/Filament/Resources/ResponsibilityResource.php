<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResponsibilityResource\Pages;
use App\Filament\Resources\ResponsibilityResource\RelationManagers;
use App\Models\Responsibility;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResponsibilityResource extends Resource
{
    protected static ?string $model = Responsibility::class;

    public static ?string $label = 'Cargo';
    public static ?string $pluralLabel = 'Cargos';
    protected static ?string $navigationGroup = 'Prefeitura';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->onIcon('heroicon-s-eye')
                    ->offIcon('heroicon-s-eye-off'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Estado')
                    ->trueIcon('heroicon-o-eye')
                    ->falseIcon('heroicon-o-eye-off')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResponsibilities::route('/'),
            'create' => Pages\CreateResponsibility::route('/create'),
            'edit' => Pages\EditResponsibility::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
