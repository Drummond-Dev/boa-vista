<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Models\WasteManagementPlan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\WasteManagementPlanResource\Pages;
use App\Filament\Resources\WasteManagementPlanResource\RelationManagers;

class WasteManagementPlanResource extends Resource
{
    protected static ?string $model = WasteManagementPlan::class;

    public static ?string $label = 'Plano de Gerenciamento de Resíduo';
    public static ?string $pluralLabel = 'Plano de Gerenciamento de Resíduos';
    protected static ?string $navigationGroup = 'Canal do Cidadão';
    protected static ?int $navigationSort = 9;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('text')
                    ->label('Texto')
                    ->required()
                    ->disableToolbarButtons(['codeBlock', 'attachFiles', 'link', 'strike'])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Títulos')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListWasteManagementPlans::route('/'),
            'create' => Pages\CreateWasteManagementPlan::route('/create'),
            'edit' => Pages\EditWasteManagementPlan::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title'];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
