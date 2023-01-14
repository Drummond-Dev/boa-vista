<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use App\Models\Staff;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    public static ?string $label = 'Contatos';
    protected static ?string $navigationGroup = 'Prefeitura';
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('staff_id')
                    ->label('Pessoa')
                    ->options(Staff::query()->pluck('name', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('phone1')
                    ->suffixIcon('heroicon-o-phone')
                    ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->pattern('(00) 00000-0000'))
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone2')
                    ->suffixIcon('heroicon-o-phone')
                    ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->pattern('(00) 00000-0000'))
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->suffixIcon('heroicon-s-mail')
                    ->email()
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->required()
                    ->maxLength(16777215),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('staff.name')
                    ->label('Nome'),
                Tables\Columns\TextColumn::make('phone1')
                    ->label('Telefone'),
                Tables\Columns\TextColumn::make('phone2')
                    ->label('Telefone'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('address')
                    ->label('Endereço')
                    ->words(10)
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
