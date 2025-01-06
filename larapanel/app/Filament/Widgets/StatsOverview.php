<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            // Totale omzet
            Card::make('Total Revenue', '€' . number_format(Order::sum('total'), 2))
                ->description('Totale omzet van alle orders')
                ->color('success'),

            // Totaal aantal producten verkocht
            Card::make('Products Sold', Product::join('order_product', 'products.id', '=', 'order_product.product_id')->sum('order_product.quantity'))
                ->description('Totaal aantal producten verkocht')
                ->color('primary'),

            // Totaal aantal orders
            Card::make('Total Orders', Order::count())
                ->description('Totaal aantal geplaatste orders')
                ->color('secondary'),

            // Totaal aantal klanten
            Card::make('Total Customers', Customer::count())
                ->description('Totaal aantal geregistreerde klanten')
                ->color('warning'),
        ];
    }
}
