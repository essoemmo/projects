<div>
    <input type="hidden" form="saveOrder" name="user" value="{{ auth()->user()->id }}">

    <input type="hidden" form="saveOrder" name="ordernumber" value="{{ $number }}">

    <input type="hidden" name="shipping_cost" class="shipping_cost" form="saveOrder">
    <input type="hidden" name="discount_id" class="discount_id" form="saveOrder">
    <input type="hidden" name="discount_cost" class="discount_cost" form="saveOrder">

    @foreach(Cart::content() as $item)
        <input type="hidden" form="saveOrder" name="product[]" value="{{ $item->id }}">
        <input type="hidden" form="saveOrder" name="count_{{ $item->id }}" value="{{ $item->qty }}">
        <input type="hidden" form="saveOrder" name="price_{{ $item->id }}" value="{{ $item->price }}">
        <input class="total_after" form="saveOrder" type="hidden" name="total" value="{{ Cart::total() }}">
    @endforeach
</div>
