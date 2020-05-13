<div class="contact-admin">
    <div class="container">
        @include('admin.layouts.message')
        <form action="{{route('contact-manger')}}" method="post" class="simple-theme">
            {{csrf_field()}}
            {{method_field('post')}}

            <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="البريد الالكتروني">
            <input type="text" class="form-control" name="title" placeholder="عنوان الرسالة">
            <textarea name="content" id="" cols="30" rows="10" class="form-control" placeholder="موضوع الرسالة"></textarea>
            <div class="justify-content-md-end d-flex my-2">
                <input type="submit" class="btn btn-pink" value="ارسال">
            </div>
        </form>
    </div>
</div>
<br>
<br>