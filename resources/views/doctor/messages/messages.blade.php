@extends('layouts.doctor')
@section('page')
				{{-- <meta http-equiv="refresh" content="2">  --}}
				<div class="container-fluid message ">
								<div class="row">
												<div class="col-md-6 col-xl-3">
																<h3 class="title">Text messages</h3>
																<hr />
																@foreach ($messagesdata['messages'] as $message)
																				<a href="{{ route('doctor.messages.show', ['message' => $message->id]) }}">
																								<div>
																												<h3>{{ $message->title }}</h3>
																												@if ($message->doctor_id)
																																<h5><small><span class="badge badge-success">Replied</span></small></h5>
																												@else
																																<h5><small><span class="badge badge-danger">Reply to this chat message</span></small></h5>
																																<h6 class="message">Once opened the chat is private between you and the patient</h6>
																												@endif
																												<h6>{{ $message->created_at->format('H:i d-m-y') }}</h6>
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
																				<section class="message message-container overflow-auto" id="chat-section">
																								<div class="parent">
																												<h2>Chat Messages</h2>
																												<div class="container">
																																<div class="col-md-3 col-xl-2"><img class="logo w-25" src="{{ url('images/logo.png') }}"
																																								alt="Avatar" style="width: 100%" /> </div>
                                                                                                                                                                @if ($message->patient)
                                                                                                                                                                <p><strong>{{ 'Sent by ' . $message->patient->user->username ?? "Admin" }}</strong></p>
                                                                                                                                                                @else
                                                                                                                                                                <p><strong>{{ "Sent by Admin" }}</strong></p>
                                                                                                                                                                @endif																																<p id="messages_title">{{ 'Title: ' . $message->title }}</p>
																																<p id="messages_message">{{ 'Message: ' . $message->message }}</p>
																																<span class="time-right"
																																				id="message_created_at">{{ $message->created_at->format('d-m-Y H:i') }}</span>
																												</div>
																												@if ($message->replies)
																																@foreach ((array) json_decode($message->replies) as $key => $reply)
																																				@if ($reply->key == 'doctor')
																																								<div class="container darker">
																																												<div class="col-md-3 col-xl-2"><img class="logo w-25"
																																																				src="{{ url('images/logo.png') }}" alt="Avatar" class="right"
																																																				style="width: 100%" /></div>
																																												<p><strong>{{ $reply->key . ' ' . $message->doctor->user->username ?? "NA" }}</strong>
																																												</p>
																																												<p>{{ $reply->message }}</p>
																																												<span
																																																class="time-left">{{ date(' d-m-Y H:i', strtotime($reply->time)) }}</span>
																																								</div>
																																				@elseif ($reply->key == 'Admin')
																																								<div class="container">
																																												<div class="col-md-3 col-xl-2"><img class="logo w-25"
																																																				src="{{ url('images/logo.png') }}" alt="Avatar" /></div>
																																												<p><strong>{{ 'Hospital Admin' }}</strong>
																																												</p>
																																												<p>{{ $reply->message }}</p>
																																												<span
																																																class="time-right">{{ date('H:i d-m-Y', strtotime($reply->time)) }}</span>
																																								</div>
																																				@else
																																								<div class="container">
																																												<div class="col-md-3 col-xl-2"><img class="logo w-25"
																																																				src="{{ url('images/logo.png') }}" alt="Avatar" /></div>
																																												<p><strong>{{ $reply->key . ' ' . $message->patient->user->username }}</strong>
																																												</p>
																																												<p>{{ $reply->message }}</p>
																																												<span
																																																class="time-right">{{ date('H:i d-m-Y', strtotime($reply->time)) }}</span>
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
																																<form action="{{ route('doctor.messages.update', ['message' => $message->id]) }}"
																																				method="POST">
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
																												<div class="bottom" id="bottom">
																												</div>
																								</div>
																				@else
												@endif

												</section>
								</div>
				</div>
				</div>
				<script>
								window.onload = function() {
												//  var objDiv = document.getElementById("MyDivElement");
												// objDiv.scrollTop = objDiv.scrollHeight;
												$('#chat-section').animate({
																scrollTop: ($("#bottom").offset().top)
												}, 2000);
								}
				</script>
@endsection
