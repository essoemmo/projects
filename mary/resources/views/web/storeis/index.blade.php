@extends('web.layout.master')
@push('css')
<style>
    .single-member-box .member-pic img {
     width: 143px !important;
    }
</style>
    @endpush

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('successful Story')}}</li>
            </ol>
        </div>
    </nav>

    <section class="successful-stories-page latest-members  common-wrapper ">
        <div class="container">

            <div class="text-center mb-5">
                <div class="black-head-title">
                    {{_i('We congratulate all the participants who have been blessed by God to find their other half through this site and wish them a happy life in obedience and satisfactions, and we wish God success to all members The following are some of the successful stories that we have announced')}}

                </div>
            </div>

            <div id="story">
                @include('web.storeis.ajax')
            </div>

        </div>
    </section>
    <br>
    <br>




@endsection
@push('js')
    <script>
        $(document).on('click','.pagination a' ,function(e){
            e.preventDefault();

            var page = $(this).attr('href').split('page=')[1];
            $.ajax({

               url:"/paginate/fetch?page="+page,
                success:function (data) {

                   console.log(data);
                    $('#story').html(data)
                }
            });

        });
    </script>

    @endpush
