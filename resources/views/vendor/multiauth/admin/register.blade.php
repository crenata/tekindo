@extends('admin.template')

@section('title', 'Register')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">New {{ ucfirst(config('multiauth.prefix')) }}</h3>
                </div>
                <div class="panel-body">
                    @include('multiauth::message')

                    {{ Form::open(array('route' => 'admin.register', 'class' => 'form-horizontal')) }}
                        <div class="form-group row">
                            {{ Form::label('name', 'Name', array('class' => 'col-sm-6 col-form-label')) }}
                            <div class="col-sm-12">
                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} row">
                            {{ Form::label('email', 'Email', array('class' => 'col-sm-6 col-form-label')) }}
                            <div class="col-sm-12">
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? 'text-danger' : '' }} row">
                            {{ Form::label('password', 'Password', array('class' => 'col-sm-6 col-form-label')) }}
                            <div class="col-sm-12">
                                <input id="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('password-confirm', 'Confirm Password', array('class' => 'col-sm-6 col-form-label')) }}
                            <div class="col-sm-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('role_id', 'Assign Role', array('class' => 'col-sm-6 col-form-label')) }}
                            <div class="col-sm-12">
                                <select name="role_id[]" id="role_id" class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" multiple>
                                    <option selected disabled>Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-40">
                            <div class="col-md-6">
                                <a href="{{ route('admin.show') }}" class="btn btn-danger btn-sm">Back</a>
                            </div>
                            <div class="col-md-6 clearfix">
                                <button type="submit" class="btn btn-primary btn-sm float-right">Register</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
