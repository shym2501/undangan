<?php

namespace App\Filament\Clusters\Product\Resources\CategoryResource\Pages;

use App\Filament\Clusters\Product\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCategories extends ManageRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return "Kategori";
    }
}
