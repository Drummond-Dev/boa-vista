<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Newspaper;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\NewspaperResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NewspaperResource\RelationManagers;
use App\Models\Category;
use Filament\Tables\Filters\SelectFilter;

class NewspaperResource extends Resource
{
    protected static ?string $model = Newspaper::class;

    public static ?string $label = 'Notícia';
    public static ?string $pluralLabel = 'Notícias';
    protected static ?string $navigationGroup = 'Notícias';
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

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
                Forms\Components\TextInput::make('author')
                    ->label('Autor')
                    ->default(auth()->user()->name)
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('categories_id')
                    ->label('Categoria')
                    ->required()
                    ->relationship('categories', 'name')
                    ->preload(),
                Forms\Components\FileUpload::make('image')
                    ->label('Imagem de Capa')
                    ->directory('newspaper')
                    ->image()
                    ->required()
                    ->columnSpan(2)
                    ->helperText('_Imagem principal da notícia, essa imagem irá aparecer no topo da página da notícia e também no card na página principal das notícias._'),
                Forms\Components\Textarea::make('resume')
                    ->label('Resumo')
                    ->required()
                    ->minLength(20)
                    ->maxLength(255)
                    ->columnSpan(2)
                    ->helperText('_O resumo da notícia irá aparecer nos cards na página princial das notícias._'),
                Forms\Components\MarkdownEditor::make('body')
                    ->label('Notícia')
                    ->required()
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('newspaper')
                    ->disableToolbarButtons(['codeBlock'])
                    ->columnSpan(2)
                    ->helperText('_Pode iserir imagens entre os parágrafos, basta arrastar a imagem do computador para o local onde quer que a imagem fique._'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagem')
                    ->width(50)
                    ->height(50),
                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Categorias')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->words(10)
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('resume')
                    ->label('Resumo')
                    ->words(20)
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('author')
                    ->label('Autor')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('categories_id')
                    ->label('Categorias')
                    ->multiple()
                    ->options(Category::query()->pluck('name', 'id'))

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
            'index' => Pages\ListNewspapers::route('/'),
            'create' => Pages\CreateNewspaper::route('/create'),
            'edit' => Pages\EditNewspaper::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'categories.name', 'author'];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
