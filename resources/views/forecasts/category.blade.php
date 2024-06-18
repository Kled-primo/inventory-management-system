@extends('layouts.tabler')

@section('content')
<div class="layout-fluid">
    <div class="container-xl">
        <div class="col-md-12">
            <form method="POST" action="{{ route('forecast.exportgeneral') }}">
                    @csrf
                    <input type="hidden" name="year" value={{ $year }} />
                    <input type="hidden" name="is_category" value="1" />
                    <button class="btn btn-success"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                            <path d="M6 12v-2h3v2z" />
                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3z" />
                        </svg> Export</button>
                </form>
        </div>


        <div class="card">
            <div class="card-body">

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-status-top bg-blue"></div>
                            <div class="ribbon bg-blue"> First Quarter</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <table class="table card-table table-vcenter text-nowrap table-sm mt-4">
                                            <thead>
                                                <tr>
                                                    <th>Quarter</th>
                                                    <th>Product</th>
                                                    <th>Sales</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($q1->sortByDesc('total_quantity') as $product_id => $productData)
                                                <tr @if($productData['stype']==1) class="text-success" @else class="text-danger" @endif>
                                                    <td>Quarter 1</td>
                                                    <td>
                                                        <a @if($productData['stype']==1) class="text-success" @else class="text-danger" @endif href="javascript:void(0)" onclick="submitForm({{ $productData['pid'] }})">{{ $productData['name'] }}</a>

                                                    </td>
                                                    <td>{{ $productData['total_quantity'] }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-status-top bg-blue"></div>
                            <div class="card-body">
                                <div id="q1graph" style="width: 100%; height: 500px; align: right;"></div>
                                @columnchart('FirstQuarter', 'q1graph')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-status-top bg-orange"></div>
                            <div class="ribbon bg-orange"> Second Quarter</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <table class="table card-table table-vcenter text-nowrap table-sm mt-4">
                                            <thead>
                                                <tr>
                                                    <th>Quarter</th>
                                                    <th>Product</th>
                                                    <th>Sales</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($q2->sortByDesc('total_quantity') as $product_id => $productData)
                                                <tr @if($productData['stype']==1) class="text-success" @else class="text-danger" @endif>
                                                    <td>Quarter 1</td>
                                                    <td>
                                                        <a @if($productData['stype']==1) class="text-success" @else class="text-danger" @endif href="javascript:void(0)" onclick="submitForm({{ $productData['pid'] }})">{{ $productData['name'] }}</a>

                                                    </td>
                                                    <td>{{ $productData['total_quantity'] }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-status-top bg-orange"></div>
                            <div class="card-body">
                                <div id="q2graph" style="width: 100%; height: 500px; align: right;"></div>
                                @columnchart('SecondQuarter', 'q2graph')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="card">
            <div class="card-body">

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-status-top bg-pink"></div>
                            <div class="ribbon bg-pink"> Third Quarter</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <table class="table card-table table-vcenter text-nowrap table-sm mt-4">
                                            <thead>
                                                <tr>
                                                    <th>Quarter</th>
                                                    <th>Product</th>
                                                    <th>Sales</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($q3->sortByDesc('total_quantity') as $product_id => $productData)
                                                <tr @if($productData['stype']==1) class="text-success" @else class="text-danger" @endif>
                                                    <td>Quarter 1</td>
                                                    <td>
                                                        <a @if($productData['stype']==1) class="text-success" @else class="text-danger" @endif href="javascript:void(0)" onclick="submitForm({{ $productData['pid'] }})">{{ $productData['name'] }}</a>

                                                    </td>
                                                    <td>{{ $productData['total_quantity'] }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-status-top bg-pink"></div>
                            <div class="card-body">
                                <div id="q3graph" style="width: 100%; height: 500px; align: right;"></div>
                                @columnchart('ThirdQuarter', 'q3graph')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="card">
            <div class="card-body">

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-status-top bg-teal"></div>
                            <div class="ribbon bg-teal"> Forth Quarter</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <table class="table card-table table-vcenter text-nowrap table-sm mt-4">
                                            <thead>
                                                <tr>
                                                    <th>Quarter</th>
                                                    <th>Product</th>
                                                    <th>Sales</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($q4->sortByDesc('total_quantity') as $product_id => $productData)
                                                <tr @if($productData['stype']==1) class="text-success" @else class="text-danger" @endif>
                                                    <td>Quarter 1</td>
                                                    <td>
                                                        <a @if($productData['stype']==1) class="text-success" @else class="text-danger" @endif href="javascript:void(0)" onclick="submitForm({{ $productData['pid'] }})">{{ $productData['name'] }}</a>

                                                    </td>
                                                    <td>{{ $productData['total_quantity'] }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-status-top bg-teal"></div>
                            <div class="card-body">
                                <div id="q4graph" style="width: 100%; height: 500px; align: right;"></div>
                                @columnchart('ForthQuarter', 'q4graph')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<form id="dynamicForm" action="{{ route('forecast.individualcategory') }}" method="POST">
    @csrf
    <input type="hidden" name="category_id" id="category_id">
    <input type="hidden" name="year" id="year">
</form>

<script>
    function submitForm(categoryId) {
    document.getElementById('category_id').value = categoryId;
    document.getElementById('year').value = {{ $year }};
    document.getElementById('dynamicForm').submit();
}
</script>

@endsection
