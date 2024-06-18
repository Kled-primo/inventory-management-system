<?php

namespace App\Traits;

use App\Models\OrderDetails;

trait ForecastTrait {

	public function general( $year ) {

		$order_details = OrderDetails::selectRaw(
			'
                        order_details.product_id,
                        products.name AS product_name,
                        YEAR(order_details.created_at) AS year,
                        MONTH(order_details.created_at) AS month,
                        SUM(order_details.quantity) AS total_quantity
                    '
		)
							->join( 'products', 'order_details.product_id', '=', 'products.id' )
							->whereYear( 'order_details.created_at', $year )
							->groupBy( 'order_details.product_id', 'products.name', 'year', 'month' )
							->orderBy( 'order_details.product_id' )
							->orderBy( 'year' )
							->orderBy( 'month' )
							->get();

		$this->generalcollection( $order_details );
	}

	public function categorycollection( $year ) {

		$order_details = OrderDetails::selectRaw(
			'
                        categories.id AS product_id,
                        categories.name AS product_name,
                        YEAR(order_details.created_at) AS year,
                        MONTH(order_details.created_at) AS month,
                        SUM(order_details.quantity) AS total_quantity
                    '
		)
							->join( 'products', 'order_details.product_id', '=', 'products.id' )
							->join( 'categories', 'categories.id', '=', 'products.category_id' )
							->whereYear( 'order_details.created_at', $year )
							->groupBy( 'categories.id', 'categories.name', 'year', 'month' )
							->orderBy( 'year' )
							->orderBy( 'month' )
							->get();

		$this->generalcollection( $order_details );
	}

	public function generalcollection( $order_details ) {
		// Initialize separate collections for each quarter
		$this->q1 = collect();
		$this->q2 = collect();
		$this->q3 = collect();
		$this->q4 = collect();

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

		// $currentQuarter = $monthToQuarter[date("n")];

		foreach ( $order_details as $detail ) {
			$quarter = $monthToQuarter[ $detail->month ];
			switch ( $quarter ) {
				case 1:
					$collection = $this->q1;
					break;
				case 2:
					$collection = $this->q2;
					break;
				case 3:
					$collection = $this->q3;
					break;
				case 4:
					$collection = $this->q4;
					break;
			}

			// Initialize the product's total_quantity in the quarter if it doesn't exist
			if ( ! $collection->has( $detail->product_id ) ) {
				$collection->put(
					$detail->product_id,
					array(
						'pid'            => $detail->product_id,
						'name'           => $detail->product_name,
						'total_quantity' => 0,
					)
				);
			}

			// Add the total_quantity to the product's total in the quarter
			$productData                    = $collection->get( $detail->product_id );
			$productData['total_quantity'] += $detail->total_quantity;
			$collection->put( $detail->product_id, $productData );
		} // loop over product

		$totalq1 = $this->q1->count();

		if ( $totalq1 > 10 ) {
			$topq1    = 10;
			$bottomq1 = 10;
		} else {
			$topq1    = $totalq1 - intdiv( $totalq1, 2 );
			$bottomq1 = $totalq1 - $topq1;
		}

		$totalq2 = $this->q2->count();

		if ( $totalq2 > 10 ) {
			$topq2    = 10;
			$bottomq2 = 10;
		} else {
			$topq2    = $totalq2 - intdiv( $totalq2, 2 );
			$bottomq2 = $totalq2 - $topq2;
		}

		$totalq3 = $this->q3->count();

		if ( $totalq3 > 10 ) {
			$topq3    = 10;
			$bottomq3 = 10;
		} else {
			$topq3    = $totalq3 - intdiv( $totalq3, 2 );
			$bottomq3 = $totalq3 - $topq3;
		}

		$totalq4 = $this->q4->count();

		if ( $totalq4 > 10 ) {
			$topq4    = 10;
			$bottomq4 = 10;
		} else {
			$topq4    = $totalq4 - intdiv( $totalq4, 2 );
			$bottomq4 = $totalq4 - $topq4;
		}

		// Sort each quarter by total_quantity in descending order
		$this->qbs1 = $this->q1->sortByDesc( 'total_quantity' )->take( $topq1 )->map(
			function ( $item ) {
				$item['stype'] = '1';
				return $item;
			}
		);
		$this->qbs2 = $this->q2->sortByDesc( 'total_quantity' )->take( $topq2 )->map(
			function ( $item ) {
				$item['stype'] = '1';
				return $item;
			}
		);
		$this->qbs3 = $this->q3->sortByDesc( 'total_quantity' )->take( $topq3 )->map(
			function ( $item ) {
				$item['stype'] = '1';
				return $item;
			}
		);
		$this->qbs4 = $this->q4->sortByDesc( 'total_quantity' )->take( $topq4 )->map(
			function ( $item ) {
				$item['stype'] = '1';
				return $item;
			}
		);

		$this->qls1 = $this->q1->sortBy( 'total_quantity' )->take( $bottomq1 )->map(
			function ( $item ) {
				$item['stype'] = '2';
				return $item;
			}
		);
		$this->qls2 = $this->q2->sortBy( 'total_quantity' )->take( $bottomq2 )->map(
			function ( $item ) {
				$item['stype'] = '2';
				return $item;
			}
		);
		$this->qls3 = $this->q3->sortBy( 'total_quantity' )->take( $bottomq3 )->map(
			function ( $item ) {
				$item['stype'] = '2';
				return $item;
			}
		);
		$this->qls4 = $this->q4->sortBy( 'total_quantity' )->take( $bottomq4 )->map(
			function ( $item ) {
				$item['stype'] = '2';
				return $item;
			}
		);

		$this->q1 = $this->qbs1->merge( $this->qls1 );
		$this->q2 = $this->qbs2->merge( $this->qls2 );
		$this->q3 = $this->qbs3->merge( $this->qls3 );
		$this->q4 = $this->qbs4->merge( $this->qls4 );

		// Display the results for each quarter
		$this->quarters = array(
			1 => $this->q1->sortByDesc( 'total_quantity' ),
			2 => $this->q2->sortByDesc( 'total_quantity' ),
			3 => $this->q3->sortByDesc( 'total_quantity' ),
			4 => $this->q4->sortByDesc( 'total_quantity' ),
		);
	}

