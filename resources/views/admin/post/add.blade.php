@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm bài viết
            </div>
            <div class="card-body">
                <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="slug">Tiêu đề bài viết</label>
                        <input class="form-control" type="text" name="title" id="slug" onkeyup="ChangeToSlug()">
                        @error('title')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="convert_slug">Link thân thiện bài viết</label>
                        <input class="form-control" type="text" name="slug" id="convert_slug">
                        @error('slug')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung bài viết</label>
                        <textarea name="content" class="form-control" id="content" cols="30" rows="10"></textarea>
                        @error('content')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Ảnh bài viết</label>
                        <input type="file" name="file" id="file" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select class="form-control" id="" name="category_post_id">
                            <option value="0">Chọn danh mục</option>
                            @foreach ($category_posts as $item)
                                <option value="{{ $item->id }}">{{ $item->category_post }}</option>
                            @endforeach
                        </select>
                        @error('category_post_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                                Công khai
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" value="thêm mới">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
