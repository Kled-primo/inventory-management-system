@extends('layouts.tabler')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Product Forecast') }} - {{ $product->name }}
                </h2>
            </div>
        </div>


    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-4">
                <table class="table table-bordered">
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
            <div class="col-md-8">
                <div id="forecast_div"></div>
            </div>
            <?= \Lava::render('LineChart', 'Forcasts','forecast_div') ?>
        </div>
    </div>
</div>

@endsection