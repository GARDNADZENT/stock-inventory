@csrf
<div class="row g-3">
    <div class="col-md-4"><label class="form-label">Barcode</label><input name="barcode" value="{{ old('barcode', $product->barcode) }}" class="form-control" data-barcode-input required autofocus></div>
    <div class="col-md-8"><label class="form-label">Product Name</label><input name="product_name" value="{{ old('product_name', $product->product_name) }}" class="form-control" required></div>
    <div class="col-md-4"><label class="form-label">Category</label><input name="category" value="{{ old('category', $product->category) }}" class="form-control"></div>
    <div class="col-md-2"><label class="form-label">Buying Price</label><input type="number" step="0.01" name="buying_price" value="{{ old('buying_price', $product->buying_price) }}" class="form-control" required></div>
    <div class="col-md-2"><label class="form-label">Selling Price</label><input type="number" step="0.01" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" class="form-control" required></div>
    <div class="col-md-2"><label class="form-label">Stock</label><input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" class="form-control" required></div>
    <div class="col-md-2"><label class="form-label">Reorder Level</label><input type="number" name="reorder_level" value="{{ old('reorder_level', $product->reorder_level ?? 0) }}" class="form-control" required></div>
</div>
<div class="mt-3 d-flex gap-2">
    <button class="btn btn-success">Save</button>
    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
