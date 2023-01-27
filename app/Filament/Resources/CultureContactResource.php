<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\CultureContact;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CultureContactResource\Pages;
use App\Filament\Resources\CultureContactResource\RelationManagers;

class CultureContactResource extends Resource
{
    protected static ?string $model = CultureContact::class;

    public static ?string $label = 'Contato Cultura';
    public static ?string $pluralLabel = 'Contatos Cultura';
    protected static ?string $navigationGroup = 'Cultura';
    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('address')
                    ->required()
                    ->disableToolbarButtons(['codeBlock', 'attachFiles', 'link', 'strike'])
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('cep')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->default('Boa Vista')
                    ->maxLength(255),
                Forms\Components\TextInput::make('state')
                    ->required()
                    ->default('Roraima')
                    ->maxLength(255),
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
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefone')
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
            'index' => Pages\ListCultureContacts::route('/'),
            'create' => Pages\CreateCultureContact::route('/create'),
            'edit' => Pages\EditCultureContact::route('/{record}/edit'),
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
