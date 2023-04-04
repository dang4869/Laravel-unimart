@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            {{-- @if (session('status'))
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                  <img src="..." class="rounded mr-2" alt="...">
                  <strong class="mr-auto">Bootstrap</strong>
                  <small>11 mins ago</small>
                  <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="toast-body">
                    {{ session('status') }}
                </div>
              </div>
                {{-- <div class="alert alert-success">
                    {{ session('status') }}
                </div> --}}
            {{-- @endif --}}
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách thành viên</h5>
                <div class="form-search form-inline">
                    <form action="#" style="display: flex;">
                        <input type="" class="form-control form-search mr-3" placeholder="Tìm kiếm"
                            value="{{ request()->input('keyword') }}" name="keyword">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="text-primary">Kích hoạt<span
                            class="text-muted">({{ $count[0] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary">Vô hiệu hóa<span
                            class="text-muted">({{ $count[1] }})</span></a>
                </div>
                <form action="{{ url('admin/user/action') }}">
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="" name="act">
                            <option>Chọn</option>
                            @foreach ($list_act as $k => $act)
                                <option value="{{ $k }}">{{ $act }}</option>
                            @endforeach
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkall">
                                </th>
                                <th scope="col">STT</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quyền</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->total() > 0)
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="list_check[]" value="{{ $user->id }}">
                                        </td>
                                        <th scope="row">{{ ++$i }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><a href="{{ route('admin.user.role', $user->id) }}">Xem nhóm quyền</a></td>
                                        <td>{{ $user->created_at }}</td>
                                        @if ($status == 'trash')
                                        <td>
                                            <a href="{{ route('admin.user.restore', $user->id) }}"
                                                class="btn btn-success btn-sm rounded-0 text-white" type="button" onclick="return confirm('Bạn có muốn khôi phục tài khoản này không ?')"
                                                data-toggle="tooltip" data-placement="top" title="Khôi phục">
                                                <i class="fa-solid fa-window-restore"></i>
                                            </a>
                                            @if (Auth::id() != $user->id)
                                                <a href="{{ route('admin.user.forcedelete', $user->id) }}"
                                                    onclick="return confirm('Bạn có muốn xóa tài khoản này ra khỏi hệ thống không ?')"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Xóa vĩnh viễn">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                        @else
                                        <td>
                                            <a href="{{ route('admin.user.role', $user->id) }}"
                                                class="btn btn-primary btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Nhóm quyền">
                                                <i class="fa-solid fa-users"></i>
                                            </a>
                                            <a href="{{ route('admin.user.edit', $user->id) }}"
                                                class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Chỉnh sửa">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @if (Auth::id() != $user->id)
                                                <a href="{{ route('admin.delete_user', $user->id) }}"
                                                    onclick="return confirm('Bạn có muốn vô hiệu hóa tài khoản này không ?')"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Vô hiệu hóa">
                                                    <i class="fa-solid fa-user-slash"></i>
                                                </a>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="bg-white">
                                        <p>Không tìm thấy bản ghi nào</p>
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </form>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
