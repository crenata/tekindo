@extends('admin.template')

@section('title', 'Edit')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit</h3>
                </div>

                <div class="panel-body">
                    <form action="{{ route('admin.role.update', $role->id) }}" method="POST" class="form-horizontal">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="role">Role Name</label>
                            <input type="text" value="{{ $role->name }}" name="name" class="form-control" id="role">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('admin.roles') }}" class="btn btn-danger btn-sm">Back</a>
                            </div>
                            <div class="col-md-6 clearfix">
                                <button type="submit" class="btn btn-primary btn-sm float-right">Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
