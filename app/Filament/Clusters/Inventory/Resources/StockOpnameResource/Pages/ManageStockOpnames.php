<?php

namespace App\Filament\Clusters\Inventory\Resources\StockOpnameResource\Pages;

use App\Filament\Clusters\Inventory\Resources\StockOpnameResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageStockOpnames extends ManageRecords
{
    protected static string $resource = StockOpnameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return "Opname Stok";
    }
}
