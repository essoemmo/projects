@foreach($normal_members as $member)
    @php
        $user_social = \App\Models\SocialLinkUser::where('user_id',$member['userId'])->where('default', 1)->first(); //return default socialIcon & url
        $social_data = \App\Models\Social_link::where('id' , $user_social['social_id'])->first();
    @endphp
    <div class="col-lg-3 col-md-6">
        <div class="single-account @if($social_data){{explode("-", $social_data['icon'])[1]}} @else instagram @endif">
            <div class="img-wrapper">
                <div class="account-img">
                    <a href="{{url('showProfile/'.$member['userId'])}}" title="">
                        <img src="{{$member['image'] != null ? asset($member['image']) : asset('front/personal_image.png')}}">
                    </a>
                </div>
                <div class="social-icons">
                    <ul class="list-unstyled">
                        <li class="show-on-hover">
                            <a href="{{url('showProfile/'.$member['userId'])}}" title="profile">
                                <i class="fas fa-eye"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{$user_social['url']}}" title="">
                                <i class="fab {{$social_data['icon']}}"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="context d-md-flex justify-content-between text-center">
                <div title="" class="name">
                    <a href="{{url('showProfile/'.$member['userId'])}}" style="color: #000;">
                        {{$member['first_name']." ".$member['last_name']}}
                    </a>
                </div>
                <div title="{{$member['job_type'] }}" class="job-title">{{$member['job_type'] }}</div>
            </div>

        </div>
    </div>
@endforeach
