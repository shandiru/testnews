<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Products';
    protected static ?string $modelLabel = 'Product';
    protected static ?string $pluralModelLabel = 'Products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('title')
                    ->label('Product Title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->required()
                    ->prefix('$'),

                Forms\Components\TextInput::make('stock')
                    ->label('Stock Quantity')
                    ->numeric()
                    ->required(),

                Forms\Components\RichEditor::make('description')
                    ->label('Description')
                    ->nullable()
                    ->toolbarButtons([
                        'bold', 'italic', 'underline', 'strike', 
                        'bulletList', 'orderedList'
                    ])
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('images')
                    ->label('Product Images')
                    ->multiple()
                    ->directory('products')
                    ->image()
                    ->imageEditor()
                    ->preserveFilenames()
                    ->maxFiles(10)
                    ->reorderable()
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('images.0')
                    ->label('Image')
                    ->size(60)
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable(),
                    

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('USD')
                      ->searchable(),
                  

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock')
                      ->searchable()
                   ,

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Added On')
                    ->dateTime('M d, Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
