<div class="table-responsive">
<table class="table table-sm table-hover align-middle">
    <thead><tr><th>Barcode</th><th>Product</th><th>Category</th><th class="text-end">Buy</th><th class="text-end">Sell</th><th class="text-end">Stock</th><th class="text-end">Reorder</th><th></th></tr></thead>
    <tbody>
    @forelse($products as $product)
        <tr>
            <td><code>{{ $product->barcode }}</code></td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->category }}</td>
            <td class="text-end">{{ number_format($product->buying_price, 2) }}</td>
            <td class="text-end">{{ number_format($product->selling_price, 2) }}</td>
            <td class="text-end">{{ $product->stock }}</td>
            <td class="text-end">{{ $product->reorder_level }}</td>
            <td class="text-end">@isset($showActions)<a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary">Edit</a>@endisset</td>
        </tr>
    @empty
        <tr><td colspan="8" class="text-center text-muted">No products found.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
