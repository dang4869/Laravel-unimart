@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sửa
            </div>
            <div class="card-body">
                <form action="{{ route('admin.color.update', $color->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên màu</label>
                        <input class="form-control" type="text" name="name" id="name"
                            value="{{ $color->name}}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="code">Mã màu</label>
                        <input class="form-control" type="color" name="color_code" id="code"
                            value="{{ $color->color_code}}">
                        @error('color_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="amout">Số lượng</label>
                        <input class="form-control" type="text" name="amout" id="amout"
                            value="{{ $color->amout}}">
                        @error('amout')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                </form>
            </div>
        </div>
    </div>
@endsection
