<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\Setting;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductForecastController extends Controller
{
    public function product($id)
    {
        // Get the current year set from settings table
        $forecast_year = Setting::where('id', 1)->first();

        $order_details = OrderDetails::selectRaw('
                        product_id,
                        YEAR(created_at) AS year,
                        MONTH(created_at) AS month,
                        SUM(quantity) AS total_quantity
                    ')
                    ->where('product_id', '=', $id) // product id
                    ->whereYear('created_at', $forecast_year->value)
                    ->groupBy('product_id', 'year', 'month')
                    ->orderBy('year')
                    ->orderBy('month')
                    ->orderBy('product_id')
                    ->get();

        $product = Product::find($id);

        $product_forecasts = collect();

        $counter = 0;

        $prev_container = collect();

        $ave = 0;

        $fcgraph = \Lava::DataTable();

        $fcgraph->addDateColumn('Date')
                ->addNumberColumn('Actual')
                ->addNumberColumn('Forecast');

        $quarters = collect([
            '1' => '0',
            '2' => '0',
            '3' => '0',
            '4' => '0'
        ]);

        // Define a mapping of months to quarters
        $monthToQuarter = [
            1 => 1, 2 => 1, 3 => 1, // Q1
            4 => 2, 5 => 2, 6 => 2, // Q2
            7 => 3, 8 => 3, 9 => 3, // Q3
            10 => 4, 11 => 4, 12 => 4, // Q4
        ];


        foreach($order_details as $details) {

            $quarter = $monthToQuarter[$details->month];

            $quarters->put($quarter, $quarters->get($quarter) + $details->total_quantity);

            $prev_container->push($details->total_quantity);

            if($prev_container->count() > 3) {
                $prev_container->shift();
            }

            if ($counter > 0) {

                $ave = $prev_container->avg();
            }

            $counter++;

            $product_forecasts->push([
                'year' => $details->year,
                'month' => $details->month,
                'sales' => $details->total_quantity,
                'forecast' => $ave]);

            $fcgraph->addRow([$details->year .'-'.$details->month, $details->total_quantity, $ave]);

        }

        $options = [
            'title' => 'Sales Forecast - ' . $product->name,
            'hAxis' => [
                'title' => 'Month Year',
            ],
            'pointSize' => 5,
            'legend' => [
                'position' => 'bottom',
            ]

        ];

        \Lava::LineChart('Forecasts', $fcgraph, $options);

        return view('products.forecast')
            ->with('product_forecasts', $product_forecasts)
            ->with('fcgraph', $fcgraph)
            ->with('product', $product)
            ->with('quarters', $quarters);

    }
}
