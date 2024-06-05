<table class="table table-bordered table-sm">
    <tr>
        <th colspan="4">{{ $product->name }} ({{ $product->product_type->name }} {{ $product->unit_number }} {{ $product->unit->short_code }} )</th>
    </tr>
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