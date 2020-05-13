@if(count($products) > 0)

    @foreach($products as $product)

        <div class="col-md-3 col-xl-3">
            <div class="card widget-profile-card-2">
                <img class="img-fluid" src="{{ asset($product->mainPhoto()) }}" alt="card-style-1">
                <div class="card-footer bg-inverse">
                </div>
                <input type="hidden" form="save_sort" class="sort" name="sort[]"
                       value="{{ $product->sort == 0 ? $sort++ : $product->sort }}">
                <input type="hidden" form="save_sort" name="product_id[]" value="{{ $product->id }}">
                <div class="card-block text-center">
                    <h3>{{ ($product->product_details()->first() != null) ? $product->product_details()->first()->title : "" }}</h3>
                    <p>{{ _i('Quantity') }} : {{ $product->max_count }}</p>
                </div>
            </div>
        </div>
    @endforeach

@else

    <div class="col-12" id='no-items'>
        <div class="alert alert-danger text-center">
            <p class="lead">{{ _i('No Products') }}</p>
        </div>
    </div>

@endif

