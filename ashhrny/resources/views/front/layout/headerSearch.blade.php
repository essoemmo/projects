<div class="top-search grade">
    <div class="container">
        <form action="{{url('/search')}}" method="get">

            @honeypot {{--prevent form spam--}}

            <div class="row">
                <div class="col-md-3">

                    <select title="test" class="custom-select" id="gender" name="gender">
                        <option disabled selected>{{_i('Gender')}}</option>
                        <option value="male">{{_i('Male')}}</option>
                        <option value="female">{{_i('Female')}}</option>
                    </select>

                </div>
                @php
                    $social_links = \App\Models\Social_link::LeftJoin('social_links_translations','social_links_translations.social_id','=','social_links.id')
                    ->select('social_links_translations.title as title' ,'social_links.id as id' ,'social_links.icon')
                    ->where('locale',\Illuminate\Support\Facades\App::getLocale())->get();

                    $countries = \App\Models\Country::leftJoin('countries_translations','countries_translations.country_id','=','countries.id')
                    ->select('countries_translations.title as title' ,'countries.id as id')
                    ->where('locale',\Illuminate\Support\Facades\App::getLocale())->get();
                @endphp
                <div class="col-md-3">
                    <select title="" class="custom-select" id="country_id" name="country_id">
                        <option disabled selected>{{_i('Country')}}</option>
                        @foreach($countries as $country)
                            <option title="" value="{{$country['id']}}">{{$country['title']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select title="" class="custom-select" id="social_id" name="social_id">
                        <option disabled selected>{{_i('Social Account')}}</option>
                        @foreach($social_links as $social)
                            <option value="{{$social['id']}}">{{$social['title']}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-md-3">

                    <input title="search" type="submit" class="btn btn-white btn-block" value="{{_i('Search')}}">

                </div>
            </div>
        </form>
    </div>
</div>

@push('js')

    <script>
        {{--$("#gender").on('change' , function(){--}}
        {{--    var gender = $(this).val();--}}
        {{--    $.ajax({--}}
        {{--        url: "{{url('/search')}}",--}}
        {{--        method: 'GET',--}}
        {{--        DataType: 'json',--}}
        {{--        data : {gender_type: gender},--}}
        {{--        success: function (res) {--}}
        {{--            //window.location.reload();--}}
        {{--            $('#all_content').html(res);--}}
        {{--        }--}}

        {{--    });--}}
        {{--});--}}
        $("#header_search_form").submit(function (e) {
            e.preventDefault();
            // var gender = $(this).val();
            //var form = $( "#header_search_form" ).serialize(this);
            var form = $("#header_search_form").serialize;
            $.ajax({
                url: "{{url('/search')}}",
                method: 'POST',
                DataType: 'json',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function (res) {
                    //window.location.reload();
                    $('#all_content').html(res);
                }

            });
        });
    </script>
@endpush
