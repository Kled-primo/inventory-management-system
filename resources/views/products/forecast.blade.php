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
    <div class="row row-card">

        <div id="forecast_div" style="width: 900px; height: 500px"></div>

        <table class="table table-bordered table-sm" style="width: 100px;">
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


@linechart('Forecasts','forecast_div')




@endsection