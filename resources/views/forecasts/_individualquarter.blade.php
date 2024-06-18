<table class="table table-bordered table-sm">
    <tr>
        <th colspan="2">{{ $product->name }} ({{ $product->product_type->name ?? "" }} {{ $product->unit_number ?? "" }} {{ $product->unit->short_code ?? "" }} )</th>
    </tr>
    <tr>
        <th class="text-center">Quarter</th>
        <th class="text-center">Sales</th>
    </tr>
    @foreach($quarters as $quarter => $total)
    <tr>
        <td class="text-center">{{ $quarter }}</td>
        <td class="text-center">{{ $total }}</td>
    </tr>
    @endforeach
</table>
