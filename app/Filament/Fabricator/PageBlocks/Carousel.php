<?php

namespace App\Filament\Fabricator\PageBlocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;

class Carousel extends PageBlock
{
    public static function getBlockSchema(): Block
    {
        return Block::make('carousel')
            ->label('Carrossel')
            ->schema([
                Repeater::make('items')
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        TextInput::make('link')
                            ->label('Link')
                            ->url()
                            ->prefix('https://')
                            ->required(),
                        CuratorPicker::make('image')
                            ->preserveFilenames()
                            ->directory('carousel')
                            ->required(),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                    ->defaultItems(3)
                    ->columnSpanFull()
                    ->collapsible()
            ]);
    }

    public static function mutateData(array $data): array
    {
        return $data;
    }
}
