@extends('master.layout.index',[
'title' => _i('Chat'),
'subtitle' => _i('Chat'),
'activePageName' => _i('Chat'),
'additionalPageUrl' => url('/master/chat/create') ,
'additionalPageName' => _i('create'),
] )

@push('css')
    <style>
        .chat-pic {
            max-width: 160px;
            margin: 0 auto;
            display: block;
        }

        a i{
            padding: 0;
            margin: 0;
            margin-right: auto !important;
        }

        .card{
            text-align: center;
        }

        .player {
            max-width:750px;
            position: relative;
            overflow: hidden;
        }

        .player__video {
            width: 100%;
        }



        .player__slider {
            width:10px;
            height:30px;
        }

        .player__controls {
            position: absolute;
            bottom: 0;
            width: 100%;
            transform: translateY(100%) translateY(-2px);
            transition: all .3s;
            background: rgba(0,0,0,0.1);
        }

        .player:hover .player__controls {
            transform: translateY(0);
        }

        .player:hover .progress {
            height:5px;
        }



        .progress {
            position: relative;
            height:2px;
            transition:height 0.3s;
            background:rgba(0,0,0,0.5);
            cursor: pointer;
        }

        .progress__filled {
            width:0;
            /*background:#ffc600;*/
            background:#b1b1b1;
            height: 100%;
        }
        .player__buttons{
            height: 30px;
            width: 100%;
        }
        .play__button,
        .mute__button,
        .player__slider{
            display: block;
            float: left;
        }
        .mute__button, .play__button {
            background:none;
            border:0;
            line-height:1;
            color:white;
            text-align: center;
            outline:0;
            cursor:pointer;
            max-width:50px;
            padding: 0 10px;
            height: 30px;
        }
        .mute__button svg, .play__button svg{
            height: 50%;
            margin-top: 25%;
        }

        .big__play {
            position: absolute;
            height: 100px;
            width: 100px;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            margin: auto;
            background: rgba(0, 0, 0, 0.43);
            border-radius: 50%;
            pointer-events: none;
        }
        .big__play svg{
            height: 40%;
            position: absolute;
            top: 0;
            left: 10%;
            right: 0;
            bottom: 0;
            margin: auto;
        }
        .player__buttons input[type="range"] {
            -webkit-appearance: none;
            -webkit-tap-highlight-color: rgba(255, 255, 255, 0);
            width: 60px;
            height: 2px;
            margin: 12px 0;
            border: none;
            padding: 0;
            border-radius: 0;
            background: rgba(0, 0, 0, 0.4196078431372549);
            outline: none; /* no focus outline */
        }

        .player__buttons input[type="range"]::-moz-range-track {
            border: inherit;
            background: transparent;
        }

        .player__buttons input[type="range"]::-ms-track {
            border: inherit;
            color: transparent; /* don't drawn vertical reference line */
            background: transparent;
        }

        .player__buttons input[type="range"]::-ms-fill-lower,
        .player__buttons input[type="range"]::-ms-fill-upper {
            background: transparent;
        }

        .player__buttons input[type="range"]::-ms-tooltip {
            display: none;
        }

        /* thumb */

        .player__buttons input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 12px;
            height: 6px;
            border: none;
            border-radius: 12px;
            background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f1f1f1), color-stop(100%, #b1b1b1)); /* android <= 2.2 */
            background-image: -webkit-linear-gradient(top , #f1f1f1 0, #b1b1b1 100%); /* older mobile safari and android > 2.2 */;
            background-image: linear-gradient(to bottom, #f1f1f1 0, #b1b1b1 100%); /* W3C */
        }
        .player__buttons input[type="range"]::-moz-range-thumb {
            width: 12px;
            height: 6px;
            border: none;
            border-radius: 12px;
            background-image: linear-gradient(to bottom, #f1f1f1 0, #b1b1b1 100%); /* W3C */
        }

        .player__buttons input[type="range"]::-ms-thumb {
            width:12px;
            height: 6px;
            border-radius: 12px;
            border: 0;
            background-image: linear-gradient(to bottom, #f1f1f1 0, #b1b1b1 100%); /* W3C */
        }

        .nav-tabs .nav-link {
        color:
            #fff;
        }


    </style>

    @endpush

@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
            @endif
        @endforeach
    </div>

    <div class="col-sm-12 mbl">
         <span class="pull-left">
             <a href="{{ route('chat.create') }}" class="btn btn-primary create pull-left">
                 <i class="ti-plus"></i>{{_i('Add New Script')}}
             </a>
         </span>
    </div>
    <div class="page-body">


        <div class="card blog-page" id="blog">
            <div class="card-title">
                <h5>{{_i('Chat ')}}</h5>
            </div>

        </div>

        <div class="row">

            @foreach ($chats as $chat)


            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="media">
                            <a class=" media-middle" href="#">
                                <img class="media-object chat-pic" src="{{ asset('images/' . $chat->avatar) }}" alt="Generic placeholder image">
                            </a>
                        </div>
                        </div>

                    <div class="card-footer text-right">
                        <div class="text-center">
                            <a href="{{ route('chat.edit', $chat->id ) }}" class="btn btn-icon waves-effect waves-light btn-primary" title="Edit"><i class="ti-pencil-alt"></i></a>
                            <a href="" class="btn btn-icon waves-effect waves-light btn btn-danger" title="Delete"><i class="ti-trash"></i></a>
                            <a data-id="{{ $chat->id }}"  class="show-data btn btn-icon waves-effect waves-light btn btn-info" title="Delete"><i class="ti-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>

    </div>


        <div class="modal fade modal-flex" id="view-tabs" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab-home" role="tab">{{_i('Connectivity method')}}  </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-profile" role="tab">{{_i('Script')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content modal-body">
                            <div class="tab-pane active" id="tab-home" role="tabpanel">

                                <div class="player" wqcontrols>
                                    <video class="player__video viewer" id="chat-video"></video>
                                </div>

                            </div>

                            <div class="tab-pane" id="tab-profile" role="tabpanel">
                                <p id="chat-script"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@push('js')

<script>



    var WoiqoPlayer = function (t) {

        function setAttributes(el, options) {
            Object.keys(options).forEach(function(attr) {
                el.setAttribute(attr, options[attr]);
            })
        }
        this.s = {
            play: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40"><defs><style>.cls-1{fill:#fff;}</style></defs><g><g><g><path class="cls-1" d="M35.94,17.8c2,1.2,2,3.1,0,4.3L6.26,39.49c-2,1.2-3.7.2-3.7-2.1V2.61c0-2.3,1.6-3.3,3.7-2.1Z"/></g></g></g></svg>',
            pause: '<svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40"><defs><style>.cls-1{fill:#fff;}</style></defs><title>Artboard 1</title><g><g><path class="cls-1" d="M23.59,4.39A4.42,4.42,0,0,1,27.88,0h4.89a4.29,4.29,0,0,1,4.29,4.39V35.61A4.42,4.42,0,0,1,32.77,40H27.88a4.29,4.29,0,0,1-4.29-4.39Zm-20.65,0A4.42,4.42,0,0,1,7.23,0h4.89a4.29,4.29,0,0,1,4.29,4.39V35.61A4.42,4.42,0,0,1,12.12,40H7.23a4.29,4.29,0,0,1-4.29-4.39Z"/></g></g></svg>',
            replay: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40"><defs><style>.cls-1{fill:#fff;}</style></defs><g><g><path class="cls-1" d="M39.94,15.66V.06L34,6A19.74,19.74,0,0,0,17.94.26c-.3,0-.6.1-.9.1s-.7.1-1.1.2a3.55,3.55,0,0,1-1,.2c-.3.1-.6.1-.9.2l-.9.3-.9.3c-.3.1-.6.3-.9.4s-.6.3-.9.4a3.51,3.51,0,0,0-.8.5c-.3.2-.6.3-.9.5l-.9.6c-.2.2-.5.3-.7.5a18.53,18.53,0,0,0-2.8,2.8,3,3,0,0,0-.5.7l-.6.9a4.05,4.05,0,0,0-.5.9c-.2.3-.3.5-.5.8a3.55,3.55,0,0,0-.4.9c-.1.3-.3.6-.4.9l-.3.9c-.1.3-.2.6-.3,1a2.92,2.92,0,0,0-.2.9,3.55,3.55,0,0,0-.2,1c-.1.3-.1.7-.2,1.1s-.1.6-.1.9a25.39,25.39,0,0,0,0,3.9c0,.3.1.6.1.9a4.25,4.25,0,0,0,.2,1.1,3.55,3.55,0,0,1,.2,1c.1.3.1.6.2.9l.3.9.3.9c.1.3.3.6.4.9s.3.6.4.9a3.51,3.51,0,0,0,.5.8c.2.3.3.6.5.9l.6.9c.2.2.3.5.5.7a18.53,18.53,0,0,0,2.8,2.8,3,3,0,0,0,.7.5l.9.6a4.05,4.05,0,0,0,.9.5c.3.2.5.3.8.5a3.55,3.55,0,0,0,.9.4c.3.1.6.3.9.4l.9.3.9.3a2.92,2.92,0,0,0,.9.2,3.55,3.55,0,0,0,1,.2c.3.1.7.1,1.1.2s.6.1.9.1a25.39,25.39,0,0,0,3.9,0c.3,0,.6-.1.9-.1a4.25,4.25,0,0,0,1.1-.2,3.55,3.55,0,0,1,1-.2c.3-.1.6-.1.9-.2l.9-.3.9-.3c.3-.1.6-.3.9-.4s.6-.3.9-.4a3.51,3.51,0,0,0,.8-.5c.3-.2.6-.3.9-.5l.9-.6c.2-.2.5-.3.7-.5a19.81,19.81,0,0,0,7.3-15.4h-5.2a14.74,14.74,0,0,1-4.3,10.4,11,11,0,0,1-1.1,1c-.2.1-.3.3-.5.4s-.4.3-.6.5-.4.3-.6.4a2.09,2.09,0,0,0-.6.4,4.88,4.88,0,0,1-.7.3l-.6.3a1.45,1.45,0,0,1-.7.2,1.85,1.85,0,0,1-.7.2,6.37,6.37,0,0,1-.7.2c-.2.1-.5.1-.7.2a2.2,2.2,0,0,1-.8.1c-.2,0-.4.1-.7.1-.5,0-1,.1-1.5.1a7.57,7.57,0,0,1-1.5-.1c-.2,0-.4-.1-.7-.1s-.5-.1-.8-.1a1.85,1.85,0,0,1-.7-.2,6.37,6.37,0,0,0-.7-.2,1.85,1.85,0,0,0-.7-.2,1.45,1.45,0,0,0-.7-.2l-.6-.3a4.88,4.88,0,0,0-.7-.3,2.09,2.09,0,0,1-.6-.4,2.09,2.09,0,0,1-.6-.4,2.65,2.65,0,0,1-.6-.5,2.18,2.18,0,0,1-.5-.4,10,10,0,0,1-1.1-1h0a11,11,0,0,1-1-1.1,2.18,2.18,0,0,0-.4-.5c-.2-.2-.3-.4-.5-.6s-.3-.4-.4-.6l-.3-.6a4.88,4.88,0,0,1-.3-.7l-.3-.6a1.45,1.45,0,0,1-.2-.7,1.85,1.85,0,0,1-.2-.7c-.1-.2-.1-.5-.2-.7s-.1-.5-.2-.7a2.2,2.2,0,0,1-.1-.8c0-.2-.1-.4-.1-.6,0-.5-.1-1-.1-1.5a7.57,7.57,0,0,1,.1-1.5c0-.2.1-.4.1-.6s.1-.5.1-.8a1.85,1.85,0,0,1,.2-.7c.1-.2.1-.5.2-.7a1.85,1.85,0,0,0,.2-.7,1.45,1.45,0,0,0,.2-.7l.3-.6c.1-.2.2-.5.3-.7a2.09,2.09,0,0,1,.4-.6c.1-.2.3-.4.4-.6a2.65,2.65,0,0,1,.5-.6,2.18,2.18,0,0,1,.4-.5,10,10,0,0,1,1-1.1h0a11,11,0,0,1,1.1-1,2.18,2.18,0,0,0,.5-.4c.2-.2.4-.3.6-.5s.4-.3.6-.4a2.09,2.09,0,0,0,.6-.4,4.88,4.88,0,0,1,.7-.3l.6-.3a1.45,1.45,0,0,1,.7-.2c.2-.1.5-.2.7-.3a6.37,6.37,0,0,1,.7-.2c.2-.1.5-.1.7-.2s.5-.1.8-.1.4-.1.7-.1c.5,0,1-.1,1.5-.1a14.52,14.52,0,0,1,10.4,4.3l-6,6Z"/></g></g></svg>',
            mute: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40"><defs><style>.cls-1{fill:#fff;}</style></defs><path class="cls-1" d="M10.25,11.35l8.5-10.3c1.4-1.7,2.6-1.3,2.6,1V38c0,2.3-1.2,2.7-2.6,1l-8.5-10.3H6.45a4.06,4.06,0,0,1-4.1-4.1v-9a4.06,4.06,0,0,1,4.1-4.1h3.8Z"/></svg>',
            unmute: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40"><defs><style>.cls-1{fill:#fff;}.cls-2{fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style></defs><g><path class="cls-1" d="M10.25,11.35l8.5-10.3c1.4-1.7,2.6-1.3,2.6,1V38c0,2.3-1.2,2.7-2.6,1l-8.5-10.3H6.45a4.06,4.06,0,0,1-4.1-4.1v-9a4.06,4.06,0,0,1,4.1-4.1h3.8Z"/><path class="cls-2" d="M27.15,29a12.61,12.61,0,0,0,3.5-9,13.05,13.05,0,0,0-3.5-9"/><path class="cls-2" d="M32.05,34.25A20.53,20.53,0,0,0,37.65,20a20.46,20.46,0,0,0-5.5-14.3"/></g></svg>'
        }

        this.container = t,
        this.video = t.querySelector('video'),
        this.mousedown = {grab: false},
        this.holder = document.createElement('div'), this.holder.className = 'player__controls',
        this.container.appendChild(this.holder),
//                this.holder.innerHtml = '<div class="progress"> <div class="progress__filled"></div></div><div class="player__buttons"> <button class="play__button toggle" title="Toggle Play"></button> <button class="mute__button toggle" title="Toggle mute"></button> <input type="range" name="volume" class="player__slider" min="0" max="1" step="any" value="1"> </div>',
        this.progress = document.createElement('div'), this.progress.className = 'progress',
        this.progressBar = document.createElement('div'), this.progressBar.className = 'progress__filled',
        this.playerButtons = document.createElement('div'), this.playerButtons.className = 'player__buttons',
        this.playBtn = document.createElement('div'), this.playBtn.className = 'play__button',this.playBtn.innerHTML = this.s.play,
        this.muteBtn = document.createElement('div'), this.muteBtn.className = 'mute__button',this.muteBtn.innerHTML = this.s.unmute,
        this.range = document.createElement('input'), this.range.className = 'player__slider', setAttributes(this.range, { "type": "range", "value": 1, 'max':1, 'min':0, 'step': 'any'}),
        this.bigPlay = document.createElement('div'),this.bigPlay.className = 'big__play',this.bigPlay.innerHTML = this.s.play,




        this.container.appendChild(this.bigPlay),
        this.holder.appendChild(this.progress),
        this.progress.appendChild(this.progressBar),
        this.holder.appendChild(this.playerButtons),
        this.playerButtons.appendChild(this.playBtn),
        this.playerButtons.appendChild(this.muteBtn),
        this.playerButtons.appendChild(this.range),





//                this.progress = t.querySelector('.progress'),
//                this.progressBar = t.querySelector('.progress__filled'),
//                this.toggle = t.querySelector('.toggle'),
//                this.skipButtons = t.querySelectorAll('[data-skip]'),
//                this.range = t.querySelector('.player__slider'),

        this.init();
    }
    var p = WoiqoPlayer.prototype;

    p.init = function () {





        this.video.addEventListener('timeupdate', this.handleProgress.bind(this)),
        this.video.addEventListener('click', this.togglePlay.bind(this)),
        this.video.addEventListener('ended', this.handleEnd.bind(this)),
        this.playBtn.addEventListener('click', this.togglePlay.bind(this))
        this.muteBtn.addEventListener('click', this.handleMute.bind(this))
        this.progress.addEventListener('click', this.scrub.bind(this))
        this.progress.addEventListener('mousemove', this.scrub2.bind(this))
        this.progress.addEventListener('mousedown', this.checkMousedown.bind(this))
        this.progress.addEventListener('mouseup', this.checkMousedown.bind(this))
        this.range.addEventListener('change', this.handleRangeUpdate.bind(this))
//        this.range.addEventListener('mousemove', this.handleRangeUpdate.bind(this))
    },
    p.checkMousedown = function(){

        this.mousedown.grab = this.mousedown.grab ?  this.mousedown.grab = false : this.mousedown.grab = true;

    },

    p.togglePlay = function () {
        this.video.paused ? (this.video.play(),this.playBtn.innerHTML = this.s.pause,this.bigPlay.innerHTML = this.s.pause,this.bigPlay.style.display = 'none') : (this.video.pause(),this.playBtn.innerHTML = this.s.play,this.bigPlay.innerHTML = this.s.play);
    },
    p.handleRangeUpdate = function(e) {
        this.video.volume = this.range.value;
        if(this.video.volume === 0) this.handleMute()
        else (this.video.muted = false, this.video.volume = 1,this.muteBtn.innerHTML = this.s.unmute)
    },
    p.handleMute = function () {
        0 !== this.video.volume || !this.video.muted ? (this.video.muted = true, this.video.volume = 0,this.muteBtn.innerHTML = this.s.mute):(this.video.muted = false, this.video.volume = 1,this.muteBtn.innerHTML = this.s.unmute)
    }

    p.handleProgress = function() {
        var a = this.video;
        const percent = (a.currentTime / a.duration) * 100;
        this.progressBar.style.width = percent+'%';
    },

    p.scrub = function(e) {
        const scrubTime = (e.offsetX / this.progress.offsetWidth) * this.video.duration;
        this.video.currentTime = scrubTime;
    },
    p.scrub2 = function(e) {
        if(this.mousedown.grab === true){
            const scrubTime = (e.offsetX / this.progress.offsetWidth) * this.video.duration;
            this.video.currentTime = scrubTime;
        }

    }
    p.handleEnd = function(){
        this.bigPlay.style.display = 'block',this.bigPlay.innerHTML = this.s.replay;
    }



        for (var t = document.querySelectorAll("[wqcontrols]"), e = 0; e < t.length; e++) {
            let a = [];
            a.push(new WoiqoPlayer(t[e]))
        }


        // Modal

        $(".show-data").on('click', function() {

           var $id = $(this).data('id');


           $.ajax({

            type: 'POST',
            url: "{{ route('showChatModal') }}",

            data: {
                "_token": "{{ csrf_token() }}",
                "id": $id,
              },

            success: function(data) {


                $("#chat-script").html(data['script']);

                $("#chat-video").attr('src', "{{ url('images/')}}/" + data['video']);

                $("#view-tabs").modal('show');

            },
            error : function(xhr, err) {

                console.log(xhr.responseText);
            },
        });

    });




</script>


@endpush
