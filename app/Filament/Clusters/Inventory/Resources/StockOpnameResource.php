<?php

namespace App\Filament\Clusters\Inventory\Resources;

use App\Filament\Clusters\Inventory;
use App\Filament\Clusters\Inventory\Resources\StockOpnameResource\Pages;
use App\Filament\Clusters\Inventory\Resources\StockOpnameResource\RelationManagers;
use App\Models\Inventory\Stock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Pages\SubNavigationPosition;


class StockOpnameResource extends Resource
{
    protected static ?string $model = Stock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Inventory::class;

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Stok Opname';
    protected static ?string $slug = 'stockopname';
    protected static ?int $navigationSort = 3;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::TopBar;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageStockOpnames::route('/'),
        ];
    }
}
