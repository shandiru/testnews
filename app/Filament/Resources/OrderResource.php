<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form->schema([]); // No form needed
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Order ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Customer Name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
            Tables\Columns\TextColumn::make('items')
    ->label('Items')
    ->formatStateUsing(function ($state) {
        $items = json_decode($state, true);

        if (!$items) return '-';

        $output = "";
        foreach ($items as $item) {
            $output .= $item['title'] 
                . " (x" . $item['quantity'] . ") - $" 
                . number_format($item['price']) . "\n";
        }

        return $output;
    })
    ->wrap(),
               

                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Amount')
                    ->money('USD', true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->badge(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime(),
            ])
            ->filters([])
            ->actions([]) // ❌ No edit, no delete, no view
            ->bulkActions([]) // ❌ No bulk actions
            ->emptyStateActions([]); // ❌ No create button
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'), // ✔ Only this page
        ];
    }
}