	public function blsellers() {
		// Best Sellers and Low Sellers
		$this->best_sellers = collect();
		$this->low_sellers  = collect();

		// Best Sellers
		if ( count( $this->qbs1 ) > 0 ) {
			$q1top_products = $this->qbs1;

			foreach ( $q1top_products as $tp ) {
				$this->best_sellers->put(
					$tp['pid'],
					array(
						'pid'            => $tp['pid'],
						'name'           => $tp['name'],
						'total_quantity' => $tp['total_quantity'],
						'quarter'        => '1',
						'count'          => 1,
					)
				);
			}
		}

		if ( count( $this->qbs2 ) > 0 ) {

			$q2top_products = $this->qbs2;

			if ( count( $q2top_products ) > 0 ) {
				foreach ( $q2top_products as $tp ) {

					if ( ! $this->best_sellers->has( $tp['pid'] ) ) {

						$this->best_sellers->put(
							$tp['pid'],
							array(
								'pid'            => $tp['pid'],
								'name'           => $tp['name'],
								'total_quantity' => $tp['total_quantity'],
								'quarter'        => '2',
								'count'          => 1,
							)
						);
					} else {
						$best_seller_data             = $this->best_sellers->get( $tp['pid'] );
						$best_seller_data['quarter'] .= ',2';
						$best_seller_data['count']   += 1;
						$this->best_sellers->put( $tp['pid'], $best_seller_data );
					}
				}
			}
		}

		if ( count( $this->qbs3 ) > 0 ) {

			$q3top_products = $this->qbs3;

			if ( count( $q3top_products ) > 0 ) {
				foreach ( $q3top_products as $tp ) {

					if ( ! $this->best_sellers->has( $tp['pid'] ) ) {

						$this->best_sellers->put(
							$tp['pid'],
							array(
								'pid'            => $tp['pid'],
								'name'           => $tp['name'],
								'total_quantity' => $tp['total_quantity'],
								'quarter'        => '4',
								'count'          => 1,
							)
						);
					} else {

						$best_seller_data             = $this->best_sellers->get( $tp['pid'] );
						$best_seller_data['quarter'] .= ',3';
						$best_seller_data['count']   += 1;
						$this->best_sellers->put( $tp['pid'], $best_seller_data );
					}
				}
			}
		}

		if ( count( $this->qbs4 ) > 0 ) {

			$q4top_products = $this->qbs4;

			if ( count( $q4top_products ) > 0 ) {
				foreach ( $q4top_products as $tp ) {

					if ( ! $this->best_sellers->has( $tp['pid'] ) ) {

						$this->best_sellers->put(
							$tp['pid'],
							array(
								'pid'            => $tp['pid'],
								'name'           => $tp['name'],
								'total_quantity' => $tp['total_quantity'],
								'quarter'        => '4',
								'count'          => 1,
							)
						);
					} else {

						$best_seller_data             = $this->best_sellers->get( $tp['pid'] );
						$best_seller_data['quarter'] .= ',4';
						$best_seller_data['count']   += 1;
						$this->best_sellers->put( $tp['pid'], $best_seller_data );
					}
				}
			}
		}

		// Low Sellers

		if ( count( $this->qls1 ) > 0 ) {
			$q1low_products = $this->qls1;

			foreach ( $q1low_products as $lp ) {
				$this->low_sellers->put(
					$lp['pid'],
					array(
						'pid'            => $lp['pid'],
						'name'           => $lp['name'],
						'total_quantity' => $lp['total_quantity'],
						'quarter'        => '1',
						'count'          => 1,
					)
				);
			}
		}

		if ( count( $this->qls2 ) > 0 ) {

			$q2low_products = $this->qls2;

			if ( count( $q2low_products ) > 0 ) {
				foreach ( $q2low_products as $lp ) {

					if ( ! $this->low_sellers->has( $lp['pid'] ) ) {

						$this->low_sellers->put(
							$lp['pid'],
							array(
								'pid'            => $lp['pid'],
								'name'           => $lp['name'],
								'total_quantity' => $lp['total_quantity'],
								'quarter'        => '2',
								'count'          => 1,
							)
						);
					} else {
						$low_seller_data             = $this->low_sellers->get( $lp['pid'] );
						$low_seller_data['quarter'] .= ',2';
						$low_seller_data['count']   += 1;
						$this->low_sellers->put( $lp['pid'], $low_seller_data );
					}
				}
			}
		}

		if ( count( $this->qls3 ) > 0 ) {

			$q3low_products = $this->qls3;

			if ( count( $q3low_products ) > 0 ) {
				foreach ( $q3low_products as $lp ) {

					if ( ! $this->low_sellers->has( $lp['pid'] ) ) {

						$this->low_sellers->put(
							$lp['pid'],
							array(
								'pid'            => $lp['pid'],
								'name'           => $lp['name'],
								'total_quantity' => $lp['total_quantity'],
								'quarter'        => '3',
								'count'          => 1,
							)
						);
					} else {

						$low_seller_data             = $this->low_sellers->get( $lp['pid'] );
						$low_seller_data['quarter'] .= ',3';
						$low_seller_data['count']   += 1;
						$this->low_sellers->put( $lp['pid'], $low_seller_data );
					}
				}
			}
		}

		if ( count( $this->qls4 ) > 0 ) {

			$q4low_products = $this->qls4;

			if ( count( $q4low_products ) > 0 ) {
				foreach ( $q4low_products as $lp ) {

					if ( ! $this->low_sellers->has( $lp['pid'] ) ) {

						$this->low_sellers->put(
							$lp['pid'],
							array(
								'pid'            => $lp['pid'],
								'name'           => $lp['name'],
								'total_quantity' => $lp['total_quantity'],
								'quarter'        => '4',
								'count'          => 1,
							)
						);
					} else {

						$low_seller_data             = $this->low_sellers->get( $lp['pid'] );
						$low_seller_data['quarter'] .= ',4';
						$low_seller_data['count']   += 1;
						$this->low_sellers->put( $lp['pid'], $low_seller_data );
					}
				}
			}
		}

		$this->q1_graph = \Lava::DataTable();
		$this->q1_graph->addStringColumn( 'Product' );
		$this->q1_graph->addNumberColumn( 'Sales' );
		$this->q1_graph->addRoleColumn( 'string', 'style' );

		$this->q2_graph = \Lava::DataTable();
		$this->q2_graph->addStringColumn( 'Product' );
		$this->q2_graph->addNumberColumn( 'Sales' );
		$this->q2_graph->addRoleColumn( 'string', 'style' );

		$this->q3_graph = \Lava::DataTable();
		$this->q3_graph->addStringColumn( 'Product' );
		$this->q3_graph->addNumberColumn( 'Sales' );
		$this->q3_graph->addRoleColumn( 'string', 'style' );

		$this->q4_graph = \Lava::DataTable();
		$this->q4_graph->addStringColumn( 'Product' );
		$this->q4_graph->addNumberColumn( 'Sales' );
		$this->q4_graph->addRoleColumn( 'string', 'style' );

		foreach ( $this->quarters as $quarter => $quarter_products ) {

			foreach ( $quarter_products as $product_id => $productData ) {

				switch ( $quarter ) {
					case 1:
						if ( $productData['stype'] == '1' ) {

							$this->q1_graph->addRow( array( $productData['name'], $productData['total_quantity'], 'color: #74b816' ) );

						} else {

							$this->q1_graph->addRow( array( $productData['name'], $productData['total_quantity'], 'color: #d63939' ) );
						}

						break;
					case 2:
						if ( $productData['stype'] == '1' ) {
							$this->q2_graph->addRow( array( $productData['name'], $productData['total_quantity'], 'color: #74b816' ) );
						} else {
							$this->q2_graph->addRow( array( $productData['name'], $productData['total_quantity'], 'color: #d63939' ) );
						}
						break;
					case 3:
						if ( $productData['stype'] == '1' ) {
							$this->q3_graph->addRow( array( $productData['name'], $productData['total_quantity'], 'color: #74b816' ) );
						} else {

							$this->q3_graph->addRow( array( $productData['name'], $productData['total_quantity'], 'color: #d63939' ) );

						}
						break;
					case 4:
						if ( $productData['stype'] == '1' ) {
							$this->q4_graph->addRow( array( $productData['name'], $productData['total_quantity'], 'color: #74b816' ) );
						} else {

							$this->q4_graph->addRow( array( $productData['name'], $productData['total_quantity'], 'color: #d63939' ) );

						}

						break;
				}
			}
		}

		$q1_options = array(
			'title'          => 'First Quarter',
			'titleTextStyle' => array(
				'color'    => '#0054a6',
				'fontSize' => 14,
			),
			'legend'         => array( 'position' => 'none' ), // No legend as colors are row-specific
			'bar'            => array( 'groupWidth' => '75%' ),
		);

		\Lava::ColumnChart( 'FirstQuarter', $this->q1_graph, $q1_options );

		$q2_options = array(
			'title'          => 'Second Quarter',
			'titleTextStyle' => array(
				'color'    => '#eb6b2c',
				'fontSize' => 14,
			),
			'legend'         => array( 'position' => 'none' ), // No legend as colors are row-specific
			'bar'            => array( 'groupWidth' => '75%' ),
		);

		\Lava::ColumnChart( 'SecondQuarter', $this->q2_graph, $q2_options );

		$q3_options = array(
			'title'          => 'Third Quarter',
			'titleTextStyle' => array(
				'color'    => '#d6336c',
				'fontSize' => 14,
			),
			'legend'         => array( 'position' => 'none' ), // No legend as colors are row-specific
			'bar'            => array( 'groupWidth' => '75%' ),
		);

		\Lava::ColumnChart( 'ThirdQuarter', $this->q3_graph, $q3_options );

		$q4_options = array(
			'title'          => 'Forth Quarter',
			'titleTextStyle' => array(
				'color'    => '#0ca678',
				'fontSize' => 14,
			),
			'legend'         => array( 'position' => 'none' ), // No legend as colors are row-specific
			'bar'            => array( 'groupWidth' => '75%' ),
		);

		\Lava::ColumnChart( 'ForthQuarter', $this->q4_graph, $q4_options );
	}
}
