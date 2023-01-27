<?php

namespace App\Filament\Resources;

use App\Models\Law;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LawResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LawResource\RelationManagers;

class LawResource extends Resource
{
    protected static ?string $model = Law::class;

    public static ?string $label = 'Lei';
    public static ?string $pluralLabel = 'Leis';
    protected static ?string $navigationGroup = 'Leis e Legislações';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

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
                Forms\Components\MarkdownEditor::make('text')
                    ->label('Texto')
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
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
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
            'index' => Pages\ListLaws::route('/'),
            'create' => Pages\CreateLaw::route('/create'),
            'edit' => Pages\EditLaw::route('/{record}/edit'),
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
