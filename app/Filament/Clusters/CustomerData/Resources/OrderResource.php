<?php

namespace App\Filament\Clusters\CustomerData\Resources;

use App\Filament\Clusters\CustomerData;
use App\Filament\Clusters\CustomerData\Resources\OrderResource\Pages;
use App\Filament\Clusters\CustomerData\Resources\OrderResource\RelationManagers;
use App\Models\CustomerData\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Pages\SubNavigationPosition;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Order';
    protected static ?string $slug = 'order';
    protected static ?int $navigationSort = 2;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::TopBar;

    protected static ?string $cluster = CustomerData::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Grid::make(['default' => 1])->schema([
                        Forms\Components\Select::make('order_id')
                            ->label('Customer Name')
                            ->required()
                            ->relationship('orders', 'customer.name') // Menggunakan relasi customer dan menampilkan nama
                            ->searchable()
                            ->preload()
                            ->native(false),
                    ]),
                ]),
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
            'index' => Pages\ManageOrders::route('/'),
        ];
    }
}
