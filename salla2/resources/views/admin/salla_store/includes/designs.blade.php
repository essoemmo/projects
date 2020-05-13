@push('css')

    <style>
        .card-header h5 {
            color: #5cd5c4;
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 0;
        }
    </style>
@endpush

<div class="row">
    <div class="col-sm-12 ">
        <div class="card">
            <div class="card-header">
                <h5>
                    <i class="ti-layout position-left"></i>
                    {{ _i('Designs') }}  </h5>
                <div class="card-header-right">
                </div>
            </div>
            <div class="card-block">
                <div class="row">
                    @foreach($templates as $template)
                        <div class="col-md-6">

                            <div class="card card-block-small b-l-success  business-info services">
                                <div class="media" >
                                    <div class="media-left" >
                                        <a href="#!">
                                            <img class="img-fluid img-thumbnail" src="{{asset($template['img'])}}" style="height:100px">
                                        </a>
                                    </div>
                                    <div class="media-body" >
                                        <h4 class="media-heading m-b-15">{{$template['title']}} </h4>

                                            @if(in_array($template->id, $user_templates))
                                                <i class="icofont icofont-check-circled text-primary" data-enable="">
                                            <span data-enable="" class="text-primary">{{_i('Already Purchased')}}</span></i>
                                            @else
                                                <form method="POST" action="{{url('adminpanel/template/buy')}}" class="template_id" style="display: inline-block;">
                                                    {{method_field('post')}} @csrf
                                                    <input type="hidden" name="template_id"  value="{{$template['id']}}">
                                                    <input type="hidden" name="template_price"  value="{{$template['price']}}">
                                                    <input type="hidden" name="template_currency"  value="{{\App\Bll\Constants::defaultCurrency}}">

                                                    <button type="submit" class="btn btn-primary m-r-10 m-b-5  ">{{_i('Buy')}} </button>
                                                    <span data-enable="" class="text-primary">{{$template['price'] .' '. \App\Bll\Constants::defaultCurrency}}</span>
                                                </form>
                                            @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach


                </div>
            </div>

        </div>
    </div>
</div>
