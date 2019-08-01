@extends('admin.template')

@section('title', 'View Roles')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Roles</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-15">
                                <a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-success">
                                    <i class="icon md-plus" aria-hidden="true"></i> New Role
                                </a>
                            </div>
                        </div>
                    </div>

                    @include('multiauth::message')

                    @if(count($roles) > 0)
                        <div class="table-responsive">
                            <table class="ui table table-bordered table-striped table-hover" id="datatable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="admins-crud">
                                @foreach($roles as $role)
                                    <tr id="admin-id-{{ $role->id }}">
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <span class="badge badge-primary badge-pill">{{ $role->admins->count() }} {{ ucfirst(config('multiauth.prefix')) }}</span>
                                        </td>
                                        <td class="actions">
                                            <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-admin" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="icon md-edit" aria-hidden="true"></i> Edit
                                            </a>
                                            <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-admin" data-toggle="tooltip" data-original-title="Delete">
                                                <i class="icon md-delete" aria-hidden="true"></i> Delete
                                            </a>
                                            <form id="delete-form-{{ $role->id }}"
                                                  action="{{ route('admin.role.delete',$role->id) }}" method="POST"
                                                  style="display: none;">
                                                @csrf @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h4>No {{ ucfirst(config('multiauth.prefix')) }} Created Yet, Only <b><i><u>Super</u></i></b> {{ ucfirst(config('multiauth.prefix')) }} is Available.</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
