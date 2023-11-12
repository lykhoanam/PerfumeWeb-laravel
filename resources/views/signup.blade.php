<!-- resources/views/signup.blade.php -->

@extends('master')
@section('content')

<div class="container custom-login bg-gray-100">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form id='checkoutForm' action="signup" method="POST">
                @csrf
                <div class="form-group" style="text-align:start">
                    <label for="exampleInputEmail1">Tên người dùng</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên người dùng...">
                </div>
                <div class="form-group" style="text-align:start">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Nhập vào Email...">
                </div>
                <div class="form-group" style="text-align:start">
                    <label for="exampleInputPassword1">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu...">
                </div>
                <div class="form-group" style="text-align:start">
                    <label for="exampleInputPassword1">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Xác nhận mật khẩu...">
                </div>
                @if(isset($error))
                <div class="alert alert-danger">
                    <strong>Error!</strong> {{ $error }}
                </div>
            @endif
                <button style="align-items:flex-start" type="submit" class="btn btn-danger">Đăng ký</button>
            </form>
        </div>
    </div>
</div>
<style>
    body{
        background-color: rgba(227, 222, 222, 0.4); /* Black w/ opacity */
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('checkoutForm').addEventListener('submit', function (event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });

        function validateForm() {

            var pwd_conf = document.getElementsByName('password_confirm')[0].value;
            var password = document.getElementsByName('password')[0].value;
            var email = document.getElementsByName('email')[0].value;
            var name = document.getElementsByName('name')[0].value;

            var isValid = true;

            if (name.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng nhập tên!!',
                    showConfirmButton: false,
                    timer: 2000
                })
                isValid = false;
            }else if (email.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng nhập email!!',
                    showConfirmButton: false,
                    timer: 2000
                })
                isValid = false;
            }else if (password.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng nhập mật khẩu!!',
                    showConfirmButton: false,
                    timer: 2000
                })
                isValid = false;
            }else if (pwd_conf.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng nhập lại mật khẩu!!',
                    showConfirmButton: false,
                    timer: 2000
                })
                isValid = false;
            }else if (pwd_conf.trim() != password.trim()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Mật khẩu không khớp!',
                    showConfirmButton: false,
                    timer: 2000
                })
                isValid = false;
            }

            return isValid;
        }
    });
</script>
@endsection
