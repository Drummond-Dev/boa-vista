<?php

namespace App\Filament\Fabricator\PageBlocks;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\MarkdownEditor;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;
use Awcodes\Curator\Components\Forms\CuratorPicker;

class CardLeftImageWithButton extends PageBlock
{
    public static function getBlockSchema(): Block
    {
        return Block::make('card-left-image-with-button')
            ->label('Card (com Imagem esquerda e Botão)')
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
                        TextInput::make('link')
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
