<?php

namespace App\Filament\Clusters\Product\Resources;

use App\Filament\Clusters\Product;
use App\Filament\Clusters\Product\Resources\SpecificationResource\Pages;
use App\Filament\Clusters\Product\Resources\SpecificationResource\RelationManagers;
use App\Models\Catalog\Specification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Pages\SubNavigationPosition;

class SpecificationResource extends Resource
{
    protected static ?string $model = Specification::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Product::class;

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Spesifikasi';
    protected static ?string $slug = 'spesifikasi';
    protected static ?int $navigationSort = 4;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::TopBar;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Spesifikasi')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ManageSpecifications::route('/'),
        ];
    }
}
