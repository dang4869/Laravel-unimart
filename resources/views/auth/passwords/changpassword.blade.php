@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
          Đổi mật khẩu
        </div>
        <div class="card-body">
            <form action="{{ url('changpassword/update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="old_password">Mật khẩu cũ</label>
                    <input class="form-control" type="password" name="old_password" id="old_password">
                    @error('old_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new_password">Mật khẩu mới</label>
                    <input class="form-control" type="password" name="new_password" id="new_password">
                    @error('new_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">Xác nhận mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password-confirm">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" name="btn_update" class="btn btn-primary" value="Đổi mật khẩu">Đổi mật khẩu</button>
            </form>
@endsection
