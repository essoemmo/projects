@extends('front.layout.index')

@section('content')

    <div class="user-page">
        <div class="container">
            <div class="profile">


                <div class="section-title">{{ _i('Personal Profile') }}</div>

                <form action="{{ route('userProfile.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">{{ _i('First Name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="first_name" value="{{ $user->first_name }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">{{ _i('Last Name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">{{ _i('Preferred language') }}</label>
                        <div class="col-sm-10">
                            <select name="site_language_id" id="" class="form-control">
                                <option disabled selected>{{ _i('Select') }}</option>
                                @foreach($langs as $lang)
                                    <option @if($user->site_language_id == $lang->id) selected @endif value="{{ $lang->id }}">{{ $lang->title }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">{{ _i('Email') }}</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">{{ _i('Password') }}</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">{{ _i('Mobile') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="mobile" value="{{ $user->mobile }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">{{ _i('Country') }}</label>
                        <div class="col-sm-10">
                            <select name="country_id" id="" class="form-control">
                                <option disabled selected>{{ _i('Select') }}</option>
                                @foreach($countries as $country)
                                    <option @if($user->country_id == $country->id) selected @endif value="{{ $country->id }}">{{ $country->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">{{ _i('Image') }}</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" class="form-control" onchange="showImg(this)">
                        </div>
                    </div>

                    <div class="form-group row">
                        <img class="img-responsive pad" id="image">
                    </div>

                    <div class="d-md-flex justify-content-md-end">
                        <input type="submit" class="btn btn-yellow text-left" value="{{ _i('Update') }}">
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection

@push('js')

    <script>
        function showImg(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                $('#image').attr('src', e.target.result).width(250).height(250);
            };
            filereader.readAsDataURL(input.files[0]);

        }
    </script>

@endpush
