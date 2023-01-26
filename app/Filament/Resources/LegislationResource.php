<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Legislation;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LegislationResource\Pages;
use App\Filament\Resources\LegislationResource\RelationManagers;

class LegislationResource extends Resource
{
    protected static ?string $model = Legislation::class;

    public static ?string $label = 'Legislação';
    public static ?string $pluralLabel = 'Legislações';
    protected static ?string $navigationGroup = 'Leis e Legislações';
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-library';

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
                    ->disabled()
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('file')
                    ->required()
                    ->acceptedFileTypes(['application/pdf'])
                    ->preserveFilenames()
                    ->directory('pdf')
                    ->columnSpanFull()
                    ->helperText('_Só são permitidos arquivos PDF._'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Títulos')
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
            'index' => Pages\ListLegislations::route('/'),
            'create' => Pages\CreateLegislation::route('/create'),
            'edit' => Pages\EditLegislation::route('/{record}/edit'),
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
