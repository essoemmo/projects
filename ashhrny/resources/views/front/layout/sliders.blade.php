<div class=main-slider-wrapper>
    <div class="top-slider">


        @foreach($slider_users as $item)
            @php
                $user = \App\User::findOrFail($item['user_id']);
                $user_social = \App\Models\SocialLinkUser::where('user_id',$user['id'])->where('social_id',$item['social_link_id'])->first(); //return default socialIcon & url
                  // ->where('default', 1)->first();
                $social_link = \App\Models\Social_link::where('id' , $item['social_link_id'])->first();
            @endphp
            <div class="single-slide">
                <div title="test" class="slide-img">
                    <a href="{{url('showProfile/'.$item['user_id'])}}">
                        <img data-lazy="{{$user['image'] != null ? asset($user['image']) : asset('front/personal_image.png')}}" alt="" class="img-fluid">
                    </a>
                </div>
                <div class="context  justify-content-between text-center">
                    <div title="{{$user['first_name']." ".$user['last_name']}}" class="name">
                        <a href="{{url('showProfile/'.$item['user_id'])}}" style="color: #000;"> {{$user['first_name']." ".$user['last_name']}} </a>
                    </div>
                    <div title="{{$user['job_type'] }}" class="job-title">{{$user['job_type'] }}</div>

                    <div class="social-icons">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a rel="nofollow" title href="{{$user_social['url']}}"><i class="fab {{$social_link['icon']}}"></i></a></li>
                            <li class="list-inline-item"><a rel="nofollow" title href="{{url('showProfile/'.$item['user_id'])}}"><i class="fas fa-eye"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>

@push('css')
    <style>
        @media all and (max-width: 1440px) {
            .main-slider-wrapper .single-slide {
                margin-left: -5px;
            }
            .main-slider-wrapper .context .name {
                font-size: 16px;
            }
            .main-slider-wrapper .context .job-title {
                font-size: 13px;
            }
        }
    </style>
@endpush
