<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Models\HealthServicesWaste;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\HealthServicesWasteResource\Pages;
use App\Filament\Resources\HealthServicesWasteResource\RelationManagers;

class HealthServicesWasteResource extends Resource
{
    protected static ?string $model = HealthServicesWaste::class;

    public static ?string $label = 'Resíduo de Serviço de Saúde';
    public static ?string $pluralLabel = 'Resíduos de Serviços de Saúde';
    protected static ?string $navigationGroup = 'Canal do Cidadão';
    protected static ?int $navigationSort = 8;

    protected static ?string $navigationIcon = 'far-hospital';

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
                    ->label('Texto')
                    ->required()
                    ->disableToolbarButtons(['codeBlock', 'attachFiles', 'link', 'strike'])
                    ->columnSpanFull(),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Repeater::make('file')
                            ->label('Arquivos')
                            ->createItemButtonLabel('Adicionar novo arquivo')
                            ->relationship('medias')
                            ->schema([
                                Forms\Components\TextInput::make('file_name')
                                    ->label('Título')
                                    ->required()
                                    ->columnSpan(2)
                                    ->maxLength(255),
                                Forms\Components\FileUpload::make('file')
                                    ->label('Arquivo')
                                    ->directory('pdf')
                                    ->acceptedFileTypes([
                                        'application/pdf',
                                        'application/msword',
                                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                        'application/vnd.ms-excel',
                                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                                    ])
                                    ->preserveFilenames()
                                    ->enableOpen()
                                    ->required()
                                    ->columnSpan(2)
                                    ->helperText('_Só são permitidos arquivos com a extensão PDF, Doc e XLS._'),
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
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->toggleable()
                    ->words(10)
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('medias_count')
                    ->label('Nº de Arquivos')
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
            'index' => Pages\ListHealthServicesWastes::route('/'),
            'create' => Pages\CreateHealthServicesWaste::route('/create'),
            'edit' => Pages\EditHealthServicesWaste::route('/{record}/edit'),
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
