@extends('layouts.adminmaster')

@section('content')
    <div class="card shadow mx-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add new Type of Problem</h6>
        </div>
        <div class="card-body">
            <form id="form" method="post" action="{{route('createissue')}}">
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

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#form').submit(function (e) {
                e.preventDefault();
                var frmdata = new FormData(this);
                var form = $(this);
                var url = form.attr('action');
                $.ajax({
                    type:'POST',
                    url:url,
                    data:form.serialize(),
                    success:function (data) {
                        {
                            console.log(data.status);
                            if(data.status=='success'){
                                swal("Good job!", "New Issues was Added successfully", "success");
                                window.location= "/admin/newIssue";
                                document.getElementById("form").reset();
                            }else{
                                swal("Error", "There was a problem", "error");
                            }

                        }
                    },
                    error:function (e) {
                        console.log(e);
                        swal("Error", "An error occurred we are looking into it", "error");

                    }
                });

            });
        });
    </script>

@endsection

