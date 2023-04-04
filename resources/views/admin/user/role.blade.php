@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
          Nhóm quyền
        </div>
        <div class="card-body">
                <div class="form-group">
                    @foreach ($roles as $role)
                    @php
                        $checked = in_array($role->name, $roles_ass) ? 'checked' : '' ;
                    @endphp
                    <div class="form-check">
                        <input class="form-check-input" {{$checked}} type="checkbox" name="role[]" id="{{$role->id}}"
                            value="{{$role->id}}">
                        <label class="form-check-label" for="{{$role->id}}">
                            {{$role->name}}
                        </label>
                    </div>
                    @endforeach
             </div>
        </div>
    </div>
</div>
@endsection
