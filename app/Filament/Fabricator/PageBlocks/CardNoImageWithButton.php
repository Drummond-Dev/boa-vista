<?php

namespace App\Filament\Fabricator\PageBlocks;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;

class CardNoImageWithButton extends PageBlock
{
    public static function getBlockSchema(): Block
    {
        return Block::make('card-no-image-with-button')
            ->label('Card (com botão)')
            ->schema([
                Repeater::make('items')
                    ->schema([
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
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                    ->defaultItems(1)
                    ->columnSpanFull()
                    ->collapsible()
            ]);
    }

    public static function mutateData(array $data): array
    {
        return $data;
    }
}
