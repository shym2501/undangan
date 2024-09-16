<?php

namespace App\Filament\Clusters\Product\Resources;

use App\Filament\Clusters\Product;
use App\Filament\Clusters\Product\Resources\ProductsResource\Pages;
use App\Filament\Clusters\Product\Resources\ProductsResource\RelationManagers;
use App\Filament\Exports\ProductExporter;
use App\Filament\Imports\ProductImporter;
use App\Models\Catalog\Products;
use App\Models\Catalog\Category;
use App\Models\Catalog\Unit;
use App\Models\Catalog\Brand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;

class ProductsResource extends Resource
{
    protected static ?string $model = Products::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $cluster = Product::class;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Produk';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::TopBar;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                        if ($operation !== 'create') {
                                            return;
                                        }

                                        $set('slug', Str::slug($state));
                                    }),
                                Forms\Components\TextInput::make('sku')
                                    ->label('SKU')
                                    ->numeric(),

                                Forms\Components\TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Products::class, 'slug', ignoreRecord: true),
                            ])
                            ->columns(1),


                        Forms\Components\Select::make('brand_id')
                            ->label('Select Brand')
                            ->options(Brand::all()->pluck('name', 'id')),

                        Forms\Components\Select::make('category_id')
                            ->label('Select Category')
                            ->options(Category::all()->pluck('name', 'id')),
                        // ->required(),

                        Forms\Components\Select::make('unit_id')
                            ->label('Select Unit')
                            ->options(Unit::all()->pluck('name', 'id')),
                        // ->required(),


                    ])
                    ->columnSpan(['lg' => 1]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('buying_price')
                                    ->label('Harga Beli')
                                    ->required()
                                    ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 2),
                                Forms\Components\TextInput::make('sale_price')
                                    ->label('Harga Jual')
                                    ->required()
                                    ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 2),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('discount')
                                    ->label('Discount')
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/']),

                                Forms\Components\TextInput::make('qty')
                                    ->label('Stock')
                                    ->numeric()
                                    ->rules(['integer', 'min:0'])
                                    ->required(),
                            ])
                            ->columns(2),

                        Forms\Components\FileUpload::make('image')
                            ->label('Product Image')
                            ->image()
                            ->maxSize(2048)
                            ->directory('product')
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend('product-'),
                            ),
                        Forms\Components\Toggle::make('is_visible')
                            ->label('Visible to customers.')
                            ->default(true),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->defaultSort('name')
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->square()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Brand')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('buying_price')
                    ->label('Harga Beli')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->currency('IDR'),

                Tables\Columns\TextColumn::make('sale_price')
                    ->label('Harga Jual')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->currency('IDR'),

                Tables\Columns\TextColumn::make('qty')
                    ->label('Stok')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('unit.alias')
                    ->label('Satuan')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('discount')
                    ->label('Diskon')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Visibility')
                    ->toggleable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->sortable()
                    ->toggleable()
                    ->datetime('H:i, d M Y'),
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

    public static function getRelations(): array
    {
        return [
            RelationManagers\SpecificationRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageProducts::route('/'),
            'create' => Pages\CreateProducts::route('/create'),
            'edit' => Pages\EditProducts::route('/{record}/edit'),
        ];
    }
}
