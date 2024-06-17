@extends('layouts.tabler')

@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                    Dashboard
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('orders.create') }}" class="btn btn-primary d-sm-none btn-icon" aria-label="Create new report">
                        <x-icon.plus />
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">

            <div class="col-12">
                <div class="row row-cards">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-primary text-white avatar">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-packages" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                <path d="M2 13.5v5.5l5 3" />
                                                <path d="M7 16.545l5 -3.03" />
                                                <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                <path d="M12 19l5 3" />
                                                <path d="M17 16.5l5 -3" />
                                                <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                                                <path d="M7 5.03v5.455" />
                                                <path d="M12 8l5 -3" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ $products }} Products
                                        </div>
                                        <div class="text-muted">
                                            {{ $categories }} categories
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-green text-white avatar">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M17 17h-11v-14h-2" />
                                                <path d="M6 5l14 1l-1 7h-13" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ $orders }} Orders
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-twitter text-white avatar">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck-delivery" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                                                <path d="M3 9l4 0" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ $purchases }} Purchases
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($twentyfive_products_count > 0)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-danger text-white avatar">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-package-off">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M8.812 4.793l3.188 -1.793l8 4.5v8.5m-2.282 1.784l-5.718 3.216l-8 -4.5v-9l2.223 -1.25" />
                                                <path d="M14.543 10.57l5.457 -3.07" />
                                                <path d="M12 12v9" />
                                                <path d="M12 12l-8 -4.5" />
                                                <path d="M16 5.25l-4.35 2.447m-2.564 1.442l-1.086 .611" />
                                                <path d="M3 3l18 18" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ $twentyfive_products_count }} Product/s
                                        </div>
                                        <div class="text-muted">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#twentyfive-modal">
                                                25% Alert Level
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($fifty_products_count > 0)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-danger text-white avatar">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 9v4" />
                                                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                                                <path d="M12 16h.01" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ $fifty_products_count }} Product/s
                                        </div>
                                        <div class="text-muted">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#fifty-modal">50% Alert Level</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (count($expiring_products)>0)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-danger text-white avatar">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 9v4" />
                                                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                                                <path d="M12 16h.01" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ count($expiring_products) }} Product/s
                                        </div>
                                        <div class="text-muted">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#expiring-modal">Expiring Products</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (count($expired_products) > 0)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-danger text-white avatar">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 9v4" />
                                                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                                                <path d="M12 16h.01" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ count($expired_products) }} Product/s
                                        </div>
                                        <div class="text-muted">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#expired-modal">Expired Products</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <div class="row row-cards">

                </div>
            </div>

            <div class="col-12">
                <div class="row row-cards">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-status-top bg-lime"></div>
                            <div class="card-body">
                                <div class="accordion" id="best-seller-accordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-1">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#best-seller-collapse" aria-expanded="false">
                                                Most Purchased Products ( {{ $year }} )
                                            </button>
                                        </h2>
                                        <div id="best-seller-collapse" class="accordion-collapse collapse" data-bs-parent="#best-seller-accordion" style="">
                                            <div class="accordion-body pt-0">
                                                <ul>
                                                    @foreach($best_sellers as $best_seller)
                                                    @if($best_seller['count'] > 1)
                                                    <li>

                                                        Based on the past forecast you should stock up on {{ $best_seller['name'] }} . It consecutively appeared on the best selling products for the following quarters {{ $best_seller['quarter'] }}.
                                                    </li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-status-top bg-danger"></div>
                            <div class="card-body">
                                <div class="accordion" id="low-seller-accordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-1">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#lowseller_collapse" aria-expanded="false">
                                                Least Purchased Products ( {{ $year }} )
                                            </button>
                                        </h2>
                                        <div id="lowseller_collapse" class="accordion-collapse collapse" data-bs-parent="#low-seller-accordion" style="">
                                            <div class="accordion-body pt-0">
                                                <ul>
                                                    @foreach($low_sellers as $low_seller)
                                                    @if($low_seller['count'] > 1)
                                                    <li>
                                                        Based on the past forecast you should halt stocking up for {{ $low_seller['name'] }} . It has been forecasted to be one of the low selling products for following quarters {{ $low_seller['quarter'] }}.
                                                    </li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">{{ $year }}</h3>
                    </div>
                </div>
            </div>

            @if (count($q1) > 0)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div id="q1graph" style="width: 100%; height: 500px"></div>
                                @columnchart('FirstQuarter', 'q1graph')
                            </div>
                            <div class="col-md-4">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th colspan="2">Quarter 1 (January - March)</th>
                                    </tr>
                                    <tr>
                                        <th>Product</th>
                                        <th>Sales</th>
                                    </tr>
                                    @foreach ($q1->sortByDesc('total_quantity') as $product_id => $productData)
                                    <tr @if($productData['stype']==1) class="bg-lime text-white" @else class="bg-red text-white" @endif>
                                        <td><a class="text-white" href="{{ route('forecast.product', [$productData['pid'],$year]) }}">{{ $productData['name'] }} </a></td>
                                        <td>{{ $productData['total_quantity'] }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if (count($q2) > 0)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div id="q2graph" style="width: 100%; height: 500px"></div>
                                @columnchart('SecondQuarter', 'q2graph')
                            </div>
                            <div class="col-md-4">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th colspan="2">Quarter 2 (April - June)</th>
                                    </tr>
                                    <tr>
                                        <th>Product</th>
                                        <th>Sales</th>
                                    </tr>
                                    @foreach ($q2->sortByDesc('total_quantity') as $product_id => $productData)
                                    <tr @if($productData['stype']==1) class="bg-lime text-white" @else class="bg-red text-white" @endif>
                                        <td><a class="text-white" href="{{ route('forecast.product', [$productData['pid'],$year]) }}">{{ $productData['name'] }}</a></td>
                                        <td>{{ $productData['total_quantity'] }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if (count($q3) > 0)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div id="q3graph" style="width: 100%; height: 500px"></div>
                                @columnchart('ThirdQuarter', 'q3graph')
                            </div>
                            <div class="col-md-4">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th colspan="2">Quarter 3 (July - September)</th>
                                    </tr>
                                    <tr>
                                        <th>Product</th>
                                        <th>Sales</th>
                                    </tr>
                                    @foreach ($q3->sortByDesc('total_quantity') as $product_id => $productData)
                                    <tr @if($productData['stype']==1) class="bg-lime text-white" @else class="bg-red text-white" @endif>
                                        <td><a class="text-white" href="{{ route('forecast.product', [$productData['pid'],$year]) }}">{{ $productData['name'] }}</a></td>
                                        <td>{{ $productData['total_quantity'] }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if (count($q4) > 0)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div id="q4graph" style="width: 100%; height: 500px"></div>
                                @columnchart('ForthQuarter', 'q4graph')
                            </div>
                            <div class="col-md-4">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th colspan="2">Quarter 4 (October - December)</th>
                                    </tr>
                                    <tr>
                                        <th>Product</th>
                                        <th>Sales</th>
                                    </tr>
                                    @foreach ($q4->sortByDesc('total_quantity') as $product_id => $productData)
                                    <tr @if($productData['stype']==1) class="bg-lime text-white" @else class="bg-red text-white" @endif>
                                        <td><a class="text-white" href="{{ route('forecast.product', [$productData['pid'],$year]) }}">{{ $productData['name'] }}</a></td>
                                        <td>{{ $productData['total_quantity'] }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endif

        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="fifty-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">50% Alert Level Product/s</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-sm">
                    <tr>
                        <th>Product Name</th>
                        <th>Remaining Quantity</th>
                        <th>&nbsp;</th>
                    </tr>
                    @foreach($fifty_products as $f_product)
                    <tr>
                        <td>{{ $f_product->name }}</td>
                        <td>{{ $f_product->quantity }}</td>
                        <td><a href="{{ route('purchases.create') }}" class="btn btn-success btn-sm">Purchase</a></td>
                    </tr>
                    @endforeach
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="twentyfive-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">25% Alert Level Product/s</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-sm">
                    <tr>
                        <th>Product Name</th>
                        <th>Remaining Quantity</th>
                        <th>&nbsp;</th>
                    </tr>
                    @foreach($twentyfive_products as $tf_product)
                    <tr>
                        <td>{{ $tf_product->name }}</td>
                        <td>{{ $tf_product->quantity }}</td>
                        <td><a href="{{ route('purchases.create') }}" class="btn btn-success btn-sm">Purchase</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="expiring-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Expiring Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-sm">
                    <tr>
                        <th class="col-md-4">Product Name</th>
                        <th class="col-md-4">Manufacturing Date</th>
                        <th class="col-md-4">Expiry Date</th>

                    </tr>
                    @foreach($expiring_products as $expiring_product)
                    <tr>
                        <td>{{ $expiring_product->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($expiring_product->manufacturing_date)->format('M d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($expiring_product->expiry_date)->format('M d, Y') }} ( {{ \Carbon\Carbon::parse($expiring_product->expiry_date)->diffforHumans() }} )</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="expired-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Expired Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg>
                    WARNING the following products already expired. Please properly dispose the product/s immediately.
                </div>
                <table class="table table-bordered table-sm">
                    <tr>
                        <th>Product Name</th>
                        <th>Manufacturing Date</th>
                        <th>Expiry Date</th>

                    </tr>
                    @foreach($expired_products as $expired_product)
                    <tr>
                        <td>{{ $expired_product->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($expired_product->manufacturing_date)->format('M d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($expired_product->expiry_date)->format('M d, Y') }} (
                            {{ \Carbon\Carbon::parse($expired_product->expiry_date)->diffforHumans(['options'=>0]) }} )</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('page-libraries')
<script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
<script src="{{ asset('dist/libs/jsvectormap/dist/js/jsvectormap.min.js') }}" defer></script>
<script src="{{ asset('dist/libs/jsvectormap/dist/maps/world.js') }}" defer></script>
<script src="{{ asset('dist/libs/jsvectormap/dist/maps/world-merc.js') }}" defer></script>
@endpush

@pushonce('page-scripts')
<script>
    // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-revenue-bg'), {
                chart: {
                    type: "area",
                    fontFamily: 'inherit',
                    height: 40.0,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: .16,
                    type: 'solid'
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "smooth",
                },
                series: [{
                    name: "Profits",
                    data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93,
                        53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67
                    ]
                }],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [
                    '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24',
                    '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29',
                    '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04',
                    '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09',
                    '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14',
                    '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                ],
                colors: [tabler.getColor("primary")],
                legend: {
                    show: false,
                },
            })).render();
        });
        // @formatter:on
</script>
<script>
    // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-new-clients'), {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 40.0,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                fill: {
                    opacity: 1,
                },
                stroke: {
                    width: [2, 1],
                    dashArray: [0, 3],
                    lineCap: "round",
                    curve: "smooth",
                },
                series: [{
                    name: "May",
                    data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93,
                        53, 61, 27, 54, 43, 4, 46, 39, 62, 51, 35, 41, 67
                    ]
                }, {
                    name: "April",
                    data: [93, 54, 51, 24, 35, 35, 31, 67, 19, 43, 28, 36, 62, 61, 27, 39, 35,
                        41, 27, 35, 51, 46, 62, 37, 44, 53, 41, 65, 39, 37
                    ]
                }],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [
                    '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24',
                    '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29',
                    '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04',
                    '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09',
                    '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14',
                    '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                ],
                colors: [tabler.getColor("primary"), tabler.getColor("gray-600")],
                legend: {
                    show: false,
                },
            })).render();
        });
        // @formatter:on
</script>
<script>
    // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-active-users'), {
                chart: {
                    type: "bar",
                    fontFamily: 'inherit',
                    height: 40.0,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%',
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: 1,
                },
                series: [{
                    name: "Profits",
                    data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93,
                        53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67
                    ]
                }],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [
                    '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24',
                    '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29',
                    '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04',
                    '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09',
                    '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14',
                    '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                ],
                colors: [tabler.getColor("primary")],
                legend: {
                    show: false,
                },
            })).render();
        });
        // @formatter:on
</script>
@endpushonce
