@extends('layouts.formmaster')
@section('header')
    @if(isset($message))
        <p>Message Received!</p>
        @else
    Report a Complainant or Leave a Feedback
    @endif
@endsection
@section('form')
    @if(isset($message))
        <p>Thank you for taking the time and we are glad to receive your feedback or complain we shall now work on it</p>
        @else

    <form method="post" action="{{route('complain')}}">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Email address</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" name="email" value="@auth()
            {{auth()->user()->email}}
            @endauth" placeholder="name@example.com" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">We would like to hear from you</label>
            <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"
                      required></textarea>
        </div>
        <div>
            <input type="submit" value="Submit" class="btn btn-outline-primary d-block">
        </div>
    </form>
    @endif
@endsection
