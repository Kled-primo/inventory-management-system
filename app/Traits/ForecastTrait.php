<?php

namespace App\Traits;

use App\Models\OrderDetails;

trait ForecastTrait
{
    public function general($year)
    {

        $order_details = OrderDetails::selectRaw('
                        order_details.product_id,
                        products.name AS product_name,
                        YEAR(order_details.created_at) AS year,
                        MONTH(order_details.created_at) AS month,
                        SUM(order_details.quantity) AS total_quantity
                    ')
                            ->join('products', 'order_details.product_id', '=', 'products.id')
                            ->whereYear('order_details.created_at', $year)
                            ->groupBy('order_details.product_id', 'products.name', 'year', 'month')
                            ->orderBy('order_details.product_id')
                            ->orderBy('year')
                            ->orderBy('month')
                            ->get();

        // Initialize separate collections for each quarter
        $this->q1 = collect();
        $this->q2 = collect();
        $this->q3 = collect();
        $this->q4 = collect();



        // Define a mapping of months to quarters
        $monthToQuarter = [
            1 => 1, 2 => 1, 3 => 1, // Q1
            4 => 2, 5 => 2, 6 => 2, // Q2
            7 => 3, 8 => 3, 9 => 3, // Q3
            10 => 4, 11 => 4, 12 => 4, // Q4
        ];

        //$currentQuarter = $monthToQuarter[date("n")];

        foreach ($order_details as $detail) {
            $quarter = $monthToQuarter[$detail->month];
            switch ($quarter) {
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
            if (!$collection->has($detail->product_id)) {
                $collection->put($detail->product_id, [
                    'pid' => $detail->product_id,
                    'name' => $detail->product_name,
                    'total_quantity' => 0
                ]);
            }

            // Add the total_quantity to the product's total in the quarter
            $productData = $collection->get($detail->product_id);
            $productData['total_quantity'] += $detail->total_quantity;
            $collection->put($detail->product_id, $productData);
        } // loop over product



        // Sort each quarter by total_quantity in descending order
        $this->qbs1 = $this->q1->sortByDesc('total_quantity')->take(10)->map(function ($item) {
            $item['stype'] = '1';
            return $item;
        });
        $this->qbs2 = $this->q2->sortByDesc('total_quantity')->take(10)->map(function ($item) {
            $item['stype'] = '1';
            return $item;
        });
        $this->qbs3 = $this->q3->sortByDesc('total_quantity')->take(10)->map(function ($item) {
            $item['stype'] = '1';
            return $item;
        });
        $this->qbs4 = $this->q4->sortByDesc('total_quantity')->take(10)->map(function ($item) {
            $item['stype'] = '1';
            return $item;
        });

        $this->qls1 = $this->q1->sortBy('total_quantity')->take(10)->map(function ($item) {
            $item['stype'] = '2';
            return $item;
        });
        $this->qls2 = $this->q2->sortBy('total_quantity')->take(10)->map(function ($item) {
            $item['stype'] = '2';
            return $item;
        });
        $this->qls3 = $this->q3->sortBy('total_quantity')->take(10)->map(function ($item) {
            $item['stype'] = '2';
            return $item;
        });
        $this->qls4 = $this->q4->sortBy('total_quantity')->take(10)->map(function ($item) {
            $item['stype'] = '2';
            return $item;
        });

        $this->q1 = $this->qbs1->merge($this->qls1);
        $this->q2 = $this->qbs2->merge($this->qls2);
        $this->q3 = $this->qbs3->merge($this->qls3);
        $this->q4 = $this->qbs4->merge($this->qls4);


        //Display the results for each quarter
        $this->quarters = [
            1 => $this->q1->sortByDesc('total_quantity'),
            2 => $this->q2->sortByDesc('total_quantity'),
            3 => $this->q3->sortByDesc('total_quantity'),
            4 => $this->q4->sortByDesc('total_quantity'),
        ];

    }
}
