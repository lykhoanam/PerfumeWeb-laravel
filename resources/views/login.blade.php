@extends('master')
@section('content')
@if(isset($success))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: '{{ $success }}',
                showConfirmButton: false,
                timer: 2000
            });
        }
    </script>
@endif
<div class="container custom-login">
    <div class="row"></div>
    <div class="row"></div>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form action="login" method="POST">
                <div class="form-group" style="text-align:start">
                    @csrf
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group" style="text-align:start">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                @if(isset($error))
                <div class="alert alert-danger">
                    <strong>Error!</strong> {{ $error }}
                </div>
            @endif
                <div class="form-check" style="text-align:start">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button style="align-items:flex-start" type="submit" class="btn btn-primary form-control">Submit</button>
            </form>
        </div>
    </div>
</div>


@endsection
