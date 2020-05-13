<div class="footer-nav">
    <ul class="list-inline">
        @php
            $footer = \App\Models\Footer::LeftJoin('footer_translations','footer_translations.footer_id','=','footer.id')
                ->select('footer_translations.title as title' ,'footer.id as id' ,'footer.url')
                ->where('locale',\Illuminate\Support\Facades\App::getLocale())->get();
        @endphp
        @foreach($footer as $item)
            <li class="list-inline-item"><a href="{{$item->url}}" title="{{$item->title}}"> {{$item->title}}</a></li>
        @endforeach
    </ul>
</div>
