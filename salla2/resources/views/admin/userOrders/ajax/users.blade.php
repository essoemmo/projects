<div class="loader-block" style="display: none">
    <svg id="loader2" viewBox="0 0 100 100">
        <circle id="circle-loader2" cx="50" cy="50" r="45"></circle>
    </svg>
</div>

<div class="no-more-tables table-with-links">
    <table class="table text-nowrap">
        <tbody id="table_list_customer" class="infinite-scroll">
        @foreach($users as $user)
            <tr class="table-row customer-row">
                <td class="order-customer customer-td d-flex">
                    <div class="media-left media-middle d-flex">
                        <div class="checkbox-area align-items-center">
                            <div class="checkbox-fade fade-in-primary">
                                <label>
                                    <input type="checkbox" form="send_form" required name="users[]"
                                           value="{{ $user->id }}">
                                    <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                </label>
                            </div>
                        </div>
                        <a href="{{ url('/adminpanel/store_user/' . $user->id . '/orders') }}">
                            @if($user->image != null)
                                <img class="media-object img-circle comment-img"
                                     style="width: 55px;height: 55px"
                                     src="{{ asset($user->image) }}" alt="{{ $user->name }}">
                            @else
                                <img class="media-object img-circle comment-img"
                                     style="width: 55px;height: 55px"
                                     src="{{ asset('images/articles/personal_NoImage.jpg') }}"
                                     alt="{{ $user->name }}">
                            @endif
                        </a>
                    </div>
                    <div class="media-left media-body-middle">
                        <div class="align-self-center">
                            <a href="{{ url('/adminpanel/store_user/' . $user->id . '/orders') }}">
                                {{ $user->name }} {{ $user->lastname }}
                            </a>
                        </div>
                    </div>

                </td>
                <td class="text-right" data-title="{{ _i('City') }}"><span
                        class="text-muted"></span></td>

                        <td>

                            <div class="media-left media-body-middle">

                                @if($user->email_verified_at == null)
                                               <div class="align-self-center">
                                                   <form  action="{{route('activeusers', $user->id)}}" method="post" class="form-horizontal"  enctype="multipart/form-data" data-parsley-validate="">
                                                       @csrf
                       
                                                       <input type="submit" class="btn btn-danger" value="{{_i('Active')}}">
                       
                                                   </form>
                                               </div>
                       
                                               @else
                                               <div class="align-self-center">
                                                   <div class="badge badge-success" > {{_i(" Actived ")}} </div>
                                                </div>
                                           @endif
                       
                       
                                           </div>

                        </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
