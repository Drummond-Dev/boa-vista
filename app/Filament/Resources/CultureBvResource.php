<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\CultureBv;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CultureBvResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CultureBvResource\RelationManagers;

class CultureBvResource extends Resource
{
    protected static ?string $model = CultureBv::class;

    public static ?string $label = 'Cultura BV';
    public static ?string $pluralLabel = 'Cultura BV';
    protected static ?string $navigationGroup = 'Cultura';
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
                    ->required(),
                Forms\Components\MarkdownEditor::make('text')
                    ->required()
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('culture')
                    ->disableToolbarButtons(['codeBlock'])
                    ->columnSpanFull()
                    ->helperText('_Pode iserir imagens entre os parágrafos, basta arrastar a imagem do computador para o local onde quer que a imagem fique._'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('text')
                    ->label('Texto')
                    ->toggleable()
                    ->words(10),
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
            'index' => Pages\ListCultureBvs::route('/'),
            'create' => Pages\CreateCultureBv::route('/create'),
            'edit' => Pages\EditCultureBv::route('/{record}/edit'),
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
