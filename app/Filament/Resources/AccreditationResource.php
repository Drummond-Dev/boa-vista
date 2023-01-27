<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use App\Models\Accreditation;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AccreditationResource\Pages;
use App\Filament\Resources\AccreditationResource\RelationManagers;

class AccreditationResource extends Resource
{
    protected static ?string $model = Accreditation::class;

    public static ?string $label = 'Credenciamento Cultural';
    public static ?string $pluralLabel = 'Credenciamento Cultural';
    protected static ?string $navigationGroup = 'Cultura';
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

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
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Repeater::make('image')
                            ->label('Documentos')
                            ->createItemButtonLabel('Adicionar nova imagem')
                            ->relationship('medias')
                            ->schema([
                                Forms\Components\FileUpload::make('name')
                                    ->label('Documento')
                                    ->directory('accreditations')
                                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                                    ->required()
                                    ->columnSpan(2),
                            ])
                            ->defaultItems(1)
                            ->columnSpanFull()
                    ]),
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
            'index' => Pages\ListAccreditations::route('/'),
            'create' => Pages\CreateAccreditation::route('/create'),
            'edit' => Pages\EditAccreditation::route('/{record}/edit'),
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
