
@if($shipping_options != null)

    <div class="modal fade modal_create" id="free_shipping" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <h5 class="modal-title">{{_i('Campaign Conditions')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="save_shipping_company" method="POST" action="{{url('adminpanel/save_shipping_company')}}" data-parsley-validate="">
                    @csrf
                    <input type="hidden" name="free_shipping" value="1">

                    <div class="modal-body p-b-0">

                        <div class="form-group row ">
                            <div class="col-sm-12">
                                <label style="color: #58c0e9;">{{_i('You can select the city or country that supports free shipping for it if purchases exceed the minimum you specify')}}</label>
                            </div>
                        </div>

                        @foreach($shipping_options as $single_option)
                        <div class="section_condition_add">

                            <div class="single_section_condition">
                                <div class="form-group row ">
                                    <div class="col-sm-12">
                                        <div class="input-group ">
                                            <select class="form-control country_id" name="country_id[]" onchange="get_cities()" required="">
                                                <option  value="all" {{$single_option['country_id'] == "null" ? "selected": ""}}>{{_i('All Countries')}}</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}" {{$country->id==$single_option['country_id'] ? "selected": ""}} >{{$country->title}}</option>
                                                @endforeach

                                            </select>
                                            <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                                <i class="ti ti-map"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!--------------------------- cities--------------------->

                                <div class="form-group row ">
                                    <div class="col-sm-12">
                                        <div class="input-group ">
                                            <select class="form-control selectpicker city_id" multiple="multiple" name="city_id[]" required="" >
                                                <option  value="all" {{$single_option->cities[0]['id'] == "null"? "selected":""}}>{{_i('All Cities')}}</option>
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}" {{$city->id == $single_option->cities[0]['id'] ? "selected":""}}>{{$city->title}}</option>
                                                @endforeach
                                            </select>
                                            <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                                  <i class="ti ti-map-alt"></i>
                                            </span>

                                        </div>
                                    </div>
                                </div>

                                <!--------------------------- Minimum purchases --------------------->
                                <div class="form-group row ">
                                    <div class="col-sm-12">
                                        <div class="input-group ">
                                            <input class="form-control " name="minimum_purchases" value="{{$single_option['minimum_purchases']}}" placeholder="{{_i('Minimum purchases')}}" required="">
                                            <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                                 <i class="ti ti-money"></i>
                                            </span>
                                            <button type="button" class="btn btn-tiffany btn-sm mr-3 ">{{_i('SR')}}</button>
                                        </div>
                                    </div>
                                </div>

                                <!--------------------------- delete condition --------------------->
{{--                                <input type="hidden" name="shipping_option_id" value="{{$single_option['id']}}">--}}

                                <div class="form-group row ">
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-danger " onclick="delete_saved_section_condition(this , {{$single_option['id']}})"  >
                                            <i class="fa fa-times"></i> {{_i('Delete Condition')}}
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach

                        <div class="form-group row ">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-primary add_condition" ><i class="fa fa-plus"></i> {{_i('Add Condition')}}</button>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary save ">{{_i('Save')}}</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{_i('Close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@else
    <!--------------------------- no shipping options saved -------------------------------------->
    <div class="modal fade modal_create" id="free_shipping" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <h5 class="modal-title">{{_i('Campaign Conditions')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="save_shipping_company" method="POST" action="{{url('adminpanel/save_shipping_company')}}" data-parsley-validate="">
                    @csrf
                    <input type="hidden" name="free_shipping" value="1">

                    <div class="modal-body p-b-0">

                        <div class="form-group row ">
                            <div class="col-sm-12">
                                <label style="color: #58c0e9;">{{_i('You can select the city or country that supports free shipping for it if purchases exceed the minimum you specify')}}</label>
                            </div>
                        </div>

                        <div class="section_condition_add">

                            {{--                       <div class="single_section_condition">--}}
                            {{--                           <div class="form-group row ">--}}
                            {{--                               <div class="col-sm-12">--}}
                            {{--                                   <div class="input-group ">--}}
                            {{--                                       <select class="form-control country_id" name="country_id" onchange="get_cities()">--}}
                            {{--                                           <option selected value="all" >{{_i('All Countries')}}</option>--}}
                            {{--                                           @foreach($countries as $country)--}}
                            {{--                                               <option value="{{$country->id}}" >{{$country->title}}</option>--}}
                            {{--                                           @endforeach--}}

                            {{--                                       </select>--}}
                            {{--                                       <span class="input-group-addon input-group-addon-small" id="basic-addon5">--}}
                            {{--                                            <i class="ti ti-map"></i>--}}
                            {{--                                   </span>--}}
                            {{--                                   </div>--}}
                            {{--                               </div>--}}
                            {{--                           </div>--}}

                            {{--                           <!--------------------------- cities--------------------->--}}
                            {{--                           <div class="form-group row ">--}}
                            {{--                               <div class="col-sm-12">--}}
                            {{--                                   <div class="input-group ">--}}
                            {{--                                       <select class="form-control selectpicker city_id" multiple="multiple" name="city_id[]" >--}}
                            {{--                                           <option selected value="all">{{_i('All Cities')}}</option>--}}
                            {{--                                           @foreach($cities as $city)--}}
                            {{--                                               <option value="{{$city->id}}" id="gender">{{$city->title}}</option>--}}
                            {{--                                           @endforeach--}}
                            {{--                                       </select>--}}
                            {{--                                       <span class="input-group-addon input-group-addon-small" id="basic-addon5">--}}
                            {{--                                                                               <i class="ti ti-map-alt"></i>--}}
                            {{--                                                                      </span>--}}

                            {{--                                   </div>--}}
                            {{--                               </div>--}}
                            {{--                           </div>--}}

                            {{--                           <!--------------------------- Minimum purchases --------------------->--}}
                            {{--                           <div class="form-group row ">--}}
                            {{--                               <div class="col-sm-12">--}}
                            {{--                                   <div class="input-group ">--}}
                            {{--                                       <input class="form-control " name="minimum_purchases" placeholder="{{_i('Minimum purchases')}}">--}}
                            {{--                                       <span class="input-group-addon input-group-addon-small" id="basic-addon5">--}}
                            {{--                                            <i class="ti ti-money"></i>--}}
                            {{--                                   </span>--}}
                            {{--                                       <button type="button" class="btn btn-tiffany btn-sm mr-3 ">{{_i('SR')}}</button>--}}
                            {{--                                   </div>--}}
                            {{--                               </div>--}}
                            {{--                           </div>--}}

                            {{--                           <!--------------------------- delete condition --------------------->--}}
                            {{--                           <div class="form-group row ">--}}
                            {{--                               <div class="col-sm-12">--}}
                            {{--                                   <button type="button" class="btn btn-danger " ><i class="fa fa-times"></i> {{_i('Delete Condition')}}</button>--}}
                            {{--                               </div>--}}
                            {{--                           </div>--}}
                            {{--                       </div>--}}

                        </div>

                        <div class="form-group row ">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-primary add_condition" ><i class="fa fa-plus"></i> {{_i('Add Condition')}}</button>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary save ">{{_i('Save')}}</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{_i('Close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endif



@push('js')
    <script>

        $('body').on('click','.add_condition', function () {

            var section_condition_add="section_condition_add";
            var html='';
            html += ' <div class="single_section_condition">';

            html += '<div class="form-group row "> <div class="col-sm-12"> <div class="input-group ">';
            html += '<select class="form-control country_id" name="country_id[]" onchange="get_cities(this)" >';
            html += '<option selected value="all" >{{_i('All Countries')}}</option>';
            @foreach($countries as $country)
            html += '<option value="{{$country->id}}" >{{$country->title}}</option>';
            @endforeach
            html += '</select>';
            html += '<span class="input-group-addon input-group-addon-small" id="basic-addon5"> <i class="ti ti-map"></i></span>';
            html += '</div> </div> </div>';

        //<!--------------------------- cities--------------------->
            html += '<div class="form-group row "> <div class="col-sm-12"> <div class="input-group ">';
           // html += '<select class="form-control selectpicker city_id" multiple="multiple" name="city_id[]" >';
            html += '<select class="form-control  city_id"  name="city_id[]" >';
            html += '<option selected value="all">{{_i('All Cities')}}</option>';
            html += '</select>';
            html += '<span class="input-group-addon input-group-addon-small" id="basic-addon5"> <i class="ti ti-map-alt"></i></span>';
            html += '</div> </div> </div>';

        //<!--------------------------- Minimum purchases --------------------->
            html += '<div class="form-group row "> <div class="col-sm-12"> <div class="input-group ">';
            html += '<input type="number" class="form-control " name="minimum_purchases[]" placeholder="{{_i('Minimum purchases')}}" required="">';
            html += '<span class="input-group-addon input-group-addon-small" id="basic-addon5"><i class="ti ti-money"></i></span>';
            html += '<button type="button" class="btn btn-tiffany btn-sm mr-3 ">{{_i('SR')}}</button>';
            html += '</div> </div> </div>';

            //<!--------------------------- delete condition --------------------->
            html += '<div class="form-group row "> <div class="col-sm-12">';
            html += '<button type="button" class="btn btn-danger " onclick="delete_section_condition(this)" ><i class="fa fa-times"></i> {{_i('Delete Condition')}}</button>';
            html += '</div> </div>';

            html += '</div> ';

            $('.'+section_condition_add).prepend(html);
           // $('.city_id').selectpicker('refresh');

        });

        function delete_section_condition(obj) {
            $(obj).closest('.single_section_condition').remove();
        }

        function delete_saved_section_condition(obj,option_id) {

            //console.log(option_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ url('adminpanel/shipping_option/delete') }}',
                data: {
                    '_method': 'DELETE',
                    'optionId': option_id
                },
                type: "POST",
                success: function (response) {
                    $(obj).closest('.single_section_condition').remove();
                    $('.modal.modal_create').modal('hide');

                    Swal.fire({
                        //position: 'top-end',
                        icon: 'success',
                        title: '{{_i("Deleted Successfully")}}',
                        showConfirmButton: false,
                        timer: 5000
                    });

                }
            });
        }



        function get_cities(obj) {

            var cityId = $(obj).closest('.single_section_condition').find('.city_id');
            //console.log(cityId)
            var countryId = $('.country_id').val();
            $.ajax({
                url: '{{ url('adminpanel/get_cities') }}',
                method: "get",
                data: {
                    country_id: countryId,
                },
                success: function (response) {
                    cityId.empty();

                    var html = '';
                    cityId.append('<option selected value="all">{{_i('All Cities')}}</option>');
                    $.each(response , function (key , row) {
                        html += '<option  value=" '+row.id+' ">'+row.title+'</option>';
                        //$('.city_id').append('<option  value=" '+row.id+' ">'+row.title+'</option>');

                    });
                    cityId.append(html);

                }
            });
        }




        function get_citiesOld() {

            var countryId = $('.country_id').val();
            $.ajax({
                url: '{{ url('adminpanel/get_cities') }}',
                method: "get",
                data: {
                    country_id: countryId,
                },
                success: function (response) {
                    //$(".city_id").html(response).selectpicker('refresh');
                    $('.city_id').empty();
                    // $('.selectpicker').selectpicker();
                    // $('.picker').selectpicker('refresh');
                    //$('.city_id').selectpicker('refresh');
                    //$('.city_id').addClass("selectpicker").selectpicker('refresh');

                    // $('.city_id').addClass("selectpicker");
                    var html = '';
                    $('.city_id').append('<option selected value="all">{{_i('All Cities')}}</option>');
                    $.each(response , function (key , row) {
                        html += '<option  value=" '+row.id+' ">'+row.title+'</option>';
                        //$('.city_id').append('<option  value=" '+row.id+' ">'+row.title+'</option>');

                    });
                    $('.city_id').append(html);
                    //$('.city_id').selectpicker('refresh');

                    // $('.city_id').addClass('selectpicker');
                    // $('.city_id').attr('data-live-search', 'true');
                    // $('.city_id').selectpicker('refresh');
                    // $('.selectpicker').selectpicker('refresh');




                    // $('.city_id').selectpicker('refresh');
                    // $('.selectpicker').selectpicker('render');
                    // $('.selectpicker').selectpicker('val', ['Mustard','Relish']);
                    // $('.selectpicker').addClass('col-lg-12').selectpicker('setStyle');



                    //var html = '';
                    //$.each(response , function (key , row) {
                    //html += '<option  value=" '+row.id+' ">'+row.title+'</option>';
                    //$('.city_id').append('<option  value=" '+row.id+' ">'+row.title+'</option>');
                    // $(".city_id")
                    //     .html('<option  value=" '+row.id+' ">'+row.title+'</option>')
                    //     .selectpicker('refresh');
                    //});
                    //$(".city_id").html(html)
                    //.selectpicker('refresh');

                    //$('.city_id').selectpicker('refresh');
                    // $('.picker').selectpicker('refresh');
                }
            });
        }
    </script>

@endpush
