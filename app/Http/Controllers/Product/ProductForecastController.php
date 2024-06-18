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
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;

class ProductForecastController extends Controller {

	use ForecastTrait;

	public function product( $id, $year ) {
		// Get the current year set from settings table
		// $forecast_year = Setting::where('id', 1)->first();

		$this->computeproduct( $id, $year );

		\Lava::LineChart( 'Forecasts', $this->fcgraph, $this->options );

		return view( 'products.forecast' )
			->with( 'product_forecasts', $this->product_forecasts )
			->with( 'fcgraph', $this->fcgraph )
			->with( 'product', $this->product )
			->with( 'quarters', $this->quarters );
	}

	public function computecategory( $id, $year ) {
		$this->order_details = OrderDetails::selectRaw(
			'
                        products.category_id,
                        YEAR(order_details.created_at) AS year,
                        MONTH(order_details.created_at) AS month,
                        SUM(order_details.quantity) AS total_quantity
                    '
		)
			->join( 'products', 'order_details.product_id', '=', 'products.id' )
							->where( 'products.category_id', '=', $id ) // product id
							->whereYear( 'order_details.created_at', $year )
							->groupBy( 'category_id', 'year', 'month' )
							->orderBy( 'year' )
							->orderBy( 'month' )
							->orderBy( 'category_id' )
							->get();

		$this->product = Category::find( $id );

		$this->computeproductdetails( $this->order_details );
	}


	public function computeproduct( $id, $year ) {
		$this->order_details = OrderDetails::selectRaw(
			'
                        product_id,
                        YEAR(created_at) AS year,
                        MONTH(created_at) AS month,
                        SUM(quantity) AS total_quantity
                    '
		)
							->where( 'product_id', '=', $id ) // product id
							->whereYear( 'created_at', $year )
							->groupBy( 'product_id', 'year', 'month' )
							->orderBy( 'year' )
							->orderBy( 'month' )
							->orderBy( 'product_id' )
							->get();

		$this->product = Product::find( $id );

		$this->computeproductdetails( $this->order_details );
	}


	public function computeproductdetails( $order_details ) {

		$this->product_forecasts = collect();

		$counter = 0;

		$prev_container = collect();

		$ave = 0;

		$this->quarters = collect(
			array(
				'1' => '0',
				'2' => '0',
				'3' => '0',
				'4' => '0',
			)
		);

		// Define a mapping of months to quarters
		$monthToQuarter = array(
			1  => 1,
			2  => 1,
			3  => 1, // Q1
			4  => 2,
			5  => 2,
			6  => 2, // Q2
			7  => 3,
			8  => 3,
			9  => 3, // Q3
			10 => 4,
			11 => 4,
			12 => 4, // Q4
		);

		$this->fcgraph = \Lava::DataTable();

		$this->fcgraph->addDateColumn( 'Date' )
		->addNumberColumn( 'Actual' )
		->addNumberColumn( 'Forecast' );

		foreach ( $order_details as $details ) {

			$quarter = $monthToQuarter[ $details->month ];

			$this->quarters->put( $quarter, $this->quarters->get( $quarter ) + $details->total_quantity );

			$prev_container->push( $details->total_quantity );

			if ( $prev_container->count() > 3 ) {
				$prev_container->shift();
			}

			if ( $counter > 0 ) {

				$ave = $prev_container->avg();
			}

			++$counter;

			$this->product_forecasts->push(
				array(
					'year'     => $details->year,
					'month'    => $details->month,
					'sales'    => $details->total_quantity,
					'forecast' => $ave,
				)
			);

			$this->fcgraph->addRow( array( $details->year . '-' . $details->month, $details->total_quantity, $ave ) );

		}

		$this->options = array(
			'title'     => 'Sales Forecast - ' . $this->product->name,
			'hAxis'     => array(
				'title' => 'Month Year',
			),
			'pointSize' => 5,
			'legend'    => array(
				'position' => 'bottom',
			),

		);
	}

	public function history() {
		$settings = Setting::all();

		$products = Product::with( array( 'product_type', 'unit' ) )->get();

		$categories = Category::pluck( 'name', 'id' );

		return view( 'forecasts.history' )
			->with( 'products', $products )
			->with( 'settings', $settings )
			->with( 'categories', $categories );
	}

	public function showhistory( Request $request ) {
		$this->general( $request->year );

		$this->blsellers();

		return view( 'forecasts.general' )
			->with( 'year', $request->year )
			->with( 'q1', $this->q1 )
			->with( 'q2', $this->q2 )
			->with( 'q3', $this->q3 )
			->with( 'q4', $this->q4 )
			->with( 'q1_graph', $this->q1_graph )
			->with( 'q2_graph', $this->q2_graph )
			->with( 'q3_graph', $this->q3_graph )
			->with( 'q4_graph', $this->q4_graph )
			->with( 'best_sellers', $this->best_sellers )
			->with( 'low_sellers', $this->low_sellers );
	}

	public function exportgeneral( Request $request ) {

		if ( $request->has( 'is_category' ) ) {

			$this->categorycollection( $request->year );

			$filename = 'general_forecast_category.xlsx';

		} else {

			$this->general( $request->year );

			$filename = 'general_forecast.xlsx';
		}

		return Excel::download( new GeneralExport( $this->q1, $this->q2, $this->q3, $this->q4, $request->year ), $filename );
	}

	public function historyindividual( Request $request ) {

		$this->computeproduct( $request->product_id, $request->year );

		\Lava::LineChart( 'Forecasts', $this->fcgraph, $this->options );

		return view( 'forecasts.historyindividual' )
			->with( 'product_forecasts', $this->product_forecasts )
			->with( 'product', $this->product )
			->with( 'quarters', $this->quarters )
			->with( 'year', $request->year );
	}

	public function historyindividualcategory( Request $request ) {
		$this->computecategory( $request->category_id, $request->year );

		\Lava::LineChart( 'Forecasts', $this->fcgraph, $this->options );

		return view( 'forecasts.categoryindividual' )
			->with( 'product_forecasts', $this->product_forecasts )
			->with( 'product', $this->product )
			->with( 'quarters', $this->quarters )
			->with( 'year', $request->year );
	}

	public function historycategory( Request $request ) {

		$this->categorycollection( $request->year );

		$this->blsellers();

		return view( 'forecasts.category' )
			->with( 'q1', $this->q1 )
			->with( 'q2', $this->q2 )
			->with( 'q3', $this->q3 )
			->with( 'q4', $this->q4 )
			->with( 'q1_graph', $this->q1_graph )
			->with( 'q2_graph', $this->q2_graph )
			->with( 'q3_graph', $this->q3_graph )
			->with( 'q4_graph', $this->q4_graph )
			->with( 'year', $request->year );
	}

	public function exportindividualmonthly( Request $request ) {

		if ( $request->has( 'is_category' ) ) {
			$this->computecategory( $request->product_id, $request->year );

			$filename = 'individual_monthly_category.xlsx';
		} else {

			$this->computeproduct( $request->product_id, $request->year );

			$filename = 'individual_monthly_product.xlsx';
		}

		return Excel::download( new IndividualMonthly( $this->product, $this->product_forecasts ), $filename );
	}

	public function exportindividualquarterly( Request $request ) {
		if ( $request->has( 'is_category' ) ) {
			$this->computecategory( $request->product_id, $request->year );

			$filename = 'individual_quarterly_category.xlsx';
		} else {
			$this->computeproduct( $request->product_id, $request->year );

			$filename = 'individual_quarterly_product.xlsx';
		}

		return Excel::download( new IndividualQuarterly( $this->product, $this->quarters ), $filename );
	}
}
