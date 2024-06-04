<?php

namespace App\View\Composers;

use App\Models\Product;
use Illuminate\View\View;

class LowlevelComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct()
    {



    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {

        // Twenty Five Alert Level
        $twentyfive_products_count = Product::whereRaw('quantity < (quantity_alert * 1.25)')->count();

        $twentyfive_products = Product::whereRaw('quantity < (quantity_alert * 1.25)')->get();

        // Fifty Alert Level
        $fifty_products_count = Product::whereRaw('quantity < (quantity_alert * 1.50)')
                            ->whereRaw('quantity > (quantity_alert * 1.25)')
                            ->count();

        $fifty_products = Product::whereRaw('quantity < (quantity_alert * 1.50)')
                                    ->whereRaw('quantity > (quantity_alert * 1.25)')
                                    ->get();

        $notify_products = Product::whereRaw('quantity < (quantity_alert * 1.50)')->get();

        $expiring_products = Product::whereRaw('DATE_ADD(CURDATE(), INTERVAL 30 DAY) > expiry_date AND expiry_date > CURDATE()')->get();

        $expired_products = Product::whereRaw('expiry_date <= CURDATE()')->get();


        $view->with('twentyfive_products', $twentyfive_products)
            ->with('twentyfive_products_count', $twentyfive_products_count)
            ->with('fifty_products', $fifty_products)
            ->with('fifty_products_count', $fifty_products_count)
            ->with('notify_products', $notify_products)
            ->with('expiring_products', $expiring_products)
            ->with('expired_products', $expired_products);
    }
}
