@extends('admin.template')

@section('title', 'Add Role')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Add New Role</h3>
                </div>

                <div class="panel-body">
                    @include('multiauth::message')

                    {{ Form::open(array('route' => 'admin.role.store', 'class' => 'form-horizontal')) }}
                        <div class="form-group">
                            <label for="role">Role Name</label>
                            <input type="text" placeholder="Give an awesome name for role" name="name" class="form-control" id="role" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('admin.roles') }}" class="btn btn-sm btn-danger">Back</a>
                            </div>
                            <div class="col-md-6 clearfix">
                                <button type="submit" class="btn btn-primary btn-sm float-right">Store</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
