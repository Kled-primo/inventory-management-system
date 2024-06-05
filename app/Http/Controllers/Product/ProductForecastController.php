<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\Setting;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Traits\ForecastTrait;
use App\Exports\GeneralExport;
use App\Exports\IndividualMonthly;
use App\Exports\IndividualQuarterly;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ProductForecastController extends Controller
{
    use ForecastTrait;
    public function product($id, $year)
    {
        // Get the current year set from settings table
        //$forecast_year = Setting::where('id', 1)->first();

        $this->computeproduct($id, $year);


        \Lava::LineChart('Forecasts', $this->fcgraph, $this->options);

        return view('products.forecast')
            ->with('product_forecasts', $this->product_forecasts)
            ->with('fcgraph', $this->fcgraph)
            ->with('product', $this->product)
            ->with('quarters', $this->quarters);

    }

    public function computeproduct($id, $year)
    {

        $this->order_details = OrderDetails::selectRaw('
                        product_id,
                        YEAR(created_at) AS year,
                        MONTH(created_at) AS month,
                        SUM(quantity) AS total_quantity
                    ')
                            ->where('product_id', '=', $id) // product id
                            ->whereYear('created_at', $year)
                            ->groupBy('product_id', 'year', 'month')
                            ->orderBy('year')
                            ->orderBy('month')
                            ->orderBy('product_id')
                            ->get();


        $this->product = Product::find($id);

        $this->product_forecasts = collect();

        $counter = 0;

        $prev_container = collect();

        $ave = 0;

        $this->quarters = collect([
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

        $this->fcgraph = \Lava::DataTable();

        $this->fcgraph->addDateColumn('Date')
        ->addNumberColumn('Actual')
        ->addNumberColumn('Forecast');


        foreach($this->order_details as $details) {

            $quarter = $monthToQuarter[$details->month];

            $this->quarters->put($quarter, $this->quarters->get($quarter) + $details->total_quantity);

            $prev_container->push($details->total_quantity);

            if($prev_container->count() > 3) {
                $prev_container->shift();
            }

            if ($counter > 0) {

                $ave = $prev_container->avg();
            }

            $counter++;

            $this->product_forecasts->push([
                'year' => $details->year,
                'month' => $details->month,
                'sales' => $details->total_quantity,
                'forecast' => $ave]);

            $this->fcgraph->addRow([$details->year .'-'.$details->month, $details->total_quantity, $ave]);

        }

        $this->options = [
            'title' => 'Sales Forecast - ' . $this->product->name,
            'hAxis' => [
                'title' => 'Month Year',
            ],
            'pointSize' => 5,
            'legend' => [
                'position' => 'bottom',
            ]

        ];


    }

    public function history()
    {
        $settings = Setting::all();

        $products = Product::with(['product_type','unit'])->get();


        return view('forecasts.history')
        ->with('products', $products)
        ->with('settings', $settings);
    }

    public function showhistory(Request $request)
    {
        $this->general($request->year);

        return view('forecasts.general')
            ->with('q1', $this->q1)
            ->with('q2', $this->q2)
            ->with('q3', $this->q3)
            ->with('q4', $this->q4)
            ->with('year', $request->year);
    }

    public function exportgeneral(Request $request)
    {
        $this->general($request->year);

        return Excel::download(new GeneralExport($this->q1, $this->q2, $this->q3, $this->q4, $request->year), 'general_forecast.xlsx');
    }

    public function historyindividual(Request $request)
    {

        $this->computeproduct($request->product_id, $request->year);

        return view('forecasts.historyindividual')
            ->with('product_forecasts', $this->product_forecasts)
            ->with('product', $this->product)
            ->with('quarters', $this->quarters)
            ->with('year', $request->year);
    }

    public function exportindividualmonthly(Request $request)
    {

        $this->computeproduct($request->product_id, $request->year);

        return Excel::download(new IndividualMonthly($this->product, $this->product_forecasts), 'individualmonthly.xlsx');

    }

    public function exportindividualquarterly(Request $request)
    {

        $this->computeproduct($request->product_id, $request->year);

        return Excel::download(new IndividualQuarterly($this->product, $this->quarters), 'individualquarterly.xlsx');

    }
}
