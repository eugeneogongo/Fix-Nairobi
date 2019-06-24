@extends('layouts.adminmaster')

@section('scripts')
    <!-- include summernote css/js -->

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
@section('content')
    <div class="container">


    <form method="post" id="form" action="/broadcast">
        @csrf
        <div class="form-group">
            <input name="subject" required type="text" class="form-control" placeholder="Subject">
        </div>
        <textarea id="summernote" name="editordata"></textarea>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">Send</button>
        </div>
    </form>
    </div>
@endsection