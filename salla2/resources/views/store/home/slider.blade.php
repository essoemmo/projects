 <div class="slider ">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                @if($sliders)
                    @foreach($sliders as $key => $slider)
                        <li data-target="#carouselExampleFade" data-slide-to="{{ $key }}"
                            class="{{$key == 0 ? 'active' : ' '}}">
                        </li>
                    @endforeach
                @else
                    <li data-target="#carouselExampleFade" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleFade" data-slide-to="1"></li>
                    <li data-target="#carouselExampleFade" data-slide-to="2"></li>
                @endif
            </ol>
            <div class="carousel-inner">
                @if($sliders)
                    @foreach($sliders as $key => $slider)
                        <div class="carousel-item {{$key == 0 ? 'active' : ' '}}">
                            <img src="{{ asset('uploads/settings/sliders/'. $slider->id . '/' . $slider->image) }}"
                                 class="d-block w-100" alt="...">
                        </div>
                    @endforeach
                @else
                    <div class="carousel-item active">
                        <img src="https://via.placeholder.com/1138x464.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/1138x464.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/1138x464.png" class="d-block w-100" alt="...">
                    </div>
                @endif
            </div>

        </div>
    </div>