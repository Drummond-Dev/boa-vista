<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\RolesRelationManager;
use Filament\Tables\Filters\TrashedFilter;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static ?string $label = 'Usuário';
    public static ?string $pluralLabel = 'Usuários';
    protected static ?string $navigationGroup = 'Administrativo';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_admin')
                    ->onIcon('heroicon-s-lightning-bolt')
                    ->offIcon('heroicon-s-user')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(static fn (null|string $state): null|string => filled($state) ?  Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(static fn (Page $livewire): string => $livewire instanceof CreateUser)
                    ->label(static fn (Page $livewire): string => ($livewire instanceof EditUser) ? 'Nova Senha' : 'Senha')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('profile_photo_path')
                    ->label('Sua foto')
                    ->directory('user')
                    ->image(),
                Forms\Components\CheckboxList::make('roles')
                    ->required()
                    ->relationship('roles', 'name')
                    ->columns(2)
                    ->helperText('Escolha somente uma das opções.')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_photo_path')
                    ->label('Foto')
                    ->toggleable()
                    ->width(50)
                    ->height(50),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nomes')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_admin')
                    ->label('Admin')
                    ->toggleable()
                    ->sortable()
                    ->searchable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Regras')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Excluído em:')
                    ->toggleable()
                    ->dateTime('d-M-Y')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em:')
                    ->toggleable()
                    ->dateTime('d-M-Y')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                TrashedFilter::make(),
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
            RolesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
