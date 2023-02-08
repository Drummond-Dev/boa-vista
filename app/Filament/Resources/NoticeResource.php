<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Notice;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\NoticeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NoticeResource\RelationManagers;

class NoticeResource extends Resource
{
    protected static ?string $model = Notice::class;

    public static ?string $label = 'Edital';
    public static ?string $pluralLabel = 'Editais';
    protected static ?string $navigationGroup = 'Cultura';
    protected static ?int $navigationSort = 6;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

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
                    ->disableToolbarButtons(['codeBlock', 'attachFiles', 'link', 'strike'])
                    ->columnSpanFull(),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Repeater::make('file')
                            ->label('Documentos')
                            ->createItemButtonLabel('Adicionar novo documento')
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
                                    ])
                                    ->preserveFilenames()
                                    ->required()
                                    ->columnSpan(2)
                                    ->enableOpen()
                                    ->helperText('_Só são permitidos arquivos com a extensão PDF e Doc._'),
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
            'index' => Pages\ListNotices::route('/'),
            'create' => Pages\CreateNotice::route('/create'),
            'edit' => Pages\EditNotice::route('/{record}/edit'),
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
