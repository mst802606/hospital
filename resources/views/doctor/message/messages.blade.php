@extends('layouts.doctor')
@section('page')
<div class="container-fluid message " onload="scrolltoId()">
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <h3 class="title">Text messages</h3>
            <hr />
            @foreach ($messagesdata['messages'] as $message)
            <a href="{{ route('patient.messages.show',['message'=>$message->id]) }}">
                <div>
                    <h3>{{ $message->title }}</h3>
                    <hr />
                </div>
            </a>
            @endforeach
        </div>
        @if ($messagesdata['message'])
        @php
        $message = $messagesdata['message'];
        @endphp
        <div class="col-md-6 col-xl">
            <section class="message message-container overflow-auto" onloadeddata="scroll()">
                <div class="parent">
                    <h2>Chat Messages</h2>
                    <div class="container">
                        <div class="col-md-3 col-xl-2"><img class="logo w-25" src="{{url('images/logo.png')}}" alt="Avatar" style="width: 100%" /> </div>
                        <p id="messages_title">{{ $message->title }}</p>
                        <p id="messages_message">{{ $message->message }}</p>
                        <span class="time-right" id="message_created_at">{{ $message->created_at->format('d-m-Y H:i') }}</span>
                    </div>

                    @if($message->replies)
                    @foreach ((array)json_decode($message->replies) as $key=>$reply)
                    @if($reply->key == "doctor")
                    <div class="container darker">
                        <div class="col-md-3 col-xl-2"><img class="logo w-25" src="{{url('images/logo.png')}}" alt="Avatar" class="right" style="width: 100%" /></div>
                        <p><strong>{{ $reply->key }}</strong></p>
                        <p>{{ $reply->message}}</p>
                        <span class="time-left">{{ date(' d-m-Y H:i', strtotime($reply->time )) }}</span>
                    </div>
                    @else
                    <div class="container">
                        <div class="col-md-3 col-xl-2"><img class="logo w-25" src="{{url('images/logo.png')}}" alt="Avatar" /></div>
                        <p><strong>{{$reply->key }}</strong></p>
                        <p>{{$reply->message }}</p>
                        <span class="time-right">{{ date('H:i d-m-Y', strtotime($reply->time )) }}</span>
                    </div>
                    @endif
                    @endforeach
                    @else
                    <div class="container-fluid bg-info item">
                        <p>There are no replies yet. Please await.</p>
                    </div>
                    @endif

                    <hr />
                    <div class="child" id="reply-section">
                        <form action="{{ route('patient.messages.update',['message'=> '1']) }}" method="POST">
                            @method('PUT') @csrf
                            <label for="reply">
                                Enter your reply below</label>
                            <div class="col">
                                <div class="row p-3">
                                    <div class="col">
                                        <textarea class="form-control" type="text" name="text_reply" id="reply" placeholder="Enter your text ..."></textarea>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-info rounded-pill float-left">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @else

                @endif

            </section>
        </div>
    </div>
</div>
<script>
    function scrolltoId() {
        var access = document.getElementById("reply-section");
        access.scrollIntoView({
            behavior: 'smooth'
        }, true);
    }

    var scrolled = false;

    function scroll() {
        if (!scrolled) {
            var log = document.querySelector('#reply-section');
            log.scrollTop = log.scrollHeight - log.clientHeight;
        }
    }

    $('#reply-section').on('scroll', function() {
        scrolled = true;
    });

</script>
@endsection
