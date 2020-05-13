@extends('admin.AdminLayout.index')
@section('title')
    {{_i('Arrange Products')}}
@endsection

@section('page_header_name')
    {{_i('Arrange Products')}}
@endsection

@push('css')

    <style>
        body.dragging, body.dragging * {
            cursor: move !important;
        }

        .dragged {
            position: absolute;
            opacity: 0.5;
            z-index: 2000;
        }

        ol.example li.placeholder {
            position: relative;
            /** More li styles **/
        }

        ol.example li.placeholder:before {
            position: absolute;
            /** Define arrowhead **/
        }
    </style>

@endpush


@section('content')

    <div class="products-lists">

        <form action="{{ route('saveSort') }}" class="row" id="save_sort" method="POST">
            @csrf
        </form>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <label for="categories"></label>
                        <div class="col-md-8">
                            <select name="category_id" form="save_sort" class="form-control selectpicker"
                                    id="categories"
                                    data-live-search="true" title="{{ _i('Choose Category') }}">
                                @if(count($cats) > 0)
                                    @foreach($cats as $index => $category)
                                        <option value="{{ $index }}">{{ $category }}</option>
                                    @endforeach
                                @else
                                    <option disabled> {{ _i('No Categories') }}</option>
                                @endif
                            </select>
                        </div>
                        <button class="btn btn-primary col-md-4" form="save_sort"
                                type="submit">{{ _i('Save Sort') }}</button>
                    </div>
                </div>
            </div>

            <div id="allProducts_div" class="row mt-4">
                @include('admin.products.products.ajax.arrangeProduct_ajax')
            </div>
        </div>

    </div>


@endsection

@push('js')

    <script>
        $('#categories').on('change', function () {
            var id = $(this).val();
            $.ajax({
                url: '{{ route('arrangeProductsChange') }}',
                method: 'GET',
                DataType: 'json',
                data: {id: id},
                success: function (res) {
                    $('#allProducts_div').html(res);
                    $(function () {
                        $('#allProducts_div').sortable({
                            stop: function () {
                                var inputs = $('input.sort');
                                var nbElems = inputs.length;
                                $('input.sort').each(function (idx) {
                                    $(this).val(nbElems - idx);
                                });
                            }
                        });
                    });
                }
            })
        });
    </script>

@endpush

