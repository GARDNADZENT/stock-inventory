<div id="line-items" class="vstack gap-2">
    <div class="row g-2 align-items-end" data-line-item>
        <div class="col-md-3"><label class="form-label">Barcode</label><input name="items[0][barcode]" class="form-control" data-barcode-input required autofocus></div>
        <div class="col-md-3"><label class="form-label">Product</label><div class="form-control bg-light" data-product-name>Scan barcode</div></div>
        @if($mode === 'stock_take')
            <div class="col-md-2"><label class="form-label">System Qty</label><input class="form-control" data-system-quantity readonly></div>
            <div class="col-md-2"><label class="form-label">Counted Qty</label><input type="number" min="0" name="items[0][counted_quantity]" class="form-control" required></div>
        @else
            <div class="col-md-2"><label class="form-label">Qty</label><input type="number" min="1" name="items[0][quantity]" class="form-control" required></div>
            <div class="col-md-2"><label class="form-label">{{ $mode === 'sale' ? 'Selling' : 'Buying' }} Price</label><input type="number" min="0" step="0.01" name="items[0][{{ $mode === 'sale' ? 'selling_price' : 'buying_price' }}]" class="form-control" data-price data-mode="{{ $mode }}" required></div>
        @endif
    </div>
</div>
<button type="button" class="btn btn-outline-secondary mt-3" onclick="addLineItem()">Add Line</button>
@push('scripts')
<script>
let lineIndex = 1;
function addLineItem() {
    const first = document.querySelector('#line-items [data-line-item]');
    const clone = first.cloneNode(true);
    clone.querySelectorAll('input').forEach(input => {
        input.name = input.name.replace(/items\[\d+\]/, `items[${lineIndex}]`);
        input.value = '';
    });
    clone.querySelector('[data-product-name]').textContent = 'Scan barcode';
    document.getElementById('line-items').appendChild(clone);
    lineIndex++;
}
</script>
@endpush
