<?php

namespace App\Filament\Fabricator\PageBlocks;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\MarkdownEditor;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;
use Awcodes\Curator\Components\Forms\CuratorPicker;

class CardTopImageWithButton extends PageBlock
{
    public static function getBlockSchema(): Block
    {
        return Block::make('card-top-image-with-button')
            ->label('Card (com Imagem e Botão)')
            ->schema([
                Repeater::make('items')
                    ->schema([
                        CuratorPicker::make('image')
                            ->preserveFilenames()
                            ->directory('card')
                            ->required(),
                        TextInput::make('title')
                            ->label('Título')
                            ->required(),
                        MarkdownEditor::make('text')
                            ->label('Texto')
                            ->disableAllToolbarButtons()
                            ->required(),
                        TextInput::make('button_text')
                            ->label('Texto do Botão')
                            ->required(),
                        TextInput::make('button_link')
                            ->label('Link')
                            ->url()
                            ->prefix('https://')
                            ->required(),
                    ])
                    ->defaultItems(1)
                    ->columnSpanFull()
            ]);
    }

    public static function mutateData(array $data): array
    {
        return $data;
    }
}
