@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm bài viết
            </div>
            <div class="card-body">

                <form action="{{ route('admin.page.update', $page->id) }}" method="POST" >
                @csrf
                    <div class="form-group">
                        <label for="slug">Tiêu đề trang</label>
                        <input class="form-control" type="text" name="name_page" id="slug" onkeyup="ChangeToSlug()" value="{{$page->name_page}}">
                        @error('name_page')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="convert_slug">Link thân thiện trang</label>
                        <input class="form-control" type="text" name="slug"  id="convert_slug" value="{{$page->slug}}">
                        @error('slug')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung trang</label>
                        <textarea name="content" class="form-control" id="content" cols="30" rows="10">{!! $page->content !!}</textarea>
                        @error('content')
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
                    <button type="submit" class="btn btn-primary" value="thêm mới">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
