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
        $twentyfive_products = Product::whereRaw('quantity < (quantity_alert * 1.25)')->count();

        // Fifty Alert Level
        $fifty_products = Product::whereRaw('quantity < (quantity_alert * 1.50)')
                            ->whereRaw('quantity > (quantity_alert * 1.25)')
                            ->count();

        $notify_products = Product::whereRaw('quantity < (quantity_alert * 1.50)')->get();


        $view->with('twentyfive_products', $twentyfive_products)
            ->with('fifty_products', $fifty_products)
            ->with('notify_products', $notify_products);
    }
}
