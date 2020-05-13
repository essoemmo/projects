{{_i("Dear ")}} {{$name}}
{{_i("Thanks for your registeration" )}}
<a href="{{ route('front.verify',['local' => LaravelGettext::getLocale(), 'id' => encrypt($id)]) }}"
   class="btn btn-info">{{_i('click here ')}}</a> {{_i("to activate your account")}}
