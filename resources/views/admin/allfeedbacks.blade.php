@extends('layouts.adminmaster')

@section('content')
    <div class="container">
        <ol class="list-group">
            @foreach($feedbacks as $feedback)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-10">
                            {{$feedback->message}}
                        </div>
                        <div class="col-2">
                            <button class="btn btn-outline-info"> Mark as Read</button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ol>

    </div>
@endsection