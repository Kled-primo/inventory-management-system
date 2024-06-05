<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class IndividualQuarterly implements FromView
{
    use Exportable;

    protected $product;
    protected $quarters;

    public function __construct($product, $quarters)
    {
        $this->product = $product;
        $this->quarters = $quarters;

    }
    public function view(): View
    {
        return view('forecasts._individualquarter')
            ->with('quarters', $this->quarters)
            ->with('product', $this->product);
    }
}
