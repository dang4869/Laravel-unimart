@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Danh sách quyền
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên quyền</th>
                        {{-- <th scope="col">Nhóm quyền</th> --}}
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <th scope="row">{{++$i}}</th>
                        <td>{{$role->name}}</td>
                        {{-- <td>{{$role->role_group}}</td> --}}
                        <td>{{$role->created_at}}</td>
                        <td><a href="{{route('admin.role.edit',$role->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>
                            <a href="{{route('admin.role.delete',$role->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{$roles->links()}}
        </div>
    </div>
</div>
@endsection
