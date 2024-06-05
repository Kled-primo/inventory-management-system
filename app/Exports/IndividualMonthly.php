<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class IndividualMonthly implements FromView
{
    use Exportable;

    protected $product;
    protected $product_forecasts;

    public function __construct($product, $product_forecasts)
    {
        $this->product = $product;
        $this->product_forecasts = $product_forecasts;

    }
    public function view(): View
    {
        return view('forecasts._individualproduct')
            ->with('product_forecasts', $this->product_forecasts)
            ->with('product', $this->product);
    }
}
