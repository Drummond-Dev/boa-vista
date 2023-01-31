<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Models\ConstructionWaste;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ConstructionWasteResource\Pages;
use App\Filament\Resources\ConstructionWasteResource\RelationManagers;

class ConstructionWasteResource extends Resource
{
    protected static ?string $model = ConstructionWaste::class;

    public static ?string $label = 'Resíduo Const. Civil';
    public static ?string $pluralLabel = 'Resíduos Const. Civil';
    protected static ?string $navigationGroup = 'Canal do Cidadão';
    protected static ?int $navigationSort = 7;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

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
            'index' => Pages\ListConstructionWastes::route('/'),
            'create' => Pages\CreateConstructionWaste::route('/create'),
            'edit' => Pages\EditConstructionWaste::route('/{record}/edit'),
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
