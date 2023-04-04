@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sửa danh mục
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categoryproduct.update', $categoryproduct->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="slug">Tên danh mục</label>
                        <input class="form-control" type="text" name="name" id="slug" onkeyup="ChangeToSlug()"
                            value="{{ $categoryproduct->category_name }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="convert_slug">Link thân thiện</label>
                        <input class="form-control" type="text" name="slug" id="convert_slug" value="{{$categoryproduct->slug}}">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục cha</label>
                        <select class="form-control" id="" name="category_parent">
                            <option value="0">Danh mục cha</option>
                            @foreach ($category as $val)
                            <option {{$categoryproduct->category_parent == $val->id ? 'selected' : ''}} value="{{$val->id}}">
                             @php
                                 $str = '';
                                 for($i = 0; $i<$val->level; $i++){
                                    echo $str;
                                    $str .= '|--';
                                 }
                             @endphp
                             {{$val->category_name}}</option>
                            @endforeach
                        </select>
                        @error('category_parent')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                value="option1">
                            <label class="form-check-label" for="exampleRadios1">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                value="option2" checked>
                            <label class="form-check-label" for="exampleRadios2">
                                Công khai
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
