<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class CustomerData extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Customer Data';
    protected static ?string $navigationLabel = 'Customer';
    protected static ?string $slug = 'customer';
    protected static ?int $navigationSort = 1;
}
