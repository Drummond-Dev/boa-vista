<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\WasteManagement;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\WasteManagementResource\Pages;
use App\Filament\Resources\WasteManagementResource\RelationManagers;
use Closure;

class WasteManagementResource extends Resource
{
    protected static ?string $model = WasteManagement::class;

    public static ?string $label = 'Gestão de Resíduo';
    public static ?string $pluralLabel = 'Gestão de Resíduos';
    protected static ?string $navigationGroup = 'Canal do Cidadão';
    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle';

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
                Forms\Components\FileUpload::make('image')
                    ->label('Imagem')
                    ->image()
                    ->preserveFilenames()
                    ->directory('waste')
                    ->enableOpen()
                    ->helperText('_Só são permitidos imagens._'),
                Forms\Components\FileUpload::make('icon')
                    ->label('Ícone')
                    ->required()
                    ->acceptedFileTypes(['image/svg+xml'])
                    ->preserveFilenames()
                    ->directory('icons')
                    ->enableOpen()
                    ->helperText('_Só são permitidos arquivos SVG._'),
                Forms\Components\MarkdownEditor::make('text')
                    ->label('Texto')
                    ->required()
                    ->disableToolbarButtons(['codeBlock', 'attachFiles', 'link', 'strike'])
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Ordem')
                    ->required()
                    ->numeric()
                    ->integer()
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('icon')
                    ->label('Ícones')
                    ->toggleable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagens')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Títulos')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Ordem')
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
            'index' => Pages\ListWasteManagement::route('/'),
            'create' => Pages\CreateWasteManagement::route('/create'),
            'edit' => Pages\EditWasteManagement::route('/{record}/edit'),
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
