@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid" ng-app="role" ng-controller="roleController">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm nhóm quyền
            </div>
            <div class="card-body">
                <form action="{{ url('admin/role/store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên quyền</label>
                        <input class="form-control" type="text" name="name" id="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group" style="height: 300px; overflow-y:auto">
                        <label for="">Routes</label>
                        <input type="text" class="form-control mb-3" ng-model= "rname" placeholder="Tìm kiếm routes">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="check-all">
                            <label class="form-check-label" for="check-all">
                                Chọn tất cả
                            </label>
                        </div>
                        <div class="form-check"  ng-repeat= "r in roles | filter:rname">
                            <input class="form-check-input role-item" type="checkbox" name="role_group[]" id="@{{r}}"
                                value="@{{r}}">
                            <label class="form-check-label" for="@{{r}}">
                                @{{r}}
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.3/angular.min.js" integrity="sha512-KZmyTq3PLx9EZl0RHShHQuXtrvdJ+m35tuOiwlcZfs/rE7NZv29ygNA8SFCkMXTnYZQK2OX0Gm2qKGfvWEtRXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var app = angular.module('role',[]);

    app.controller('roleController',function($scope){
        var roles = '<?php echo json_encode($routes);?>';
         $scope.roles = angular.fromJson(roles);
        console.log(angular.fromJson(roles));
    })
    $('#check-all').click(function(){
        $('.role-item').not(this).prop('checked', this.checked);
    })
</script>
@endsection
