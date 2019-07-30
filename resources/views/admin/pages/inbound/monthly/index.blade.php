@extends('admin.template')

@section('title', 'Monthly')

@section('stylesheets')
    
@endsection

@section('pageheader')
    <div class="page-header">
        <h1 class="page-title">Achievement</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.home') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Monthly</li>
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
                    <h5 class="modal-title" id="add-modal-title">Add Monthly</h5>
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
                                    {{ Form::label('name', 'Name', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        {{--{{ Form::text('name', null, array('class' => 'form-control', 'id' => 'add-name', 'required' => '', 'placeholder' => 'Month Name')) }}--}}
                                        <select name="name" id="add-name" class="form-control">
                                            <option>-- Select Month --</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
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
                                    {{ Form::label('name', 'Name', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        {{--{{ Form::text('name', null, array('class' => 'form-control', 'id' => 'edit-name', 'placeholder' => 'Monthly Name')) }}--}}
                                        <select name="name" id="edit-name" class="form-control">
                                            <option>-- Select Month --</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
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
                    <h5 class="delete-title text-center font-weight-bold">Are you sure want delete this Month?</h5>
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
                                            <option>-- Select Periode --</option>
                                            @foreach($yearlys as $yearly)
                                                <option value="{{ $yearly->id }}">{{ $yearly->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-right">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-success btn-generate">
                                                <i class="icon md-plus" aria-hidden="true"></i> Generate
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 mt-30">
                                <div id="monthly-generate">
                                    
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
                    <h3 class="panel-title">Month List</h3>
                </header>

                <div class="panel-body">
                    <div class="row">
                        {{--<div class="col-md-6">
                            <div class="mb-15">
                                <a href="javascript:void(0)" class="btn btn-sm btn-success add-monthly">
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

                        <div class="col-md-3"></div>

                        <div class="col-md-6">
                            <div class="mb-15 text-right">
                                <a href="javascript:void(0)" class="btn btn-sm btn-success add-auto-generate" data-toggle="modal" data-target="#auto-generate-modal">
                                    <i class="icon md-plus" aria-hidden="true"></i> Auto Generate
                                </a>
                            </div>
                        </div>
                    </div>

                    @if(count($monthlys) > 0)
                        <div class="table-responsive">
                            <table class="ui table table-bordered table-striped table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Year</th>
                                        <th>Target</th>
                                        {{--<th>Action</th>--}}
                                    </tr>
                                </thead>
                                <tbody id="monthlys-crud">
                                    {{--@foreach($monthlys as $monthly)
                                        <tr id="monthly-id-{{ $monthly->id }}">
                                            <td>{{ convert_month($monthly->name) }}</td>
                                            <td>{{ $monthly->yearly_achievement->name }}</td>
                                            <td>{{ number_format($monthly->target) }} Ton</td>
                                            <td class="actions">
                                                <a href="javascript:void(0)" data-id="{{ $monthly->id }}" data-name="{{ $monthly->name }}" data-yearly="{{ $monthly->yearly_achievement->name }}" data-target="{{ $monthly->target }}" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-monthly" data-toggle="tooltip" data-original-title="Show">
                                                    <i class="icon md-wrench" aria-hidden="true"></i> Show
                                                </a>
                                                <a href="javascript:void(0)" data-id="{{ $monthly->id }}" data-name="{{ $monthly->name }}" data-yearly="{{ $monthly->yearly_achievement->id }}" data-target="{{ $monthly->target }}" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-monthly" data-toggle="tooltip" data-original-title="Edit">
                                                    <i class="icon md-edit" aria-hidden="true"></i> Edit
                                                </a>
                                                <a href="javascript:void(0)" data-id="{{ $monthly->id }}" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-monthly" data-toggle="tooltip" data-original-title="Delete">
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
                                        <th>Name</th>
                                        <th>Year</th>
                                        <th>Target</th>
                                        {{--<th>Action</th>--}}
                                    </tr>
                                </thead>
                                <tbody id="monthlys-crud">

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
        $(document).on('click', '.add-monthly', function() {
            $('#add-form').trigger('reset');
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
        $(document).on('click', '.show-monthly', function() {
            $('.show-name').text(convert_month($(this).data('name')));
            $('.show-yearly').text($(this).data('yearly'));
            $('.show-target').text(($(this).data('target')) ? format_money($(this).data('target')) : '0' + ' Ton');
            $('#show-modal').modal('show');
        });

        /* Edit */
        $(document).on('click', '.edit-monthly', function() {
            $('#id-edit').val($(this).data('id'));
            $('#edit-name').val($(this).data('name'));
            $('#edit-yearly').val($(this).data('yearly'));
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
        $(document).on('click', '.delete-monthly', function() {
            $('#delete-modal').modal('show');
            id = $(this).data('id');
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'monthly/' + id,
                success: function(data) {
                    toastr.success('Successfully deleted Month!', 'Success Alert', {timeOut: 5000});
                    $('#monthly-id-' + id).remove();
                }
            });
        });

        function add_submit() {
            let add_form_data = new FormData();

            let name = $('#add-name').val();
            let yearly_achievement_id = $('#add-yearly').val();

            add_form_data.append('name', name);
            add_form_data.append('yearly_achievement_id', yearly_achievement_id);

            $.ajax({
                type: 'POST',
                url: 'monthly',
                data: add_form_data,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    $('.error-add-name').addClass('d-none');
                    $('.error-add-yearly').addClass('d-none');
                    
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
                        }*/
                    } else {
                        toastr.success('Successfully added Month!', 'Success Alert', {timeOut: 5000});
                        $('#datatable').append(
                            "<tr id='monthly-id-" + data.id + "'>" +
                                "<td>" + convert_month(data.name) + "</td>" +
                                "<td>" + data.yearly_achievement.name + "</td>" +
                                "<td>" + ((value.target) ? format_money(parseFloat(value.target)) : '0') + " Ton" + "</td>" +
                                /*"<td class='actions'>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' data-name='" + data.name + "' data-yearly='" + data.yearly_achievement.name + "' data-target='" + data.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-monthly' data-toggle='tooltip' data-original-title='Show'>" +
                                        "<i class='icon md-wrench' aria-hidden='true'></i> Show" +
                                    "</a>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' data-name='" + data.name + "' data-yearly='" + data.yearly_achievement.id + "' data-target='" + data.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-monthly' data-toggle='tooltip' data-original-title='Edit'>" +
                                        "<i class='icon md-edit' aria-hidden='true'></i> Edit" +
                                    "</a>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-monthly' data-toggle='tooltip' data-original-title='Delete'>" +
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

            edit_form_data.append('id', id);
            edit_form_data.append('name', name);
            edit_form_data.append('yearly_achievement_id', yearly_achievement_id);
            edit_form_data.append('_method', 'PUT');

            $.ajax({
                type: 'POST',
                url: 'monthly/' + id_edit,
                data: edit_form_data,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    $('.error-edit-name').addClass('d-none');
                    $('.error-edit-yearly').addClass('d-none');
                    
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
                        }*/
                    } else {
                        toastr.success('Successfully updated Month!', 'Success Alert', {timeOut: 5000});
                        $('#monthly-id-' + data.id).replaceWith(
                            "<tr id='monthly-id-" + data.id + "'>" +
                                "<td>" + convert_month(data.name) + "</td>" +
                                "<td>" + data.yearly_achievement.name + "</td>" +
                                "<td>" + ((data.target) ? format_money(parseFloat(data.target)) : '0') + " Ton" + "</td>" +
                                /*"<td class='actions'>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' data-name='" + data.name + "' data-yearly='" + data.yearly_achievement.name + "' data-target='" + data.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-monthly' data-toggle='tooltip' data-original-title='Show'>" +
                                        "<i class='icon md-wrench' aria-hidden='true'></i> Show" +
                                    "</a>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' data-name='" + data.name + "' data-yearly='" + data.yearly_achievement.id + "' data-target='" + data.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-monthly' data-toggle='tooltip' data-original-title='Edit'>" +
                                        "<i class='icon md-edit' aria-hidden='true'></i> Edit" +
                                    "</a>" +
                                    "<a href='javascript:void(0)' data-id='" + data.id + "' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-monthly' data-toggle='tooltip' data-original-title='Delete'>" +
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

        function format_money(n) {
            return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,').replace('.00', '');
        }

        $('#auto-generate-yearly').change(function() {
            let auto_generate_yearly = $(this).val();
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
                        $('#monthly-generate').replaceWith(
                            "<div id='monthly-generate'>" +
                                "<div class='row'>"
                        );
                        $.each(data, function(index, value) {
                            console.log(value);
                            $('#monthly-generate').append(
                                "<div class='col-md-12'>" +
                                    "<div class='form-group row'>" +
                                        "<label for='' class='col-sm-6 col-form-label'>" + convert_month(value.name) + '&ensp;' + /*get_year_value(value.yearly_achievement.start, value.yearly_achievement.end, value.name)*/ value.year_name + "</label>" +
                                        "<div class='col-sm-6'>" +
                                            "<input class='form-control generate-result' placeholder='Target' name='monthly" + value.id + "' type='text' value='" + ((value.target) ? value.target : '') + "' disabled>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>"
                            );
                        });
                        $('#monthly-generate').append(
                                "</div>" +
                            "</div>"
                        );

                        $(document).on('click', '.btn-generate', function() {
                            if (auto_generate_yearly != undefined || auto_generate_yearly != 0 || auto_generate_yearly != null) {
                                $.ajax({
                                    type: 'GET',
                                    url: 'generate/yearly/' + auto_generate_yearly,
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

                                                save_target.append('yearly_id', auto_generate_yearly);
                                                save_target.append('target', data);

                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'monthly/save/generate/target',
                                                    data: save_target,
                                                    dataType: 'json',
                                                    processData: false,
                                                    contentType: false,
                                                    success: function(data) {
                                                        if (data.errors) {
                                                            
                                                        } else {
                                                            console.log(data);
                                                            $.each(data, function(index, value) {
                                                                console.log(value);
                                                                $('#monthly-id-' + value.id).replaceWith(
                                                                    "<tr id='monthly-id-" + value.id + "'>" +
                                                                        "<td>" + convert_month(value.name) + "</td>" +
                                                                        "<td>" + value.yearly_achievement.name + "</td>" +
                                                                        "<td>" + ((value.target) ? format_money(parseFloat(value.target)) : '0') + " Ton" + "</td>" +
                                                                        /*"<td class='actions'>" +
                                                                            "<a href='javascript:void(0)' data-id='" + value.id + "' data-name='" + value.name + "' data-yearly='" + value.yearly_achievement.name + "' data-target='" + value.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-monthly' data-toggle='tooltip' data-original-title='Show'>" +
                                                                                "<i class='icon md-wrench' aria-hidden='true'></i> Show" +
                                                                            "</a>" +
                                                                            "<a href='javascript:void(0)' data-id='" + value.id + "' data-name='" + value.name + "' data-yearly='" + value.yearly_achievement.id + "' data-target='" + value.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-monthly' data-toggle='tooltip' data-original-title='Edit'>" +
                                                                                "<i class='icon md-edit' aria-hidden='true'></i> Edit" +
                                                                            "</a>" +
                                                                            "<a href='javascript:void(0)' data-id='" + value.id + "' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-monthly' data-toggle='tooltip' data-original-title='Delete'>" +
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

        $('#datatable-yearly').change(function() {
            $.ajax({
                type: 'GET',
                url: 'yearly/' + $(this).val(),
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data.monthly_achievements);
                    if (data.errors) {

                    } else {
                        // toastr.success('Successfully loaded Brand!', 'Success Alert', {timeOut: 5000});
                        $('#monthlys-crud').replaceWith("<tbody id='monthlys-crud'>");
                        $.each(data.monthly_achievements, function(index, value) {
                            console.log(value);
                            $('#datatable').append(
                                "<tr id='monthly-id-" + value.id + "'>" +
                                    "<td>" + convert_month(value.name) + "</td>" +
                                    "<td>" + /*get_year_value(data.start, data.end, value.name)*/ value.year_name + "</td>" +
                                    "<td>" + ((value.target) ? format_money(parseFloat(value.target)) : '0') + " Ton" + "</td>" +
                                    /*"<td class='actions'>" +
                                        "<a href='javascript:void(0)' data-id='" + value.id + "' data-name='" + value.name + "' data-yearly='" + value.yearly_achievement.name + "' data-target='" + value.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-monthly' data-toggle='tooltip' data-original-title='Show'>" +
                                            "<i class='icon md-wrench' aria-hidden='true'></i> Show" +
                                        "</a>" +
                                        "<a href='javascript:void(0)' data-id='" + value.id + "' data-name='" + value.name + "' data-yearly='" + value.yearly_achievement.id + "' data-target='" + value.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-monthly' data-toggle='tooltip' data-original-title='Edit'>" +
                                            "<i class='icon md-edit' aria-hidden='true'></i> Edit" +
                                        "</a>" +
                                        "<a href='javascript:void(0)' data-id='" + value.id + "' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-monthly' data-toggle='tooltip' data-original-title='Delete'>" +
                                            "<i class='icon md-delete' aria-hidden='true'></i> Delete" +
                                        "</a>" +
                                    "</td>" +*/
                                "</tr>");
                        });
                        $('#monthlys-crud').append("</tbody>");
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