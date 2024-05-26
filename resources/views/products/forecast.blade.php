@extends('layouts.tabler')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-1">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Product Forecast') }} - {{ $product->name }}
                </h2>
            </div>
        </div>


    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div id="forecast_div" style="width: 100%; height: 500px"></div>
            </div>
        </div>


        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Sales</th>
                                        <th>Forecast</th>
                                    </tr>
                                    @foreach($product_forecasts as $forecast)
                                    <tr>
                                        <td>{{ $forecast['year'] }}</td>
                                        <td>{{ date("F",mktime(0,0,0, $forecast['month'], 10)) }}</td>
                                        <td>{{ $forecast['sales'] }}</td>
                                        <td>{{ number_format($forecast['forecast'],2) }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th class="text-center">Quarter</th>
                                        <th class="text-center">Sales</th>
                                    </tr>
                                    @foreach($quarters as $quarter => $total)
                                    <tr>
                                        <td class="text-center">{{ $quarter }}</td>
                                        <td class="text-center">{{ $total }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@linechart('Forecasts','forecast_div')


@endsection