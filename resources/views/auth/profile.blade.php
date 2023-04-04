@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thông tin người dùng
        </div>
        <div class="card-body">
            <form action="{{ url('profile/update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{Auth::user()->name}}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{Auth::user()->email}}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="created_at">Ngày tạo</label>
                    <input class="form-control" type="text" name="name" id="created_at" value="{{Auth::user()->created_at}}" disabled>
                </div>
                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select class="form-control" id="">
                        <option>Chọn quyền</option>
                        <option>Danh mục 1</option>
                        <option>Danh mục 2</option>
                        <option>Danh mục 3</option>
                        <option>Danh mục 4</option>
                    </select>
                </div>

                <button type="submit" name="btn_add" class="btn btn-primary" value="Thêm mới">Chỉnh sửa</button>
            </form>
        </div>
    </div>
</div>
@endsection
