@extends('admin.template')

@section('title', 'Daily')

@section('stylesheets')

@endsection

@section('pageheader')
    <div class="page-header">
        <h1 class="page-title">Inbound</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.home') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Daily</li>
        </ol>
    </div>
@endsection

@section('content')
    <!-- Add -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('yearly_achievement_id', 'Year', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        <select name="yearly_achievement_id" id="add-yearly" class="form-control" required="">
                                            <option>-- Select Periode --</option>
                                            @foreach($yearlys as $yearly)
                                                <option value="{{ $yearly->id }}">{{ $yearly->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="alert alert-danger d-none error-add-yearly p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('monthly_achievement_id', 'Month', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        <select name="monthly_achievement_id" id="add-monthly" class="form-control" required="">
                                            <option>Select Periode First</option>
                                        </select>
                                        <div class="alert alert-danger d-none error-add-monthly p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('daily_achievement_id', 'Daily Achievement', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        <select name="daily_achievement_id" id="add-daily-achievement" class="form-control" required="">
                                            <option>Select Month First</option>
                                        </select>
                                        <div class="alert alert-danger d-none error-add-daily-achievement p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('total', 'Total', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            {{ Form::number('total', null, array('class' => 'form-control', 'id' => 'add-total', 'required' => '', 'placeholder' => 'Total')) }}
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-info text-white">Ton</span>
                                            </div>
                                        </div>
                                        <div class="alert alert-danger d-none error-add-total p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('note', 'Note', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        {{ Form::textarea('note', null, array('class' => 'form-control', 'id' => 'add-note', 'required' => '', 'placeholder' => 'Note', 'rows' => '5')) }}
                                        <div class="alert alert-danger d-none error-add-note p-2 mt-2"></div>
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
                                    <td style="width: 150px;">Date</td>
                                    <td style="width: 10px;">:</td>
                                    <td class="show-date"></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">Target</td>
                                    <td style="width: 10px;">:</td>
                                    <td class="show-target"></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">Total</td>
                                    <td style="width: 10px;">:</td>
                                    <td class="show-total"></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">Status</td>
                                    <td style="width: 10px;">:</td>
                                    <td class="show-status"></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">Note</td>
                                    <td style="width: 10px;">:</td>
                                    <td class="show-note"></td>
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
                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('yearly_achievement_id', 'Year', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        <select name="yearly_achievement_id" id="edit-yearly" class="form-control">
                                            <option>-- Select Periode --</option>
                                            @foreach($yearlys as $yearly)
                                                <option value="{{ $yearly->id }}">{{ $yearly->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="alert alert-danger d-none error-edit-yearly p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('monthly_achievement_id', 'Month', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        <select name="monthly_achievement_id" id="edit-monthly" class="form-control">
                                            <option>Select Periode First</option>
                                        </select>
                                        <div class="alert alert-danger d-none error-edit-monthly p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('daily_achievement_id', 'Daily Achievement', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        <select name="daily_achievement_id" id="edit-daily-achievement" class="form-control">
                                            <option>Select Month First</option>
                                        </select>
                                        <div class="alert alert-danger d-none error-edit-daily-achievement p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('total', 'Total', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            {{ Form::number('total', null, array('class' => 'form-control', 'id' => 'edit-total', 'placeholder' => 'Total')) }}
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-info text-white">Ton</span>
                                            </div>
                                        </div>
                                        <div class="alert alert-danger d-none error-edit-total p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('note', 'Note', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        {{ Form::textarea('note', null, array('class' => 'form-control', 'id' => 'edit-note', 'placeholder' => 'Note', 'rows' => '5')) }}
                                        <div class="alert alert-danger d-none error-edit-note p-2 mt-2"></div>
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
                    <h5 class="delete-title text-center font-weight-bold">Are you sure want delete this Daily?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <header class="panel-heading">
                    <h3 class="panel-title">Daily List</h3>
                </header>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-15">
                                <a href="javascript:void(0)" class="btn btn-sm btn-success add-daily">
                                    <i class="icon md-plus" aria-hidden="true"></i> Add
                                </a>
                            </div>
                        </div>
                    </div>

                    @if(count($dailys) > 0)
                        <div class="table-responsive">
                            <table class="ui table table-bordered table-striped table-hover" id="datatable">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Target</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="dailys-crud">
                                @foreach($dailys as $daily)
                                    <tr id="daily-id-{{ $daily->id }}">
                                        <td>{{ date('D, j F Y', strtotime($daily->daily_achievement->name)) }}</td>
                                        <td>{{ number_format($daily->daily_achievement->target, 2) }} Ton</td>
                                        <td>{{ number_format($daily->total, 2) }} Ton</td>
                                        <td>{{ $daily->status }} </td>
                                        <td>{{ substr(strip_tags($daily->note), 0, 100) }}{{ strlen(strip_tags($daily->note)) > 100 ? "..." : "" }}</td>
                                        <td class="actions">
                                            <a href="javascript:void(0)" data-id="{{ $daily->id }}" data-date="{{ $daily->daily_achievement->name }}" data-yearlyachievementid="{{ $daily->daily_achievement->yearly_achievement_id }}" data-monthlyachievementid="{{ $daily->daily_achievement->monthly_achievement_id }}" data-dailyachievementid="{{ $daily->daily_achievement->id }}" data-total="{{ $daily->total }}" data-status="{{ $daily->status }}" data-note="{{ $daily->note }}" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-daily" data-toggle="tooltip" data-original-title="Show">
                                                <i class="icon md-wrench" aria-hidden="true"></i> Show
                                            </a>
                                            <a href="javascript:void(0)" data-id="{{ $daily->id }}" data-date="{{ $daily->daily_achievement->name }}" data-yearlyachievementid="{{ $daily->daily_achievement->yearly_achievement_id }}" data-monthlyachievementid="{{ $daily->daily_achievement->monthly_achievement_id }}" data-dailyachievementid="{{ $daily->daily_achievement->id }}" data-total="{{ $daily->total }}" data-status="{{ $daily->status }}" data-note="{{ $daily->note }}" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-daily" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="icon md-edit" aria-hidden="true"></i> Edit
                                            </a>
                                            <a href="javascript:void(0)" data-id="{{ $daily->id }}" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-daily" data-toggle="tooltip" data-original-title="Delete">
                                                <i class="icon md-delete" aria-hidden="true"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="ui table table-bordered table-striped table-hover" id="datatable">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Target</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Note</th>
                                    <th>Action</th>
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
                    "<option value=''>Select Periode First</option>" +
                "</select>");
            $('#add-daily-achievement').replaceWith(
                "<select name='daily_achievement_id' id='add-daily-achievement' class='form-control' required=''>" +
                    "<option value=''>Select Month First</option>"+
                "</select>");
            $('.error-add-daily-achievement').addClass('d-none');
            $('.error-add-total').addClass('d-none');
            $('.error-add-status').addClass('d-none');
            $('.error-add-note').addClass('d-none');
            $('#add-modal').modal('show');
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
            $('.show-date').text(get_date($(this).data('date')));
            $('.show-target').text((($(this).data('target')) ? format_money($(this).data('target')) + ' Ton' : 0));
            $('.show-total').text(format_money($(this).data('total')) + ' Ton');
            $('.show-status').text($(this).data('status'));
            $('.show-note').text($(this).data('note'));
            $('#show-modal').modal('show');
        });

        /* Edit */
        $(document).on('click', '.edit-daily', function() {
            $('#id-edit').val($(this).data('id'));
            $('#edit-yearly').val($(this).data('yearlyachievementid'));
            $('#edit-total').val($(this).data('total'));
            $('#edit-note').val($(this).data('note'));
            $('.error-edit-daily-achievement').addClass('d-none');
            $('.error-edit-total').addClass('d-none');
            $('.error-edit-status').addClass('d-none');
            $('.error-edit-note').addClass('d-none');
            $('#edit-modal').modal('show');

            let yearly_select = $(this).data('yearlyachievementid');
            let monthly_select = $(this).data('monthlyachievementid');
            let daily_select = $(this).data('dailyachievementid');

            $.ajax({
                type: 'GET',
                url: '{!! url("admin/daily/monthly/yearly") !!}' + '/' + yearly_select,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.errors) {

                    } else {
                        $('#edit-monthly').replaceWith(
                            "<select name='monthly_achievement_id' id='edit-monthly' class='form-control'>" +
                            "<option value=''>-- Select Month --</option>");
                        $.each(data, function(index, value) {
                            console.log(value);
                            if (value.id == monthly_select) {
                                $('#edit-monthly').append(
                                    "<option value='" + value.id + "' selected=''>" + convert_month(value.name) + "</option>"
                                );
                            } else {
                                $('#edit-monthly').append(
                                    "<option value='" + value.id + "'>" + convert_month(value.name) + "</option>"
                                );
                            }
                        });
                        $('#edit-monthly').append("</select>");

                        $.ajax({
                            type: 'GET',
                            url: '{!! url('admin/daily/monthly') !!}' + '/' + monthly_select,
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if (data.errors) {

                                } else {
                                    $('#edit-daily-achievement').replaceWith(
                                        "<select name='daily_achievement_id' id='edit-daily-achievement' class='form-control'>" +
                                        "<option value=''>-- Select Daily --</option>");
                                    $.each(data, function(index, value) {
                                        console.log(value);
                                        if (value.id == daily_select) {
                                            $('#edit-daily-achievement').append(
                                                "<option value='" + value.id + "' selected=''>" + value.name + "</option>"
                                            );
                                        } else {
                                            $('#edit-daily-achievement').append(
                                                "<option value='" + value.id + "'>" + value.name + "</option>"
                                            );
                                        }
                                    });
                                    $('#edit-daily-achievement').append("</select>");
                                }
                            },
                            error: function(data) {
                                toastr.error('Failed', 'Error Alert', {timeOut: 5000});
                            }
                        });

                        $('#edit-monthly').change(function() {
                            $.ajax({
                                type: 'GET',
                                url: '{!! url('admin/daily/monthly') !!}' + '/' + $(this).val(),
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    if (data.errors) {

                                    } else {
                                        $('#edit-daily-achievement').replaceWith(
                                            "<select name='monthly_achievement_id' id='edit-daily-achievement' class='form-control'>" +
                                            "<option value=''>-- Select Daily --</option>");
                                        $.each(data, function(index, value) {
                                            console.log(value);
                                            $('#edit-daily-achievement').append(
                                                "<option value='" + value.id + "'>" + value.name + "</option>"
                                            );
                                        });
                                        $('#edit-daily-achievement').append("</select>");
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
                url: 'daily-inbound/' + id,
                success: function(data) {
                    toastr.success('Successfully deleted Date!', 'Success Alert', {timeOut: 5000});
                    $('#daily-id-' + id).remove();
                }
            });
        });

        function add_submit() {
            let add_form_data = new FormData();

            let yearly_achievement_id = $('#add-yearly').val();
            let monthly_achievement_id = $('#add-monthly').val();
            let daily_achievement_id = $('#add-daily-achievement').val();
            let total = $('#add-total').val();
            let status = $('#add-status').val();
            let note = $('#add-note').val();

            add_form_data.append('yearly_achievement_id', yearly_achievement_id);
            add_form_data.append('monthly_achievement_id', monthly_achievement_id);
            add_form_data.append('daily_achievement_id', daily_achievement_id);
            add_form_data.append('total', total);
            add_form_data.append('status', status);
            add_form_data.append('note', note);

            $.ajax({
                type: 'POST',
                url: 'daily-inbound',
                data: add_form_data,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                    $('.error-add-daily-achievement').addClass('d-none');
                    $('.error-add-total').addClass('d-none');
                    $('.error-add-status').addClass('d-none');
                    $('.error-add-note').addClass('d-none');

                    if (data.errors) {
                        if (data.errors.daily_achievement_id) {
                            setTimeout(function() {
                                $('#add-modal').modal('show');
                                toastr.error(data.errors.daily_achievement_id, 'Error Alert', {timeOut: 5000});
                            }, 500);
                            $('.error-add-daily_achievement_id').removeClass('d-none');
                            $('.error-add-daily_achievement_id').text(data.errors.daily_achievement_id);
                        } else if (data.errors.total) {
                            setTimeout(function() {
                                $('#add-modal').modal('show');
                                toastr.error(data.errors.total, 'Error Alert', {timeOut: 5000});
                            }, 500);
                            toastr.error('Total Error!', 'Error Alert', {timeOut: 5000});
                            $('.error-add-total').removeClass('d-none');
                            $('.error-add-total').text(data.errors.total);
                        } else if (data.errors.status) {
                            setTimeout(function() {
                                $('#add-modal').modal('show');
                                toastr.error(data.errors.status, 'Error Alert', {timeOut: 5000});
                            }, 500);
                            toastr.error('Status Error!', 'Error Alert', {timeOut: 5000});
                            $('.error-add-status').removeClass('d-none');
                            $('.error-add-status').text(data.errors.status);
                        } else if (data.errors.note) {
                            setTimeout(function() {
                                $('#add-modal').modal('show');
                                toastr.error(data.errors.note, 'Error Alert', {timeOut: 5000});
                            }, 500);
                            toastr.error('Note Error!', 'Error Alert', {timeOut: 5000});
                            $('.error-add-note').removeClass('d-none');
                            $('.error-add-note').text(data.errors.note);
                        } else {
                            setTimeout(function() {
                                $('#add-modal').modal('show');
                                toastr.error(data.errors, 'Error Alert', {timeOut: 5000});
                            }, 500);
                        }
                    } else {
                        toastr.success('Successfully added Date!', 'Success Alert', {timeOut: 5000});
                        $('#datatable').append(
                            "<tr id='daily-id-" + data.id + "'>" +
                                "<td>" + get_date(data.daily_achievement.name) + "</td>" +
                                "<td>" + format_money(parseFloat(data.daily_achievement.target)) + " Ton" + "</td>" +
                                "<td>" + format_money(parseFloat(data.total)) + " Ton" + "</td>" +
                                "<td>" + data.status + "</td>" +
                                "<td>" + data.note + "</td>" +
                                "<td class='actions'>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' data-date='" + data.daily_achievement.name + "' data-yearlyachievementid='" + data.daily_achievement.yearly_achievement_id + "' data-monthlyachievementid='" + data.daily_achievement.monthly_achievement_id + "' data-dailyachievementid='" + data.daily_achievement.id + "' data-total='" + data.total + "' data-status='" + data.status + "' data-note='" + data.note + "' class='btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-daily' data-toggle='tooltip' data-original-title='Show'>" +
                                        "<i class='icon md-wrench' aria-hidden='true'></i> Show" +
                                    "</a>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' data-date='" + data.daily_achievement.name + "' data-yearlyachievementid='" + data.daily_achievement.yearly_achievement_id + "' data-monthlyachievementid='" + data.daily_achievement.monthly_achievement_id + "' data-dailyachievementid='" + data.daily_achievement.id + "' data-total='" + data.total + "' data-status='" + data.status + "' data-note='" + data.note + "' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-daily' data-toggle='tooltip' data-original-title='Edit'>" +
                                        "<i class='icon md-edit' aria-hidden='true'></i> Edit" +
                                    "</a>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-daily' data-toggle='tooltip' data-original-title='Delete'>" +
                                        "<i class='icon md-delete' aria-hidden='true'></i> Delete" +
                                    "</a>" +
                                "</td>" +
                            "</tr>");
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Pastikan Anda tidak memasukkan data yang sama!', 'Error Alert', {timeOut: 5000});
                }
            });
        }

        function edit_submit() {
            let edit_form_data = new FormData();

            let id = $('#id-edit').val();
            let yearly_achievement_id = $('#edit-yearly').val();
            let monthly_achievement_id = $('#edit-monthly').val();
            let daily_achievement_id = $('#edit-daily-achievement').val();
            let total = $('#edit-total').val();
            let status = $('#edit-status').val();
            let note = $('#edit-note').val();

            console.log('yearly id => ', yearly_achievement_id);
            console.log('monthly id => ', monthly_achievement_id);
            console.log('daily id => ', daily_achievement_id);

            edit_form_data.append('id', id);
            edit_form_data.append('yearly_achievement_id', yearly_achievement_id);
            edit_form_data.append('monthly_achievement_id', monthly_achievement_id);
            edit_form_data.append('daily_achievement_id', daily_achievement_id);
            edit_form_data.append('total', total);
            edit_form_data.append('status', status);
            edit_form_data.append('note', note);
            edit_form_data.append('_method', 'PUT');

            $.ajax({
                type: 'POST',
                url: 'daily-inbound/' + id_edit,
                data: edit_form_data,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    $('.error-edit-daily-achievement').addClass('d-none');
                    $('.error-edit-total').addClass('d-none');
                    $('.error-edit-status').addClass('d-none');
                    $('.error-edit-note').addClass('d-none');

                    if (data.errors) {
                        if (data.errors.daily_achievement_id) {
                            setTimeout(function() {
                                $('#edit-modal').modal('show');
                                toastr.error(data.errors.daily_achievement_id, 'Error Alert', {timeOut: 5000});
                            }, 500);
                            $('.error-edit-daily_achievement_id').removeClass('d-none');
                            $('.error-edit-daily_achievement_id').text(data.errors.name);
                        } else if (data.errors.total) {
                            setTimeout(function() {
                                $('#edit-modal').modal('show');
                                toastr.error(data.errors.total, 'Error Alert', {timeOut: 5000});
                            }, 500);
                            $('.error-edit-total').removeClass('d-none');
                            $('.error-edit-total').text(data.errors.total);
                        } else if (data.errors.status) {
                            setTimeout(function() {
                                $('#edit-modal').modal('show');
                                toastr.error(data.errors.status, 'Error Alert', {timeOut: 5000});
                            }, 500);
                            $('.error-edit-status').removeClass('d-none');
                            $('.error-edit-status').text(data.errors.status);
                        } else if (data.errors.note) {
                            setTimeout(function() {
                                $('#edit-modal').modal('show');
                                toastr.error(data.errors.note, 'Error Alert', {timeOut: 5000});
                            }, 500);
                            $('.error-edit-note').removeClass('d-none');
                            $('.error-edit-note').text(data.errors.note);
                        } else {
                            setTimeout(function() {
                                $('#edit-modal').modal('show');
                                toastr.error(data.errors, 'Error Alert', {timeOut: 5000});
                            }, 500);
                        }
                    } else {
                        toastr.success('Successfully updated Date!', 'Success Alert', {timeOut: 5000});
                        $('#daily-id-' + data.id).replaceWith(
                            "<tr id='daily-id-" + data.id + "'>" +
                                "<td>" + get_date(data.daily_achievement.name) + "</td>" +
                                "<td>" + format_money(parseFloat(data.daily_achievement.target)) + " Ton" + "</td>" +
                                "<td>" + format_money(parseFloat(data.total)) + " Ton" + "</td>" +
                                "<td>" + data.status + "</td>" +
                                "<td>" + data.note + "</td>" +
                                "<td class='actions'>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' data-date='" + data.daily_achievement.name + "' data-yearlyachievementid='" + data.daily_achievement.yearly_achievement_id + "' data-monthlyachievementid='" + data.daily_achievement.monthly_achievement_id + "' data-dailyachievementid='" + data.daily_achievement.id + "' data-total='" + data.total + "' data-status='" + data.status + "' data-note='" + data.note + "' class='btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-daily' data-toggle='tooltip' data-original-title='Show'>" +
                                        "<i class='icon md-wrench' aria-hidden='true'></i> Show" +
                                    "</a>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' data-date='" + data.daily_achievement.name + "' data-yearlyachievementid='" + data.daily_achievement.yearly_achievement_id + "' data-monthlyachievementid='" + data.daily_achievement.monthly_achievement_id + "' data-dailyachievementid='" + data.daily_achievement.id + "' data-total='" + data.total + "' data-status='" + data.status + "' data-note='" + data.note + "' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-daily' data-toggle='tooltip' data-original-title='Edit'>" +
                                        "<i class='icon md-edit' aria-hidden='true'></i> Edit" +
                                    "</a>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-daily' data-toggle='tooltip' data-original-title='Delete'>" +
                                        "<i class='icon md-delete' aria-hidden='true'></i> Delete" +
                                    "</a>" +
                                "</td>" +
                            "</tr>");
                    }
                },
                error: function(xhr, status, error) {
                    setTimeout(function() {
                        $('#edit-modal').modal('show');
                        toastr.error(error, 'Error Alert', {timeOut: 5000});
                    }, 500);
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
                url: '{!! url('admin/daily/monthly/yearly') !!}' + '/' + $(this).val(),
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

                        $('#add-monthly').change(function() {
                            $.ajax({
                                type: 'GET',
                                url: '{!! url('admin/daily/monthly') !!}' + '/' + $(this).val(),
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    if (data.errors) {

                                    } else {
                                        // toastr.success('Successfully loaded Brand!', 'Success Alert', {timeOut: 5000});
                                        $('#add-daily-achievement').replaceWith(
                                            "<select name='daily_achievement_id' id='add-daily-achievement' class='form-control' required=''>" +
                                            "<option value=''>-- Select Daily --</option>");
                                        $.each(data, function(index, value) {
                                            console.log(value);
                                            $('#add-daily-achievement').append(
                                                "<option value='" + value.id + "'>" + value.name + "</option>"
                                            );
                                        });
                                        $('#add-daily-achievement').append("</select>");
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
                url: '{!! url('admin/daily/monthly/yearly') !!}' + '/' + $(this).val(),
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.errors) {

                    } else {
                        $('#edit-monthly').replaceWith(
                            "<select name='monthly_achievement_id' id='edit-monthly' class='form-control'>" +
                                "<option value=''>-- Select Monthly --</option>");
                        $.each(data, function(index, value) {
                            console.log(value);
                            $('#edit-monthly').append(
                                "<option value='" + value.id + "'>" + convert_month(value.name) + "</option>"
                            );
                        });
                        $('#edit-monthly').append("</select>");

                        $('#edit-daily-achievement').replaceWith(
                            "<select name='monthly_achievement_id' id='edit-daily-achievement' class='form-control'>" +
                                "<option value=''>Select Month First</option>" +
                            "</select>"
                        );

                        $('#edit-monthly').change(function() {
                            $.ajax({
                                type: 'GET',
                                url: '{!! url('admin/daily/monthly') !!}' + '/' + $(this).val(),
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    if (data.errors) {

                                    } else {
                                        $('#edit-daily-achievement').replaceWith(
                                            "<select name='monthly_achievement_id' id='edit-daily-achievement' class='form-control'>" +
                                            "<option value=''>-- Select Daily --</option>");
                                        $.each(data, function(index, value) {
                                            console.log(value);
                                            $('#edit-daily-achievement').append(
                                                "<option value='" + value.id + "'>" + value.name + "</option>"
                                            );
                                        });
                                        $('#edit-daily-achievement').append("</select>");
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

        function get_date(date) {
            console.log(date);
            date = new Date(date);
            const month = ['January', 'February', 'March', 'April', 'Mei', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const day = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            return day[date.getDay()] + ', ' + date.getDate() + ' ' + month[date.getMonth()] + ' ' + date.getFullYear();
        }
    </script>
@endsection
