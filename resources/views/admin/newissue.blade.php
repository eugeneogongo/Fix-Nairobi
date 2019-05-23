@extends('layouts.adminmaster')

@section('content')
    <div class="card shadow mx-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add new Type of Problem</h6>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('createissue')}}">
                @csrf
                <div class="form-group">

                    <input name="desc" class="form-control" autofocus required placeholder="Issue Type">


                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    Create Issue Type
                </button>
            </form>
        </div>
    </div>

    </div>
@endsection

