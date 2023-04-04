@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm người dùng
            </div>
            <div class="card-body">
                <form action="{{ url('admin/user/store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input class="form-control" type="text" name="name" id="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" id="email">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input class="form-control" type="password" name="password" id="password">
                        @error('password')
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
                    {{-- <div class="form-group">
                        <label for="">Nhóm quyền</label>
                        <select class="form-control" id="" name="role_id">
                            <option>Chọn quyền</option>
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label for="">Nhóm quyền</label>
                        @foreach ($roles as $role)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="role[]" id="{{$role->id}}"
                                value="{{$role->id}}">
                            <label class="form-check-label" for="{{$role->id}}">
                                {{$role->name}}
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" name="btn_add" class="btn btn-primary" value="Thêm mới">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
