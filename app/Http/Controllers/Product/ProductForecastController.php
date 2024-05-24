<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

;


class ProductForecastController extends Controller
{
    public function product($id)
    {
        $order_details = OrderDetails::selectRaw('
                        product_id,
                        YEAR(created_at) AS year,
                        MONTH(created_at) AS month,
                        SUM(quantity) AS total_quantity
                    ')
                    ->where('product_id', '=', $id) // Apply the WHERE condition for product_id = 8
                    ->groupBy('product_id', 'year', 'month')
                    ->orderBy('year')
                    ->orderBy('month')
                    ->orderBy('product_id')
                    ->get();
        //dd($order_details);
        $product = Product::find($id);

        $product_forecasts = collect();

        $counter = 0;

        $prev_container = collect();

        $ave = 0;

        $fcgraph = \Lava::DataTable();

        $fcgraph->addDateColumn('Date')
                ->addNumberColumn('Actual')
                ->addNumberColumn('Forecast');


        foreach($order_details as $details) {


            $prev_container->push($details->total_quantity);

            if($prev_container->count() > 3) {
                $prev_container->shift();
            }

            if ($counter > 0) {

                $ave = $prev_container->avg();
            }

            $counter++;

            $product_forecasts->push(['year' => $details->year,'month' => $details->month,'sales' => $details->total_quantity,'forecast' => $ave]);

            $fcgraph->addRow([$details->year .'-'.$details->month, $details->total_quantity, $ave]);

        }

        \Lava::LineChart('Forcasts', $fcgraph, ['title' => 'Sales Forecast - ' . $product->name]);

        return view('products.forecast')
            ->with('product_forecasts', $product_forecasts)
            ->with('fcgraph', $fcgraph)
            ->with('product', $product);

    }
}
