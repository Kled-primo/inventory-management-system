<?php

namespace App\Http\Controllers\Dashboards;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Quotation;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::where("user_id", auth()->id())->count();
        $products = Product::where("user_id", auth()->id())->count();

        $purchases = Purchase::where("user_id", auth()->id())->count();
        $todayPurchases = Purchase::whereDate('date', today()->format('Y-m-d'))->count();
        $todayProducts = Product::whereDate('created_at', today()->format('Y-m-d'))->count();
        $todayQuotations = Quotation::whereDate('created_at', today()->format('Y-m-d'))->count();
        $todayOrders = Order::whereDate('created_at', today()->format('Y-m-d'))->count();

        $categories = Category::where("user_id", auth()->id())->count();
        $quotations = Quotation::where("user_id", auth()->id())->count();

        //computation

        $forecast_year = Setting::where('id', 1)->first(); // Get the current year set

        $order_details = OrderDetails::selectRaw('
                        order_details.product_id,
                        products.name AS product_name,
                        YEAR(order_details.created_at) AS year,
                        MONTH(order_details.created_at) AS month,
                        SUM(order_details.quantity) AS total_quantity
                    ')
                            ->join('products', 'order_details.product_id', '=', 'products.id')
                            ->whereYear('order_details.created_at', $forecast_year->value)
                            ->groupBy('order_details.product_id', 'products.name', 'year', 'month')
                            ->orderBy('order_details.product_id')
                            ->orderBy('year')
                            ->orderBy('month')
                            ->get();

        // Initialize separate collections for each quarter
        $q1 = collect();
        $q2 = collect();
        $q3 = collect();
        $q4 = collect();

        // Define a mapping of months to quarters
        $monthToQuarter = [
            1 => 1, 2 => 1, 3 => 1, // Q1
            4 => 2, 5 => 2, 6 => 2, // Q2
            7 => 3, 8 => 3, 9 => 3, // Q3
            10 => 4, 11 => 4, 12 => 4, // Q4
        ];

        foreach ($order_details as $detail) {
            $quarter = $monthToQuarter[$detail->month];
            switch ($quarter) {
                case 1:
                    $collection = $q1;
                    break;
                case 2:
                    $collection = $q2;
                    break;
                case 3:
                    $collection = $q3;
                    break;
                case 4:
                    $collection = $q4;
                    break;
            }

            // Initialize the product's total_quantity in the quarter if it doesn't exist
            if (!$collection->has($detail->product_id)) {
                $collection->put($detail->product_id, [
                    'name' => $detail->product_name,
                    'total_quantity' => 0
                ]);
            }

            // Add the total_quantity to the product's total in the quarter
            $productData = $collection->get($detail->product_id);
            $productData['total_quantity'] += $detail->total_quantity;
            $collection->put($detail->product_id, $productData);
        }


        // Sort each quarter by total_quantity in descending order
        $q1 = $q1->sortByDesc('total_quantity')->take(20);
        $q2 = $q2->sortByDesc('total_quantity')->take(20);
        $q3 = $q3->sortByDesc('total_quantity')->take(20);
        $q4 = $q4->sortByDesc('total_quantity')->take(20);


        //Display the results for each quarter
        $quarters = [
            1 => $q1,
            2 => $q2,
            3 => $q3,
            4 => $q4,
        ];



        $q1_graph = \Lava::DataTable();
        $q1_graph->addStringColumn('Product');
        $q1_graph->addNumberColumn('Sales');

        $q2_graph = \Lava::DataTable();
        $q2_graph->addStringColumn('Product');
        $q2_graph->addNumberColumn('Sales');

        $q3_graph = \Lava::DataTable();
        $q3_graph->addStringColumn('Product');
        $q3_graph->addNumberColumn('Sales');

        $q4_graph = \Lava::DataTable();
        $q4_graph->addStringColumn('Product');
        $q4_graph->addNumberColumn('Sales');



        foreach ($quarters as $quarter => $quarter_products) {

            foreach ($quarter_products as $product_id => $productData) {

                switch ($quarter) {
                    case 1:

                        $q1_graph->addRow([$productData['name'],$productData['total_quantity']]);

                        break;
                    case 2:

                        $q2_graph->addRow([$productData['name'],$productData['total_quantity']]);

                        break;
                    case 3:

                        $q3_graph->addRow([$productData['name'],$productData['total_quantity']]);

                        break;
                    case 4:

                        $q4_graph->addRow([$productData['name'],$productData['total_quantity']]);

                        break;
                }


            }
        }

        $q1_options = [
            'title' => 'First Quarter',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ],
            'colors' => ['#e0440e'],
        ];

        \Lava::ColumnChart('FirstQuarter', $q1_graph, $q1_options);

        $q2_options = [
            'title' => 'Second Quarter',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ],
            'colors' => ['#c37c31'],
        ];

        \Lava::ColumnChart('SecondQuarter', $q2_graph, $q2_options);

        $q3_options = [
            'title' => 'Third Quarter',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ],
            'colors' => ['#4bb54a'],
        ];

        \Lava::ColumnChart('ThirdQuarter', $q3_graph, $q3_options);

        $q4_options =  [
            'title' => 'Forth Quarter',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ],
            'colors' => ['#bd429f'],
        ];

        \Lava::ColumnChart('ForthQuarter', $q4_graph, $q4_options);

        return view('dashboard', [
            'products' => $products,
            'orders' => $orders,
            'purchases' => $purchases,
            'todayPurchases' => $todayPurchases,
            'todayProducts' => $todayProducts,
            'todayQuotations' => $todayQuotations,
            'todayOrders' => $todayOrders,
            'categories' => $categories,
            'quotations' => $quotations,
            'q1' => $q1,
            'q2' => $q2,
            'q3' => $q3,
            'q4' => $q4,
            'q1_graph' => $q1_graph,
            'q2_graph' => $q2_graph,
            'q3_graph' => $q3_graph,
            'q4_graph' => $q4_graph
        ]);
    }
}
