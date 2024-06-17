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
use App\Traits\ForecastTrait;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    use ForecastTrait;
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

        $forecast_year = Setting::where('is_active', 1)->first(); // Get the current year set
        //$forecast_year = now()->format('Y');

        $this->general($forecast_year->value);

        // Best Sellers and Low Sellers
        $best_sellers = collect();
        $low_sellers = collect();


        // Best Sellers
        if (count($this->qbs1) > 0) {
            $q1top_products = $this->qbs1;

            foreach($q1top_products as $tp) {
                $best_sellers->put($tp['pid'], [
                    'pid' => $tp['pid'],
                    'name' => $tp['name'],
                    'total_quantity' => $tp['total_quantity'],
                    'quarter' => '1',
                    'count' => 1
                ]);
            }

        }

        if (count($this->qbs2) > 0) {

            $q2top_products = $this->qbs2;

            if (count($q2top_products) > 0) {
                foreach($q2top_products as $tp) {

                    if (!$best_sellers->has($tp['pid'])) {

                        $best_sellers->put($tp['pid'], [
                                            'pid' => $tp['pid'],
                                            'name' => $tp['name'],
                                            'total_quantity' => $tp['total_quantity'],
                                            'quarter' => '2',
                                            'count' => 1
                                        ]);
                    } else {
                        $best_seller_data = $best_sellers->get($tp['pid']);
                        $best_seller_data['quarter'] .= ',2';
                        $best_seller_data['count'] += 1;
                        $best_sellers->put($tp['pid'], $best_seller_data);
                    }
                }

            }
        }


        if (count($this->qbs3) > 0) {

            $q3top_products = $this->qbs3;

            if (count($q3top_products) > 0) {
                foreach($q3top_products as $tp) {

                    if (!$best_sellers->has($tp['pid'])) {

                        $best_sellers->put($tp['pid'], [
                                            'pid' => $tp['pid'],
                                            'name' => $tp['name'],
                                            'total_quantity' => $tp['total_quantity'],
                                            'quarter' => '4',
                                            'count' => 1
                                        ]);
                    } else {

                        $best_seller_data = $best_sellers->get($tp['pid']);
                        $best_seller_data['quarter'] .= ',3';
                        $best_seller_data['count'] += 1;
                        $best_sellers->put($tp['pid'], $best_seller_data);
                    }
                }

            }
        }


        if (count($this->qbs4) > 0) {

            $q4top_products = $this->qbs4;

            if (count($q4top_products) > 0) {
                foreach($q4top_products as $tp) {

                    if (!$best_sellers->has($tp['pid'])) {

                        $best_sellers->put($tp['pid'], [
                                            'pid' => $tp['pid'],
                                            'name' => $tp['name'],
                                            'total_quantity' => $tp['total_quantity'],
                                            'quarter' => '4',
                                            'count' => 1
                                        ]);
                    } else {

                        $best_seller_data = $best_sellers->get($tp['pid']);
                        $best_seller_data['quarter'] .= ',4';
                        $best_seller_data['count'] += 1;
                        $best_sellers->put($tp['pid'], $best_seller_data);
                    }

                }

            }
        }

        // Low Sellers


        if (count($this->qls1) > 0) {
            $q1low_products = $this->qls1;

            foreach($q1low_products as $lp) {
                $low_sellers->put($lp['pid'], [
                    'pid' => $lp['pid'],
                    'name' => $lp['name'],
                    'total_quantity' => $lp['total_quantity'],
                    'quarter' => '1',
                    'count' => 1
                ]);
            }

        }

        if (count($this->qls2) > 0) {

            $q2low_products = $this->qls2;

            if (count($q2low_products) > 0) {
                foreach($q2low_products as $lp) {

                    if (!$low_sellers->has($lp['pid'])) {

                        $low_sellers->put($lp['pid'], [
                                            'pid' => $lp['pid'],
                                            'name' => $lp['name'],
                                            'total_quantity' => $lp['total_quantity'],
                                            'quarter' => '2',
                                            'count' => 1
                                        ]);
                    } else {
                        $low_seller_data = $low_sellers->get($lp['pid']);
                        $low_seller_data['quarter'] .= ',2';
                        $low_seller_data['count'] += 1;
                        $low_sellers->put($lp['pid'], $low_seller_data);
                    }

                }

            }
        }


        if (count($this->qls3) > 0) {

            $q3low_products = $this->qls3;

            if (count($q3low_products) > 0) {
                foreach($q3low_products as $lp) {

                    if (!$low_sellers->has($lp['pid'])) {

                        $low_sellers->put($lp['pid'], [
                                            'pid' => $lp['pid'],
                                            'name' => $lp['name'],
                                            'total_quantity' => $lp['total_quantity'],
                                            'quarter' => '3',
                                            'count' => 1
                                        ]);
                    } else {

                        $low_seller_data = $low_sellers->get($lp['pid']);
                        $low_seller_data['quarter'] .= ',3';
                        $low_seller_data['count'] += 1;
                        $low_sellers->put($lp['pid'], $low_seller_data);
                    }

                }

            }
        }


        if (count($this->qls4) > 0) {

            $q4low_products = $this->qls4;

            if (count($q4low_products) > 0) {
                foreach($q4low_products as $lp) {

                    if (!$low_sellers->has($lp['pid'])) {

                        $low_sellers->put($lp['pid'], [
                                            'pid' => $lp['pid'],
                                            'name' => $lp['name'],
                                            'total_quantity' => $lp['total_quantity'],
                                            'quarter' => '4',
                                            'count' => 1
                                        ]);
                    } else {

                        $low_seller_data = $low_sellers->get($lp['pid']);
                        $low_seller_data['quarter'] .= ',4';
                        $low_seller_data['count'] += 1;
                        $low_sellers->put($lp['pid'], $low_seller_data);
                    }

                }

            }
        }



        $q1_graph = \Lava::DataTable();
        $q1_graph->addStringColumn('Product');
        $q1_graph->addNumberColumn('Sales');
        $q1_graph->addRoleColumn('string', 'style');

        $q2_graph = \Lava::DataTable();
        $q2_graph->addStringColumn('Product');
        $q2_graph->addNumberColumn('Sales');
        $q2_graph->addRoleColumn('string', 'style');

        $q3_graph = \Lava::DataTable();
        $q3_graph->addStringColumn('Product');
        $q3_graph->addNumberColumn('Sales');
        $q3_graph->addRoleColumn('string', 'style');


        $q4_graph = \Lava::DataTable();
        $q4_graph->addStringColumn('Product');
        $q4_graph->addNumberColumn('Sales');
        $q4_graph->addRoleColumn('string', 'style');



        foreach ($this->quarters as $quarter => $quarter_products) {

            foreach ($quarter_products as $product_id => $productData) {

                switch ($quarter) {
                    case 1:
                        if ($productData['stype'] == '1') {

                            $q1_graph->addRow([$productData['name'],$productData['total_quantity'],'color: #74b816']);

                        } else {

                            $q1_graph->addRow([$productData['name'],$productData['total_quantity'],'color: #d63939']);
                        }

                        break;
                    case 2:
                        if ($productData['stype'] == '1') {
                            $q2_graph->addRow([$productData['name'],$productData['total_quantity'],'color: #74b816']);
                        } else {
                            $q2_graph->addRow([$productData['name'],$productData['total_quantity'],'color: #d63939']);
                        }
                        break;
                    case 3:
                        if ($productData['stype'] == '1') {
                            $q3_graph->addRow([$productData['name'],$productData['total_quantity'],'color: #74b816']);
                        } else {

                            $q3_graph->addRow([$productData['name'],$productData['total_quantity'],'color: #d63939']);

                        }
                        break;
                    case 4:
                        if ($productData['stype'] == '1') {
                            $q4_graph->addRow([$productData['name'],$productData['total_quantity'],'color: #74b816']);
                        } else {

                            $q4_graph->addRow([$productData['name'],$productData['total_quantity'],'color: #d63939']);

                        }

                        break;
                }


            }
        }

        // $q1_options = [
        //     'title' => 'First Quarter',
        //     'titleTextStyle' => [
        //         'color'    => '#eb6b2c',
        //         'fontSize' => 14
        //     ],
        //     'colors' => ['#e0440e'],
        // ];

        $q1_options = [
            'title' => 'First Quarter',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ],
            'legend' => ['position' => 'none'], // No legend as colors are row-specific
            'bar' => ['groupWidth' => '75%']
        ];


        \Lava::ColumnChart('FirstQuarter', $q1_graph, $q1_options);

        $q2_options = [
            'title' => 'Second Quarter',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ],
            'legend' => ['position' => 'none'], // No legend as colors are row-specific
            'bar' => ['groupWidth' => '75%']
        ];

        \Lava::ColumnChart('SecondQuarter', $q2_graph, $q2_options);

        $q3_options = [
            'title' => 'Third Quarter',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ],
            'legend' => ['position' => 'none'], // No legend as colors are row-specific
            'bar' => ['groupWidth' => '75%']
        ];

        \Lava::ColumnChart('ThirdQuarter', $q3_graph, $q3_options);

        $q4_options =  [
            'title' => 'Forth Quarter',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ],
            'legend' => ['position' => 'none'], // No legend as colors are row-specific
            'bar' => ['groupWidth' => '75%']
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
            'q1' => $this->q1,
            'q2' => $this->q2,
            'q3' => $this->q3,
            'q4' => $this->q4,
            'q1_graph' => $q1_graph,
            'q2_graph' => $q2_graph,
            'q3_graph' => $q3_graph,
            'q4_graph' => $q4_graph,
            'best_sellers' => $best_sellers,
            'low_sellers' => $low_sellers,
            'year' => $forecast_year->value
        ]);
    }
}
