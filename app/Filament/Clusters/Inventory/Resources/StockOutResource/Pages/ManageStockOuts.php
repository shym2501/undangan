<?php

namespace App\Filament\Clusters\Inventory\Resources\StockOutResource\Pages;

use App\Filament\Clusters\Inventory\Resources\StockOutResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageStockOuts extends ManageRecords
{
    protected static string $resource = StockOutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return "Stok Keluar";
    }
}
