@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-body">
                        <div class="d-flex">
                            Monthly Summary
                            <div class="ms-auto">
                                <form method="POST" action="{{ route('forecast.exportindividualmonthly') }}">
                                    @csrf
                                    <input type="hidden" name="year" value={{ $year }} />
                                    <input type="hidden" name="product_id" value={{ $product->id }} />
                                    <input type="hidden" name="is_category" value="1" />
                                    <button class="btn btn-success"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                                            <path d="M6 12v-2h3v2z" />
                                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3z" />
                                        </svg> Export</button>
                                </form>
                            </div>
                        </div>
                        <hr />
                        @include('forecasts._individualproduct')
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            Quarterly Summary
                            <div class="ms-auto">
                                <form method="POST" action="{{ route('forecast.exportindividualquarterly') }}">
                                    @csrf
                                    <input type="hidden" name="year" value={{ $year }} />
                                    <input type="hidden" name="product_id" value={{ $product->id }} />
                                    <input type="hidden" name="is_category" value="1" />
                                    <button class="btn btn-success"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                                            <path d="M6 12v-2h3v2z" />
                                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3z" />
                                        </svg> Export</button>
                                </form>
                            </div>
                        </div>
                        <hr />
                        @include('forecasts._individualquarter')
                    </div>
                </div>
            </div>

        </div>
        <div class="row mt-2">
            <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="forecast_div" style="width: 100%; height: 500px"></div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@linechart('Forecasts','forecast_div')

@endsection
