<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Campaign;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CampaignResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CampaignResource\RelationManagers;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    public static ?string $label = 'Campanha';
    public static ?string $pluralLabel = 'Campanhas';
    protected static ?string $navigationGroup = 'Canal do Cidadão';
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-annotation';

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
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Repeater::make('image')
                            ->label('Imagens do carrossel')
                            ->createItemButtonLabel('Adicionar nova imagem')
                            ->relationship('medias')
                            ->schema([
                                Forms\Components\FileUpload::make('name')
                                    ->label('Imagem')
                                    ->directory('campaigns')
                                    ->image()
                                    ->required()
                                    ->enableOpen()
                                    ->columnSpan(2),
                            ])
                            ->defaultItems(2)
                            ->columnSpanFull()
                            ->helperText('_É necessário ter duas ou mais imagens no carrossel._')
                    ]),
                Forms\Components\TextInput::make('sort_order')
                    ->default(1)
                    ->numeric()
                    ->required()
                    ->maxLength(255)
                    ->helperText('_Ordem do carrossel na página._'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->toggleable()
                    ->words(10)
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Ordem')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('medias_count')
                    ->label('Nº de Imagens')
                    ->counts('medias')
                    ->toggleable()
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
            'index' => Pages\ListCampaigns::route('/'),
            'create' => Pages\CreateCampaign::route('/create'),
            'edit' => Pages\EditCampaign::route('/{record}/edit'),
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
