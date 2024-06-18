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
<div class="row mt-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-status-top bg-orange"></div>
            <div class="ribbon bg-orange"> Second Quarter</div>
            <div class="card-body">
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
                            <td>Quarter 2</td>
                            <td>
                                <a @if($productData['stype']==1) class="text-success" @else class="text-danger" @endif href="javascript:void(0)" onclick="submitForm({{ $productData['pid'] }})">
                                    {{ $productData['name'] }}
                                </a>
                            </td>
                            <td>{{ $productData['total_quantity'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-status-top bg-orange"></div>
            <div class="card-body">
                <div id="q2graph" style="width: 100%; height: 500px"></div>
                @columnchart('SecondQuarter', 'q2graph')
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-status-top bg-pink"></div>
            <div class="ribbon bg-pink"> Third Quarter</div>
            <div class="card-body">
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
                            <td>Quarter 3</td>
                            <td>
                                <a href="javascript:void(0)" onclick="submitForm({{ $productData['pid'] }})" @if($productData['stype']==1) class="text-success" @else class="text-danger" @endif>
                                    {{ $productData['name'] }}
                                </a>
                            </td>
                            <td>{{ $productData['total_quantity'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-status-top bg-pink"></div>
            <div class="card-body">
                <div class="card-body">
                <div id="q3graph" style="width: 100%; height: 500px"></div>
                @columnchart('ThirdQuarter', 'q3graph')
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-status-top bg-teal"></div>
            <div class="ribbon bg-teal"> Forth Quarter</div>
            <div class="card-body">
                <table class="table card-table table-vcenter text-nowrap mt-4 table-sm">
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
                            <td>Quarter 4</td>
                            <td>
                                <a href="javascript:void(0)" onclick="submitForm({{ $productData['pid'] }})" @if($productData['stype']==1) class="text-success" @else class="text-danger" @endif>
                                    {{ $productData['name'] }}
                                </a>
                            </td>
                            <td>{{ $productData['total_quantity'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-status-top bg-teal"></div>
            <div class="card-body">
                <div id="q4graph" style="width: 100%; height: 500px"></div>
                @columnchart('ForthQuarter', 'q4graph')
                </div>
            </div>
        </div>
    </div>
</div>






<form id="dynamicForm" action="{{ route('forecast.historyindividual') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" id="product_id">
    <input type="hidden" name="year" id="year">
</form>

<script>
    function submitForm(productId) {
    document.getElementById('product_id').value = productId;
    document.getElementById('year').value = {{ $year }};
    document.getElementById('dynamicForm').submit();
}
</script>
