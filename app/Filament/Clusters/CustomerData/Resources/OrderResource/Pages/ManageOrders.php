<?php

namespace App\Filament\Clusters\CustomerData\Resources\OrderResource\Pages;

use App\Filament\Clusters\CustomerData\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOrders extends ManageRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
