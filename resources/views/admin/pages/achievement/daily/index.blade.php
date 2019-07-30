@extends('admin.template')

@section('title', 'Daily')

@section('stylesheets')
    
@endsection

@section('pageheader')
    <div class="page-header">
        <h1 class="page-title">Achievement</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.home') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Daily</li>
        </ol>
    </div>
@endsection

@section('content')
    @php
        function convert_month($month) {
            if ($month == 1) return 'January';
            else if ($month == 2) return 'February';
            else if ($month == 3) return 'Maret';
            else if ($month == 4) return 'April';
            else if ($month == 5) return 'Mei';
            else if ($month == 6) return 'Juni';
            else if ($month == 7) return 'Juli';
            else if ($month == 8) return 'Agustus';
            else if ($month == 9) return 'September';
            else if ($month == 10) return 'Oktober';
            else if ($month == 11) return 'November';
            else if ($month == 12) return 'Desember';
        }
    @endphp
    <!-- Add -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-modal-title">Add Daily</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="add-form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('yearly_achievement_id', 'Year', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        <select name="yearly_achievement_id" id="add-yearly" class="form-control" required="">
                                            <option>-- Select Year --</option>
                                            @foreach($yearlys as $yearly)
                                                <option value="{{ $yearly->id }}">{{ $yearly->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="alert alert-danger d-none error-add-yearly p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('monthly_achievement_id', 'Month', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        <select name="monthly_achievement_id" id="add-monthly" class="form-control" required="">
                                            <option>Select Year First</option>
                                            {{-- @foreach($monthlys as $monthly)
                                                <option value="{{ $monthly->id }}">{{ $monthly->name }}</option>
                                            @endforeach --}}
                                        </select>
                                        <div class="alert alert-danger d-none error-add-monthly p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('name', 'Tanggal', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'add-name', 'required' => '', 'placeholder' => 'Tanggal')) }}
                                        <div class="alert alert-danger d-none error-add-name p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add" data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Show -->
    <div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="show-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="show-modal-title">Show</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td style="width: 150px;">Name</td>
                                    <td style="width: 10px;">:</td>
                                    <td class="show-name"></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">Year</td>
                                    <td style="width: 10px;">:</td>
                                    <td class="show-yearly"></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">Month</td>
                                    <td style="width: 10px;">:</td>
                                    <td class="show-monthly"></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">Target</td>
                                    <td style="width: 10px;">:</td>
                                    <td class="show-target"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modal-title">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="edit-form">
                        <input type="text" name="" id="id-edit" hidden>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('yearly_achievement_id', 'Year', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        <select name="yearly_achievement_id" id="edit-yearly" class="form-control">
                                            <option>-- Select Year --</option>
                                            @foreach($yearlys as $yearly)
                                                <option value="{{ $yearly->id }}">{{ $yearly->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="alert alert-danger d-none error-edit-yearly p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('monthly_achievement_id', 'Month', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        <select name="monthly_achievement_id" id="edit-monthly" class="form-control">
                                            <option>-- Select Month --</option>
                                            @foreach($monthlys as $monthly)
                                                <option value="{{ $monthly->id }}">{{ convert_month($monthly->name) }}</option>
                                            @endforeach
                                        </select>
                                        <div class="alert alert-danger d-none error-edit-monthly p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('name', 'Tanggal', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'edit-name', 'placeholder' => 'Tanggal')) }}
                                        <div class="alert alert-danger d-none error-edit-name p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary edit" data-dismiss="modal">Edit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-modal-title">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="delete-title text-center font-weight-bold">Are you sure want delete this Date?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Auto Generate -->
    <div class="modal fade" id="auto-generate-modal" tabindex="-1" role="dialog" aria-labelledby="auto-generate-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="auto-generate-title">Auto Generate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="auto-generate-form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="yearly_achievement_id" id="auto-generate-yearly" class="form-control" required="">
                                            <option>-- Select Year --</option>
                                            @foreach($yearlys as $yearly)
                                                <option value="{{ $yearly->id }}">{{ $yearly->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                                <div class="row mt-15">
                                    <div class="col-md-6">
                                        <select name="monthly_achievement_id" id="auto-generate-monthly" class="form-control" required="">
                                            <option>Select Year First</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="text-right">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-success btn-generate">
                                                <i class="icon md-plus" aria-hidden="true"></i> Generate
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-30">
                                        <div id="daily-generate">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-30">
                                <div id="daily-generate">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary auto-generate-save" data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <header class="panel-heading">
                    <h3 class="panel-title">Date List</h3>
                </header>

                <div class="panel-body">
                    <div class="row">
                        {{--<div class="col-md-6">
                            <div class="mb-15">
                                <a href="javascript:void(0)" class="btn btn-sm btn-success add-daily">
                                    <i class="icon md-plus" aria-hidden="true"></i> Add
                                </a>
                            </div>
                        </div>--}}

                        <div class="col-md-3">
                            <select name="yearly_achievement_id" id="datatable-yearly" class="form-control" required="">
                                <option>-- Select Periode --</option>
                                @foreach($yearlys as $yearly)
                                    <option value="{{ $yearly->id }}">{{ $yearly->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="monthly_achievement_id" id="datatable-monthly" class="form-control" required="">
                                <option>Select Periode First</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-15 text-right">
                                <a href="javascript:void(0)" class="btn btn-sm btn-success add-auto-generate">
                                    <i class="icon md-plus" aria-hidden="true"></i> Auto Generate
                                </a>
                            </div>
                        </div>
                    </div>

                    @if(count($dailys) > 0)
                        <div class="table-responsive">
                            <table class="ui table table-bordered table-striped table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Target</th>
                                        {{--<th>Action</th>--}}
                                    </tr>
                                </thead>
                                <tbody id="dailys-crud">
                                    {{--@foreach($dailys as $daily)
                                        <tr id="daily-id-{{ $daily->id }}">
                                            <td>{{ $daily->name }}</td>
                                            <td>{{ $daily->yearly_achievement->name }}</td>
                                            <td>{{ convert_month($daily->monthly_achievement->name) }} </td>
                                            <td>{{ number_format($daily->target) }} Ton</td>
                                            <td class="actions">
                                                <a href="javascript:void(0)" data-id="{{ $daily->id }}" data-name="{{ $daily->name }}" data-yearly="{{ $daily->yearly_achievement->name }}" data-monthly="{{ $daily->monthly_achievement->name }}" data-target="{{ $daily->target }}" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-daily" data-toggle="tooltip" data-original-title="Show">
                                                    <i class="icon md-wrench" aria-hidden="true"></i> Show
                                                </a>
                                                <a href="javascript:void(0)" data-id="{{ $daily->id }}" data-name="{{ $daily->name }}" data-yearly="{{ $daily->yearly_achievement->id }}" data-monthly="{{ $daily->monthly_achievement->id }}" data-target="{{ $daily->target }}" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-daily" data-toggle="tooltip" data-original-title="Edit">
                                                    <i class="icon md-edit" aria-hidden="true"></i> Edit
                                                </a>
                                                <a href="javascript:void(0)" data-id="{{ $daily->id }}" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-daily" data-toggle="tooltip" data-original-title="Delete">
                                                    <i class="icon md-delete" aria-hidden="true"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    @else
                    <!-- <h3 class="no-result mt-2">No results found</h3> -->
                        <div class="table-responsive">
                            <table class="ui table table-bordered table-striped table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Target</th>
                                        {{--<th>Action</th>--}}
                                    </tr>
                                </thead>
                                <tbody id="dailys-crud">

                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        /* Add */
        $(document).on('click', '.add-daily', function() {
            $('#add-form').trigger('reset');
            $('#add-monthly').replaceWith(
                "<select name='monthly_achievement_id' id='add-monthly' class='form-control' required=''>" +
                    "<option value=''>Select Year First</option>" +
                "</select>");
            $('#add-modal').modal('show');
        });

        $(document).on('click', '.add-auto-generate', function() {
            $('#auto-generate-form').trigger('reset');
            $('#auto-generate-monthly').replaceWith(
                "<select name='monthly_achievement_id' id='auto-generate-monthly' class='form-control' required=''>" +
                    "<option value=''>Select Year First</option>" +
                "</select>");
            $('#daily-generate').replaceWith("<div id='daily-generate'></div>");
            $('#auto-generate-modal').modal('show');
        });

        $('#add-form').keydown(function (e) {
            if (e.which == 13) {
                e.preventDefault();
                add_submit();
                $('#add-modal').modal('hide');
            }
        });

        $('.modal-footer').on('click', '.add', function() {
            add_submit();
        });


        /* Show */
        $(document).on('click', '.show-daily', function() {
            $('.show-name').text($(this).data('name'));
            $('.show-yearly').text($(this).data('yearly'));
            $('.show-monthly').text(convert_month($(this).data('monthly')));
            $('.show-target').text(($(this).data('target')) ? format_money($(this).data('target')) : '0' + ' Ton');
            $('#show-modal').modal('show');
        });

        /* Edit */
        $(document).on('click', '.edit-daily', function() {
            $('#id-edit').val($(this).data('id'));
            $('#edit-name').val($(this).data('name'));
            $('#edit-yearly').val($(this).data('yearly'));
            $('#edit-monthly').val($(this).data('monthly'));
            $('#edit-modal').modal('show');

            id_edit = $(this).data('id');
        });

        $('#edit-form').keydown(function (e) {
            if (e.which == 13) {
                e.preventDefault();
                edit_submit();
                $('#edit-modal').modal('hide');
            }
        });

        $('.modal-footer').on('click', '.edit', function() {
            edit_submit();
        });

        /* Delete */
        $(document).on('click', '.delete-daily', function() {
            $('#delete-modal').modal('show');
            id = $(this).data('id');
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'daily/' + id,
                success: function(data) {
                    toastr.success('Successfully deleted Date!', 'Success Alert', {timeOut: 5000});
                    $('#daily-id-' + id).remove();
                }
            });
        });

        function add_submit() {
            let add_form_data = new FormData();

            let name = $('#add-name').val();
            let yearly_achievement_id = $('#add-yearly').val();
            let monthly_achievement_id = $('#add-monthly').val();

            add_form_data.append('name', name);
            add_form_data.append('yearly_achievement_id', yearly_achievement_id);
            add_form_data.append('monthly_achievement_id', monthly_achievement_id);

            $.ajax({
                type: 'POST',
                url: 'daily',
                data: add_form_data,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    $('.error-add-name').addClass('d-none');
                    $('.error-add-yearly').addClass('d-none');
                    $('.error-add-monthly').addClass('d-none');

                    if (data.errors) {
                        setTimeout(function() {
                            $('#add-modal').modal('show');
                            toastr.error(data.errors, 'Error Alert', {timeOut: 5000});
                        }, 500);

                        /*if (data.errors.name) {
                            toastr.error('Name Error!', 'Error Alert', {timeOut: 5000});
                            $('.error-add-name').removeClass('d-none');
                            $('.error-add-name').text(data.errors.name);
                        }
                        if (data.errors.yearly) {
                            toastr.error('Year Error!', 'Error Alert', {timeOut: 5000});
                            $('.error-add-yearly').removeClass('d-none');
                            $('.error-add-yearly').text(data.errors.yearly);
                        }
                        if (data.errors.monthly) {
                            toastr.error('Month Error!', 'Error Alert', {timeOut: 5000});
                            $('.error-add-monthly').removeClass('d-none');
                            $('.error-add-monthly').text(data.errors.monthly);
                        }*/
                    } else {
                        toastr.success('Successfully added Date!', 'Success Alert', {timeOut: 5000});
                        $('#datatable').append(
                            "<tr id='daily-id-" + data.id + "'>" +
                                "<td>" + data.name + "</td>" +
                                "<td>" + data.yearly_achievement.name + "</td>" +
                                "<td>" + convert_month(data.monthly_achievement.name) + "</td>" +
                                "<td>" + ((value.target) ? format_money(parseFloat(value.target)) : '0') + " Ton" + "</td>" +
                                /*"<td class='actions'>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' data-name='" + data.name + "' data-yearly='" + data.yearly_achievement.name + "' data-monthly='" + data.monthly_achievement.name + "' data-target='" + data.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-daily' data-toggle='tooltip' data-original-title='Show'>" +
                                        "<i class='icon md-wrench' aria-hidden='true'></i> Show" +
                                    "</a>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' data-name='" + data.name + "' data-yearly='" + data.yearly_achievement.id + "' data-monthly='" + data.monthly_achievement.id + "' data-target='" + data.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-daily' data-toggle='tooltip' data-original-title='Edit'>" +
                                        "<i class='icon md-edit' aria-hidden='true'></i> Edit" +
                                    "</a>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-daily' data-toggle='tooltip' data-original-title='Delete'>" +
                                        "<i class='icon md-delete' aria-hidden='true'></i> Delete" +
                                    "</a>" +
                                "</td>" +*/
                            "</tr>");
                    }
                },
                error: function(data) {
                    toastr.error(data.errors, 'Error Alert', {timeOut: 5000});
                }
            });
        }

        function edit_submit() {
            let edit_form_data = new FormData();

            let id = $('#id-edit').val();
            let name = $('#edit-name').val();
            let yearly_achievement_id = $('#edit-yearly').val();
            let monthly_achievement_id = $('#edit-monthly').val();

            edit_form_data.append('id', id);
            edit_form_data.append('name', name);
            edit_form_data.append('yearly_achievement_id', yearly_achievement_id);
            edit_form_data.append('monthly_achievement_id', monthly_achievement_id);
            edit_form_data.append('_method', 'PUT');

            $.ajax({
                type: 'POST',
                url: 'daily/' + id_edit,
                data: edit_form_data,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    $('.error-edit-name').addClass('d-none');
                    $('.error-edit-yearly').addClass('d-none');
                    $('.error-edit-monthly').addClass('d-none');

                    if (data.errors) {
                        setTimeout(function() {
                            $('#edit-modal').modal('show');
                            toastr.error(data.errors, 'Error Alert', {timeOut: 5000});
                        }, 500);

                        /*if (data.errors.name) {
                            toastr.error('Name Error!', 'Error Alert', {timeOut: 5000});
                            $('.error-edit-name').removeClass('d-none');
                            $('.error-edit-name').text(data.errors.name);
                        }
                        if (data.errors.yearly) {
                            toastr.error('Year Error!', 'Error Alert', {timeOut: 5000});
                            $('.error-add-yearly').removeClass('d-none');
                            $('.error-add-yearly').text(data.errors.yearly);
                        }
                        if (data.errors.montly) {
                            toastr.error('Month Error!', 'Error Alert', {timeOut: 5000});
                            $('.error-add-montly').removeClass('d-none');
                            $('.error-add-montly').text(data.errors.montly);
                        }*/
                    } else {
                        toastr.success('Successfully updated Date!', 'Success Alert', {timeOut: 5000});
                        $('#daily-id-' + data.id).replaceWith(
                            "<tr id='daily-id-" + data.id + "'>" +
                                "<td>" + data.name + "</td>" +
                                "<td>" + data.yearly_achievement.name + "</td>" +
                                "<td>" + convert_month(data.monthly_achievement.name) + "</td>" +
                                "<td>" + ((data.target) ? format_money(parseFloat(data.target)) : '0') + " Ton" + "</td>" +
                                /*"<td class='actions'>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' data-name='" + data.name + "' data-yearly='" + data.yearly_achievement.name + "' data-monthly='" + data.monthly_achievement.name + "' data-target='" + data.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-daily' data-toggle='tooltip' data-original-title='Show'>" +
                                        "<i class='icon md-wrench' aria-hidden='true'></i> Show" +
                                    "</a>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' data-name='" + data.name + "' data-yearly='" + data.yearly_achievement.id + "' data-monthly='" + data.monthly_achievement.id + "' data-target='" + data.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-daily' data-toggle='tooltip' data-original-title='Edit'>" +
                                        "<i class='icon md-edit' aria-hidden='true'></i> Edit" +
                                    "</a>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-daily' data-toggle='tooltip' data-original-title='Delete'>" +
                                        "<i class='icon md-delete' aria-hidden='true'></i> Delete" +
                                    "</a>" +
                                "</td>" +*/
                            "</tr>");
                    }
                },
                error: function(data) {
                    toastr.error(data.errors, 'Error Alert', {timeOut: 5000});
                }
            });
        }

        function format_money(n) {
            return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,').replace('.00', '');
        }

        function convert_month(month) {
            if (month == 1) return 'January';
            else if (month == 2) return 'February';
            else if (month == 3) return 'Maret';
            else if (month == 4) return 'April';
            else if (month == 5) return 'Mei';
            else if (month == 6) return 'Juni';
            else if (month == 7) return 'Juli';
            else if (month == 8) return 'Agustus';
            else if (month == 9) return 'September';
            else if (month == 10) return 'Oktober';
            else if (month == 11) return 'November';
            else if (month == 12) return 'Desember';
            else return 'Undefined Month';
        }

        /* Vendor Selected */
        $('#add-yearly').change(function() {
            $.ajax({
                type: 'GET',
                url: 'daily/monthly/yearly/' + $(this).val(),
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.errors) {

                    } else {
                        // toastr.success('Successfully loaded Brand!', 'Success Alert', {timeOut: 5000});
                        $('#add-monthly').replaceWith(
                            "<select name='monthly_achievement_id' id='add-monthly' class='form-control' required=''>" +
                                "<option value=''>-- Select Month --</option>");
                        $.each(data, function(index, value) {
                            console.log(value);
                            $('#add-monthly').append(
                                "<option value='" + value.id + "'>" + convert_month(value.name) + "</option>"
                            );
                        });
                        $('#add-monthly').append("</select>");
                    }
                },
                error: function(data) {
                    toastr.error('Failed', 'Error Alert', {timeOut: 5000});
                }
            });
        });

        $('#datatable-yearly').change(function() {
            $.ajax({
                type: 'GET',
                url: 'daily/monthly/yearly/' + $(this).val(),
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.errors) {

                    } else {
                        // toastr.success('Successfully loaded Brand!', 'Success Alert', {timeOut: 5000});
                        $('#datatable-monthly').replaceWith(
                            "<select name='monthly_achievement_id' id='datatable-monthly' class='form-control' required=''>" +
                            "<option value=''>-- Select Month --</option>");
                        $.each(data, function(index, value) {
                            console.log(value);
                            $('#datatable-monthly').append(
                                "<option value='" + value.id + "'>" + convert_month(value.name) + "</option>"
                            );
                        });
                        $('#datatable-monthly').append("</select>");

                        $('#datatable-monthly').change(function() {
                            $.ajax({
                                type: 'GET',
                                url: 'daily/monthly/' + $(this).val(),
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    console.log(data);
                                    if (data.errors) {

                                    } else {
                                        // toastr.success('Successfully loaded Brand!', 'Success Alert', {timeOut: 5000});
                                        $('#dailys-crud').replaceWith("<tbody id='dailys-crud'>");
                                        $.each(data, function(index, value) {
                                            console.log(value);
                                            $('#datatable').append(
                                                "<tr id='daily-id-" + value.id + "'>" +
                                                    "<td>" + value.name + "</td>" +
                                                    "<td>" + /*get_year_value(value.yearly_achievement.start, value.yearly_achievement.end, value.monthly_achievement.name)*/ value.monthly_achievement.year_name + "</td>" +
                                                    "<td>" + convert_month(value.monthly_achievement.name) + "</td>" +
                                                    "<td>" + ((value.target) ? format_money(parseFloat(value.target)) : '0') + " Ton" + "</td>" +
                                                    /*"<td class='actions'>" +
                                                        "<a href='javascript:void(0)' data-id='" + value.id + "' data-name='" + value.name + "' data-yearly='" + value.yearly_achievement.name + "' data-monthly='" + value.monthly_achievement.name + "' data-target='" + value.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-daily' data-toggle='tooltip' data-original-title='Show'>" +
                                                            "<i class='icon md-wrench' aria-hidden='true'></i> Show" +
                                                        "</a>" +
                                                        "<a href='javascript:void(0)' data-id='" + value.id + "' data-name='" + value.name + "' data-yearly='" + value.yearly_achievement.id + "' data-monthly='" + value.monthly_achievement.id + "' data-target='" + value.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-daily' data-toggle='tooltip' data-original-title='Edit'>" +
                                                            "<i class='icon md-edit' aria-hidden='true'></i> Edit" +
                                                        "</a>" +
                                                        "<a href='javascript:void(0)' data-id='" + value.id + "' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-daily' data-toggle='tooltip' data-original-title='Delete'>" +
                                                            "<i class='icon md-delete' aria-hidden='true'></i> Delete" +
                                                        "</a>" +
                                                    "</td>" +*/
                                                "</tr>");
                                        });
                                        $('#dailys-crud').append("</tbody>");
                                    }
                                },
                                error: function(data) {
                                    toastr.error('Failed', 'Error Alert', {timeOut: 5000});
                                }
                            });
                        });
                    }
                },
                error: function(data) {
                    toastr.error('Failed', 'Error Alert', {timeOut: 5000});
                }
            });
        });

        $('#auto-generate-yearly').change(function() {
            $.ajax({
                type: 'GET',
                url: 'daily/monthly/yearly/' + $(this).val(),
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.errors) {

                    } else {
                        // toastr.success('Successfully loaded Brand!', 'Success Alert', {timeOut: 5000});
                        $('#auto-generate-monthly').replaceWith(
                            "<select name='monthly_achievement_id' id='auto-generate-monthly' class='form-control' required=''>" +
                            "<option value=''>-- Select Month --</option>");
                        $.each(data, function(index, value) {
                            console.log(value);
                            $('#auto-generate-monthly').append(
                                "<option value='" + value.id + "'>" + convert_month(value.name) + "</option>"
                            );
                        });
                        $('#auto-generate-monthly').append("</select>");

                        $('#auto-generate-monthly').change(function() {
                            let auto_generate_monthly = $(this).val();
                            $.ajax({
                                type: 'GET',
                                url: 'daily/monthly/' + $(this).val(),
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    console.log(data);
                                    if (data.errors) {

                                    } else {
                                        // toastr.success('Successfully loaded Brand!', 'Success Alert', {timeOut: 5000});
                                        $('#daily-generate').replaceWith(
                                            "<div id='daily-generate'>" +
                                                "<div class='row'>"
                                        );
                                        $.each(data, function(index, value) {
                                            console.log(value);
                                            $('#daily-generate').append(
                                                "<div class='col-md-12'>" +
                                                    "<div class='form-group row'>" +
                                                        "<label for='' class='col-sm-6 col-form-label'>" + "Tanggal " + value.name + "</label>" +
                                                        "<div class='col-sm-6'>" +
                                                            "<input class='form-control generate-result' placeholder='Target' name='daily" + value.id + "' type='text' value='" + ((value.target) ? value.target : '') + "' disabled>" +
                                                        "</div>" +
                                                    "</div>" +
                                                "</div>"
                                            );
                                        });
                                        $('#daily-generate').append(
                                                "</div>" +
                                            "</div>"
                                        );

                                        $(document).on('click', '.btn-generate', function() {
                                            if (auto_generate_monthly != undefined || auto_generate_monthly != 0 || auto_generate_monthly != null) {
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'generate/monthly/' + auto_generate_monthly,
                                                    dataType: 'json',
                                                    processData: false,
                                                    contentType: false,
                                                    success: function(data) {
                                                        if (data.errors) {

                                                        } else {
                                                            console.log(data);
                                                            $('.generate-result').val(data);

                                                            $(document).on('click', '.auto-generate-save', function() {
                                                                let save_target = new FormData();

                                                                save_target.append('monthly_id', auto_generate_monthly);
                                                                save_target.append('target', data);

                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: 'daily/save/generate/target',
                                                                    data: save_target,
                                                                    dataType: 'json',
                                                                    processData: false,
                                                                    contentType: false,
                                                                    success: function(data) {
                                                                        if (data.errors) {

                                                                        } else {
                                                                            console.log(data);
                                                                            toastr.success('Successfully Generate Target!', 'Success Alert', {timeOut: 5000});
                                                                            $.each(data, function(index, value) {
                                                                                console.log(value);
                                                                                $('#daily-id-' + value.id).replaceWith(
                                                                                    "<tr id='daily-id-" + value.id + "'>" +
                                                                                        "<td>" + value.name + "</td>" +
                                                                                        "<td>" + value.monthly_achievement.year_name + "</td>" +
                                                                                        "<td>" + convert_month(value.monthly_achievement.name) + "</td>" +
                                                                                        "<td>" + ((value.target) ? format_money(parseFloat(value.target)) : '0') + " Ton" + "</td>" +
                                                                                        /*"<td class='actions'>" +
                                                                                            "<a href='javascript:void(0)' data-id='" + value.id + "' data-name='" + value.name + "' data-yearly='" + value.yearly_achievement.name + "' data-monthly='" + value.monthly_achievement.name + "' data-target='" + value.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-daily' data-toggle='tooltip' data-original-title='Show'>" +
                                                                                                "<i class='icon md-wrench' aria-hidden='true'></i> Show" +
                                                                                            "</a>" +
                                                                                            "<a href='javascript:void(0)' data-id='" + value.id + "' data-name='" + value.name + "' data-yearly='" + value.yearly_achievement.id + "' data-monthly='" + value.monthly_achievement.id + "' data-target='" + value.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-daily' data-toggle='tooltip' data-original-title='Edit'>" +
                                                                                                "<i class='icon md-edit' aria-hidden='true'></i> Edit" +
                                                                                            "</a>" +
                                                                                            "<a href='javascript:void(0)' data-id='" + value.id + "' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-daily' data-toggle='tooltip' data-original-title='Delete'>" +
                                                                                                "<i class='icon md-delete' aria-hidden='true'></i> Delete" +
                                                                                            "</a>" +
                                                                                        "</td>" +*/
                                                                                    "</tr>");
                                                                            });
                                                                        }
                                                                    },
                                                                    error: function(data) {
                                                                        toastr.error('Failed', 'Error Alert', {timeOut: 5000});
                                                                    }
                                                                });
                                                            });
                                                        }
                                                    },
                                                    error: function(data) {
                                                        toastr.error('Failed', 'Error Alert', {timeOut: 5000});
                                                    }
                                                });
                                            }
                                        });
                                    }
                                },
                                error: function(data) {
                                    toastr.error('Failed', 'Error Alert', {timeOut: 5000});
                                }
                            });
                        });
                    }
                },
                error: function(data) {
                    toastr.error('Failed', 'Error Alert', {timeOut: 5000});
                }
            });
        });

        $('#edit-yearly').change(function() {
            $.ajax({
                type: 'GET',
                url: 'daily/monthly/yearly/' + $(this).val(),
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.errors) {

                    } else {
                        // toastr.success('Successfully loaded Brand!', 'Success Alert', {timeOut: 5000});
                        $('#edit-monthly').replaceWith(
                            "<select name='monthly_achievement_id' id='edit-monthly' class='form-control' required=''>" +
                                "<option value=''>-- Select Monthly --</option>");
                        $.each(data, function(index, value) {
                            console.log(value);
                            $('#edit-monthly').append(
                                "<option value='" + value.id + "'>" + convert_month(value.name) + "</option>"
                            );
                        });
                        $('#edit-monthly').append("</select>");
                    }
                },
                error: function(data) {
                    toastr.error('Failed', 'Error Alert', {timeOut: 5000});
                }
            });
        });

        function get_year_value(start, end, current_month) {
            let date_start = new Date(start);
            let date_end = new Date(end);

            if (current_month <= date_start.getMonth()) {
                return date_end.getFullYear();
            } else {
                return date_start.getFullYear();
            }
        }
    </script>
@endsection