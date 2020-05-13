@foreach($featured_users as $item)
    @php
        $user = \App\User::findOrFail($item['user_id']);
        $user_social = \App\Models\SocialLinkUser::where('user_id',$user['id'])->where('default' , 1)->where('social_id',$item['social_link_id'])->first();  //return default socialIcon & url
        $social_link = \App\Models\Social_link::where('id' , $item['social_link_id'])->first();
    @endphp
    <div class="single-account m-3 @if($social_link){{explode("-", $social_link['icon'])[1]}} @else instagram @endif">
        <div class="account-img">
            <a href="{{url('showProfile/'.$item['user_id'])}}" title="">
                <img src="{{$user['image'] != null ? asset($user['image']) : asset('front/personal_image.png')}}" alt="" >
            </a>
        </div>
        <div class="social-icons">
            <ul class="list-unstyled">
                <li><a href="{{url('showProfile/'.$item['user_id'])}}" title="profile">
                        <i class="fas fa-eye"></i>
                    </a>
                </li>
                <li><a href="{{$user_social['url']}}" title="" >
                        <i class="fab {{$social_link['icon']}}"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="context d-md-flex justify-content-between text-center">
            <div class="name">
                <a href="{{url('showProfile/'.$item['user_id'])}}" style="color: #000;">
                    {{$user['first_name']." ".$user['last_name']}}
                </a>
            </div>
            <div class="job-title">{{$user['job_type'] }}</div>
        </div>

    </div>
@endforeach

<!------------------------------ featured --------------------------------------->
<!--------------------------------
<div class="single-account m-3 facebook">
    <div class="account-img"><a href=""><img src="{{asset('front/images/demo.jpg')}}" alt="" class="img-fluid"></a></div>
    <div class="social-icons">
        <ul class="list-unstyled">
            <li><a href=""><i class="fas fa-eye"></i></a></li>
            <li><a href=""><i class="fab fa-facebook"></i></a></li>
        </ul>
    </div>
    <div class="context d-md-flex justify-content-between text-center">
        <div class="name">ايما ستون</div>
        <div class="job-title">ممثلة</div>
    </div>
</div>
------------------------------------------------>

<!--------------------------- famous --------------------------------------------->
<!---------------------------------------
<div class="col-lg-3 col-md-6">
    <div class="single-account instagram">
        <div class="img-wrapper">
            <div class="account-img"><a href=""><img src="{{asset('front/images/demo.jpg')}}" alt=""
                                                     class="img-fluid "></a></div>
            <div class="social-icons">
                <ul class="list-unstyled">
                    <li class="show-on-hover"><a href=""><i class="fas fa-eye"></i></a></li>
                    <li><a href=""><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="context d-md-flex justify-content-between text-center">
            <div class="name">ايما ستون</div>
            <div class="job-title">ممثلة</div>
        </div>

    </div>
</div>
---------------------------------------------------->

