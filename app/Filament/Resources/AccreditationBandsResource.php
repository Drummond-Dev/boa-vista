<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Models\AccreditationBands;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AccreditationBandsResource\Pages;
use App\Filament\Resources\AccreditationBandsResource\RelationManagers;

class AccreditationBandsResource extends Resource
{
    protected static ?string $model = AccreditationBands::class;

    public static ?string $label = 'Credenciamento de Banda';
    public static ?string $pluralLabel = 'Credenciamento de Bandas';
    protected static ?string $navigationGroup = 'Cultura';
    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-volume-up';

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
                Forms\Components\FileUpload::make('file')
                    ->label('Documento')
                    ->directory('accreditations')
                    ->acceptedFileTypes(['zip', 'application/zip', 'application/x-zip', 'application/x-zip-compressed', 'rar', 'application/x-rar-compressed', 'application/pdf'])
                    ->preserveFilenames()
                    ->required()
                    ->columnSpan(2)
                    ->helperText('Só são permitidos arquivos com a extensão Zip e PDF.'),
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
            'index' => Pages\ListAccreditationBands::route('/'),
            'create' => Pages\CreateAccreditationBands::route('/create'),
            'edit' => Pages\EditAccreditationBands::route('/{record}/edit'),
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
