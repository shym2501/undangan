<?php

namespace App\Filament\Clusters\Product\Resources\SpecificationResource\Pages;

use App\Filament\Clusters\Product\Resources\SpecificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSpecifications extends ManageRecords
{
    protected static string $resource = SpecificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return "Spesifikasi";
    }
}
