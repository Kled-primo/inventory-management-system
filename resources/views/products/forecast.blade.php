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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                @include('forecasts._individualproduct')

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                @include('forecasts._individualquarter')

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