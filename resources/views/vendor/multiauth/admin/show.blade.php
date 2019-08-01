@extends('admin.template')

@section('title', 'View Admins')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ ucfirst(config('multiauth.prefix')) }} List</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-15">
                                <a href="{{ route('admin.register') }}" class="btn btn-sm btn-success">
                                    <i class="icon md-plus" aria-hidden="true"></i> New {{ ucfirst(config('multiauth.prefix')) }}
                                </a>
                            </div>
                        </div>
                    </div>

                    @include('multiauth::message')

                    @if(count($admins) > 0)
                        <div class="table-responsive">
                            <table class="ui table table-bordered table-striped table-hover" id="datatable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="admins-crud">
                                @foreach($admins as $admin)
                                    <tr id="admin-id-{{ $admin->id }}">
                                        <td>{{ $admin->name }}</td>
                                        <td>
                                            <span class="badge m-0 p-0">
                                                @foreach($admin->roles as $role)
                                                    <span class="badge-warning badge-pill {{ $loop->first ? '' : 'ml-2' }}">{{ $role->name }}</span>
                                                @endforeach
                                            </span>
                                        </td>
                                        <td>{{ $admin->active ? 'Active' : 'Inactive' }}</td>
                                        <td class="actions">
                                            <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-admin" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="icon md-edit" aria-hidden="true"></i> Edit
                                            </a>
                                            <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $admin->id }}').submit();" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-admin" data-toggle="tooltip" data-original-title="Delete">
                                                <i class="icon md-delete" aria-hidden="true"></i> Delete
                                            </a>
                                            <form id="delete-form-{{ $admin->id }}" action="{{ route('admin.delete', $admin->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('delete')
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
