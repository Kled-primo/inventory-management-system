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

class DashboardController extends Controller {

	use ForecastTrait;

	public function index() {
		$orders   = Order::where( 'user_id', auth()->id() )->count();
		$products = Product::where( 'user_id', auth()->id() )->count();

		$purchases       = Purchase::where( 'user_id', auth()->id() )->count();
		$todayPurchases  = Purchase::whereDate( 'date', today()->format( 'Y-m-d' ) )->count();
		$todayProducts   = Product::whereDate( 'created_at', today()->format( 'Y-m-d' ) )->count();
		$todayQuotations = Quotation::whereDate( 'created_at', today()->format( 'Y-m-d' ) )->count();
		$todayOrders     = Order::whereDate( 'created_at', today()->format( 'Y-m-d' ) )->count();

		$categories = Category::where( 'user_id', auth()->id() )->count();
		$quotations = Quotation::where( 'user_id', auth()->id() )->count();

		// computation

		$forecast_year = Setting::where( 'is_active', 1 )->first(); // Get the current year set
		// $forecast_year = now()->format('Y');

		$this->general( $forecast_year->value );

		$this->blsellers();

		return view(
			'dashboard',
			array(
				'products'        => $products,
				'orders'          => $orders,
				'purchases'       => $purchases,
				'todayPurchases'  => $todayPurchases,
				'todayProducts'   => $todayProducts,
				'todayQuotations' => $todayQuotations,
				'todayOrders'     => $todayOrders,
				'categories'      => $categories,
				'quotations'      => $quotations,
				'q1'              => $this->q1,
				'q2'              => $this->q2,
				'q3'              => $this->q3,
				'q4'              => $this->q4,
				'q1_graph'        => $this->q1_graph,
				'q2_graph'        => $this->q2_graph,
				'q3_graph'        => $this->q3_graph,
				'q4_graph'        => $this->q4_graph,
				'best_sellers'    => $this->best_sellers,
				'low_sellers'     => $this->low_sellers,
				'year'            => $forecast_year->value,
			)
		);
	}
}
