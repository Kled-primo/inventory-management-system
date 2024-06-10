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
        <tr class="text-success">
            <td>Quarter 1</td>
            <td>
                <a href="javascript:void(0)" onclick="submitForm({{ $productData['pid'] }})" class="text-success">{{ $productData['name'] }}</a>
            </td>
            <td>{{ $productData['total_quantity'] }}</td>
        </tr>
        @endforeach
        @foreach ($q2->sortByDesc('total_quantity') as $product_id => $productData)
        <tr class="text-info">
            <td>Quarter 2</td>
            <td>
                <a href="javascript:void(0)" onclick="submitForm({{ $productData['pid'] }})" class="text-info">
                    {{ $productData['name'] }}
                </a>
            </td>
            <td>{{ $productData['total_quantity'] }}</td>
        </tr>
        @endforeach
        @foreach ($q3->sortByDesc('total_quantity') as $product_id => $productData)
        <tr class="text-warning">
            <td>Quarter 3</td>
            <td>
                <a href="javascript:void(0)" onclick="submitForm({{ $productData['pid'] }})" class="text-warning">
                    {{ $productData['name'] }}
                </a>
            </td>
            <td>{{ $productData['total_quantity'] }}</td>
        </tr>
        @endforeach
        @foreach ($q4->sortByDesc('total_quantity') as $product_id => $productData)
        <tr class="text-primary">
            <td>Quarter 4</td>
            <td>
                <a href="javascript:void(0)" onclick="submitForm({{ $productData['pid'] }})" class="text-primary">
                    {{ $productData['name'] }}
                </a>
            </td>
            <td>{{ $productData['total_quantity'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

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
