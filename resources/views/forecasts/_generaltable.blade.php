<table class="table card-table table-vcenter text-nowrap datatable">
    <thead>
        <tr>
            <th>Quarter</th>
            <th>Product</th>
            <th>Sales</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($q1->sortByDesc('total_quantity') as $product_id => $productData)
        <tr>
            <td>Quarter 1</td>
            <td><a href="{{ route('forecast.product', [$productData['pid'],$year]) }}">{{ $productData['name'] }}</a></td>
            <td>{{ $productData['total_quantity'] }}</td>
        </tr>
        @endforeach
        @foreach ($q2->sortByDesc('total_quantity') as $product_id => $productData)
        <tr>
            <td>Quarter 2</td>
            <td><a href="{{ route('forecast.product', [$productData['pid'],$year]) }}">{{ $productData['name'] }}</a></td>
            <td>{{ $productData['total_quantity'] }}</td>
        </tr>
        @endforeach
        @foreach ($q3->sortByDesc('total_quantity') as $product_id => $productData)
        <tr>
            <td>Quarter 3</td>
            <td><a href="{{ route('forecast.product', [$productData['pid'],$year]) }}">{{ $productData['name'] }}</a></td>
            <td>{{ $productData['total_quantity'] }}</td>
        </tr>
        @endforeach
        @foreach ($q4->sortByDesc('total_quantity') as $product_id => $productData)
        <tr>
            <td>Quarter 4</td>
            <td><a href="{{ route('forecast.product', [$productData['pid'],$year]) }}">{{ $productData['name'] }}</a></td>
            <td>{{ $productData['total_quantity'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>