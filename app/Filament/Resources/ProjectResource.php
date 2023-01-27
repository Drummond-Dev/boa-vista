<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Project;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProjectResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProjectResource\RelationManagers;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    public static ?string $label = 'Projeto';
    public static ?string $pluralLabel = 'Projetos';
    protected static ?string $navigationGroup = 'Canal do Cidadão';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

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
                Forms\Components\FileUpload::make('image')
                    ->label('Imagem de Capa')
                    ->directory('projects')
                    ->image()
                    ->required()
                    ->columnSpan(2)
                    ->helperText('_Imagem principal do projeto, essa imagem irá aparecer no topo da página e também no card na página principal._'),
                Forms\Components\Textarea::make('resume')
                    ->label('Resumo')
                    ->required()
                    ->minLength(20)
                    ->maxLength(255)
                    ->columnSpan(2)
                    ->helperText('_O resumo do projeto irá aparecer nos cards na página princial das projetos._'),
                Forms\Components\MarkdownEditor::make('body')
                    ->label('Notícia')
                    ->required()
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('projects')
                    ->disableToolbarButtons(['codeBlock'])
                    ->columnSpan(2)
                    ->helperText('_Pode iserir imagens entre os parágrafos. Basta arrastar a imagem do computador para o local onde quer que a imagem fique._'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagem')
                    ->toggleable()
                    ->width(50)
                    ->height(50),
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->toggleable()
                    ->words(10)
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('resume')
                    ->label('Resumo')
                    ->toggleable()
                    ->words(20)
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('author')
                    ->label('Autor')
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'author', 'body'];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
