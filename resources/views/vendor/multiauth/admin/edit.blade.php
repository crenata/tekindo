@extends('admin.template')

@section('title', 'Edit')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit details of {{ $admin->name }}</h3>
                </div>

                <div class="panel-body">
                    @include('multiauth::message')

                    <form action="{{ route('admin.update', $admin->id) }}" method="POST" class="form-horizontal">
                        @csrf
                        @method('patch')
                        <div class="form-group row">
                            {{ Form::label('name', 'Name', array('class' => 'col-sm-6 col-form-label')) }}
                            <div class="col-sm-12">
                                <input type="text" value="{{ $admin->name }}" name="name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('email', 'Email', array('class' => 'col-sm-6 col-form-label')) }}
                            <div class="col-sm-12">
                                <input type="text" value="{{ $admin->email }}" name="email" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('role_id', 'Assign Role', array('class' => 'col-sm-6 col-form-label')) }}
                            <div class="col-sm-12">
                                <select name="role_id[]" id="role_id" class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" multiple>
                                    <option selected disabled>Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ (in_array($role->id,$admin->roles->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if($errors->has('role_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('role_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" value="1" {{ $admin->active ? 'checked' : '' }} name="activation" class="form-check-input" id="active">
                            {{ Form::label('active', 'Active', array('class' => 'form-check-label')) }}
                        </div>

                        <div class="row mt-40">
                            <div class="col-md-6">
                                <a href="{{ route('admin.show') }}" class="btn btn-danger btn-sm">Back</a>
                            </div>
                            <div class="col-md-6 clearfix">
                                <button type="submit" class="btn btn-sm btn-primary float-right">Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
