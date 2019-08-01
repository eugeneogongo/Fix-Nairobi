@extends('layouts.adminmaster')
@section('content')
    <div class="card shadow mx-5">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add a new Admin</h6>
        </div>
        <div class="card-body col-sm-4 mt-5 mr-5">
            @isset($success)
                <div class="alert alert-info">
                    The Admin was added successfully
                </div>
                @endisset
            @isset($error)
                <div class="=alert alert-danger">
                    The Email address was not found. Kindly tell the User to Register first the platform then add Him as an Administrator
                </div>
                @endisset
            <form id="form" method="post" action="{{route('createadmin')}}">
                @csrf
                <div class="form-group">
                    <input name="email" type="email" class="form-control" autofocus required placeholder="Add Admin">
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    Add Admin
                </button>
            </form>
        </div>
    </div>

    </div>
@endsection
