<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\MoneyColumn; // Voor geldkolommen (optioneel)
use Filament\Forms\Components\Select; // Correct importeren van Select
use Filament\Forms\Components\TextInput;


class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('customer_id')
                    ->label('Customer')
                    ->relationship('customer', 'name') // Zorgt dat klanten kunnen worden geselecteerd
                    ->required(),
    
                TextInput::make('order_number')->required(),
    
                TextInput::make('total')->numeric()->required(),
    
                Select::make('products') // Meerdere producten selecteren
                    ->label('Products')
                    ->relationship('products', 'name') // Koppelt producten via de relatie
                    ->multiple(), // Laat meervoudige selectie toe
    
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])->required(),
            ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number'),
                TextColumn::make('customer.name')->label('Customer'),
                TextColumn::make('products.name') // Toont gekoppelde producten
                    ->label('Products')
                    ->separator(', '),
                TextColumn::make('total')->money('USD'),
                TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
