@extends('layouts.formmaster')
@section('header')
    Report a Complainant or Leave a Feedback
@endsection
@section('form')
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
            <textarea class="form-control" name="complain" id="exampleFormControlTextarea1" rows="3"
                      required></textarea>
        </div>
        <div>
            <input type="submit" value="Submit" class="btn btn-outline-primary d-block">
        </div>
    </form>
@endsection
