@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Overall Forecast
                    </div>
                    <div class="card-body">
                        <form action="{{ route('forecast.showhistory') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="forecast_year">Forecast Year</label>
                                <select name="year" id="" class="form-select">
                                    @foreach($settings as $setting)
                                    <option value="{{ $setting->value }}">{{ $setting->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-success mt-2" type="submit"> Show History</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Individual Forecast
                    </div>
                    <div class="card-body">
                        <form action="{{ route('forecast.historyindividual') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="forecast_year">Forecast Year</label>
                                <select name="year" id="" class="form-select">
                                    @foreach($settings as $setting)
                                    <option value="{{ $setting->value }}">{{ $setting->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product">Product</label>
                                <select name="product_id" class="form-select">
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->product_type->name }} ( {{ $product->unit_number }} {{ $product->unit->short_code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-success mt-2" type="submit"> Show History</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection