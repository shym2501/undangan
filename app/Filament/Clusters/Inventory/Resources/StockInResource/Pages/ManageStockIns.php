<?php

namespace App\Filament\Clusters\Inventory\Resources\StockInResource\Pages;

use App\Filament\Clusters\Inventory\Resources\StockInResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageStockIns extends ManageRecords
{
    protected static string $resource = StockInResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return "Stok Masuk";
    }
}
