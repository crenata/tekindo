@extends('admin.template')

@section('title', 'Yearly')

@section('stylesheets')

@endsection

@section('pageheader')
    <div class="page-header">
        <h1 class="page-title">Achievement</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.home') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Yearly</li>
        </ol>
    </div>
@endsection

@section('content')
    <!-- Add -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-modal-title">Add Yearly</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="add-form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('start', 'Start', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        {{ Form::date('start', Carbon\Carbon::now(), array('class' => 'form-control', 'id' => 'add-start', 'required' => '', 'placeholder' => 'Start Date')) }}
                                        <div class="alert alert-danger d-none error-add-start p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('end', 'End', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        {{ Form::date('end', Carbon\Carbon::now(), array('class' => 'form-control', 'id' => 'add-end', 'required' => '', 'placeholder' => 'End Date')) }}
                                        <div class="alert alert-danger d-none error-add-end p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('target', 'Target', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <!-- <div class="input-group-prepend">
                                                <span class="input-group-text bg-info text-white">Rp.</span>
                                            </div> -->
                                            {{ Form::number('target', null, array('class' => 'form-control', 'id' => 'add-target', 'required' => '', 'placeholder' => 'Target')) }}
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-info text-white">Ton</span>
                                            </div>
                                        </div>
                                        <div class="alert alert-danger d-none error-add-target p-2 mt-2"></div>
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
                                    <td style="width: 150px;">Periode</td>
                                    <td style="width: 10px;">:</td>
                                    <td class="show-periode"></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">Start</td>
                                    <td style="width: 10px;">:</td>
                                    <td class="show-start"></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">End</td>
                                    <td style="width: 10px;">:</td>
                                    <td class="show-end"></td>
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
                            {{--<div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('name', 'Name', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'edit-name', 'placeholder' => 'Yearly Name')) }}
                                        <div class="alert alert-danger d-none error-edit-name p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>--}}

                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('start', 'Start', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        {{ Form::date('start', null, array('class' => 'form-control', 'id' => 'edit-start', 'placeholder' => 'Start Date')) }}
                                        <div class="alert alert-danger d-none error-edit-start p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('end', 'End', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        {{ Form::date('end', null, array('class' => 'form-control', 'id' => 'edit-end', 'placeholder' => 'End Date')) }}
                                        <div class="alert alert-danger d-none error-edit-end p-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('target', 'Target', array('class' => 'col-sm-6 col-form-label')) }}
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <!-- <div class="input-group-prepend">
                                                <span class="input-group-text bg-info text-white">Rp.</span>
                                            </div> -->
                                            {{ Form::number('target', null, array('class' => 'form-control', 'id' => 'edit-target', 'placeholder' => 'Target')) }}
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-info text-white">Ton</span>
                                            </div>
                                        </div>
                                        <div class="alert alert-danger d-none error-edit-target p-2 mt-2"></div>
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
                    <h5 class="delete-title text-center font-weight-bold">Are you sure want delete this Year?</h5>
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
                    <h3 class="panel-title">Year List</h3>
                </header>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-15">
                                <a href="javascript:void(0)" class="btn btn-sm btn-success add-yearly">
                                    <i class="icon md-plus" aria-hidden="true"></i> Add
                                </a>
                            </div>
                        </div>
                    </div>

                    @if(count($yearlys) > 0)
                        <div class="table-responsive">
                            <table class="ui table table-bordered table-striped table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Periode</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Target</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="yearlys-crud">
                                    @foreach($yearlys as $yearly)
                                        <tr id="yearly-id-{{ $yearly->id }}">
                                            <td>{{ $yearly->name }}</td>
                                            <td>{{ date('D, j F Y', strtotime($yearly->start)) }}</td>
                                            <td>{{ date('D, j F Y', strtotime($yearly->end)) }}</td>
                                            <td>{{ number_format($yearly->target, 2) }} Ton</td>
                                            <td class="actions">
                                                <a href="javascript:void(0)" data-id="{{ $yearly->id }}" data-name="{{ $yearly->name }}" data-start="{{ $yearly->start }}" data-end="{{ $yearly->end }}" data-target="{{ $yearly->target }}" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-yearly" data-toggle="tooltip" data-original-title="Show">
                                                    <i class="icon md-wrench" aria-hidden="true"></i> Show
                                                </a>
                                                <a href="javascript:void(0)" data-id="{{ $yearly->id }}" data-name="{{ $yearly->name }}" data-start="{{ $yearly->start }}" data-end="{{ $yearly->end }}" data-target="{{ $yearly->target }}" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-yearly" data-toggle="tooltip" data-original-title="Edit">
                                                    <i class="icon md-edit" aria-hidden="true"></i> Edit
                                                </a>
                                                <a href="javascript:void(0)" data-id="{{ $yearly->id }}" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-yearly" data-toggle="tooltip" data-original-title="Delete">
                                                    <i class="icon md-delete" aria-hidden="true"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                    <!-- <h3 class="no-result mt-2">No results found</h3> -->
                        <div class="table-responsive">
                            <table class="ui table table-bordered table-striped table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Periode</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Target</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="yearlys-crud">

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
        $(document).on('click', '.add-yearly', function() {
            $('#add-form').trigger('reset');
            $('.error-add-start').addClass('d-none');
            $('.error-add-end').addClass('d-none');
            $('.error-add-target').addClass('d-none');
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
        $(document).on('click', '.show-yearly', function() {
            $('.show-periode').text($(this).data('name'));
            $('.show-start').text(get_date($(this).data('start')));
            $('.show-end').text(get_date($(this).data('end')));
            $('.show-target').text(format_money($(this).data('target')) + ' Ton');
            $('#show-modal').modal('show');
        });

        /* Edit */
        $(document).on('click', '.edit-yearly', function() {
            $('#id-edit').val($(this).data('id'));
            $('#edit-start').val($(this).data('start'));
            $('#edit-end').val($(this).data('end'));
            console.log($('#edit-start').val());
            console.log($('#edit-end').val());
            $('#edit-target').val($(this).data('target'));

            $('.error-edit-start').addClass('d-none');
            $('.error-edit-end').addClass('d-none');
            $('.error-edit-target').addClass('d-none');
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
        $(document).on('click', '.delete-yearly', function() {
            $('#delete-modal').modal('show');
            id = $(this).data('id');
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'yearly/' + id,
                success: function(data) {
                    toastr.success('Successfully deleted Year!', 'Success Alert', {timeOut: 5000});
                    $('#yearly-id-' + id).remove();
                }
            });
        });

        function add_submit() {
            let add_form_data = new FormData();

            let start = $('#add-start').val();
            let end = $('#add-end').val();
            let target = $('#add-target').val();

            add_form_data.append('start', start);
            add_form_data.append('end', end);
            add_form_data.append('target', target);

            if (start == null || start == undefined || start == '' || end == null || end == undefined || end == '') {
                toastr.error('Mungkin Anda salah tanggal, Harap periksa kembali!', 'Error Alert', {timeOut: 5000});
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'yearly',
                    data: add_form_data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('.error-add-start').addClass('d-none');
                        $('.error-add-end').addClass('d-none');
                        $('.error-add-target').addClass('d-none');

                        if (data.errors) {
                            if (data.errors.start) {
                                setTimeout(function() {
                                    $('#add-modal').modal('show');
                                    toastr.error(data.errors.start, 'Error Alert', {timeOut: 5000});
                                }, 500);
                                $('.error-add-start').removeClass('d-none');
                                $('.error-add-start').text(data.errors.start);
                            } else if (data.errors.end) {
                                setTimeout(function() {
                                    $('#add-modal').modal('show');
                                    toastr.error(data.errors.end, 'Error Alert', {timeOut: 5000});
                                }, 500);
                                $('.error-add-end').removeClass('d-none');
                                $('.error-add-end').text(data.errors.end);
                            } else if (data.errors.target) {
                                setTimeout(function() {
                                    $('#add-modal').modal('show');
                                    toastr.error(data.errors.target, 'Error Alert', {timeOut: 5000});
                                }, 500);
                                $('.error-add-target').removeClass('d-none');
                                $('.error-add-target').text(data.errors.target);
                            } else {
                                setTimeout(function() {
                                    $('#add-modal').modal('show');
                                    toastr.error(data.errors, 'Error Alert', {timeOut: 5000});
                                }, 500);
                            }
                        } else {
                            toastr.success('Successfully added Year!', 'Success Alert', {timeOut: 5000});
                            $('#datatable').append(
                                "<tr id='yearly-id-" + data.id + "'>" +
                                "<td>" + data.name + "</td>" +
                                "<td>" + get_date(data.start) + "</td>" +
                                "<td>" + get_date(data.end) + "</td>" +
                                "<td>" + format_money(parseFloat(data.target)) + " Ton" + "</td>" +
                                "<td class='actions'>" +
                                "<a href='javascript:void(0)' data-id='" + data.id + "' data-name='" + data.name + "' data-start='" + data.start + "' data-end='" + data.end + "' data-target='" + data.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-yearly' data-toggle='tooltip' data-original-title='Show'>" +
                                "<i class='icon md-wrench' aria-hidden='true'></i> Show" +
                                "</a>" +
                                "<a href='javascript:void(0)' data-id='" + data.id + "' data-name='" + data.name + "' data-start='" + data.start + "' data-end='" + data.end + "' data-target='" + data.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-yearly' data-toggle='tooltip' data-original-title='Edit'>" +
                                "<i class='icon md-edit' aria-hidden='true'></i> Edit" +
                                "</a>" +
                                "<a href='javascript:void(0)' data-id='" + data.id + "' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-yearly' data-toggle='tooltip' data-original-title='Delete'>" +
                                "<i class='icon md-delete' aria-hidden='true'></i> Delete" +
                                "</a>" +
                                "</td>" +
                                "</tr>");
                        }
                    },
                    error: function(data) {
                        toastr.error(data.errors, 'Error Alert', {timeOut: 5000});
                    }
                });
            }
        }

        function edit_submit() {
            let edit_form_data = new FormData();

            let id = $('#id-edit').val();
            let start = $('#edit-start').val();
            let end = $('#edit-end').val();
            let target = $('#edit-target').val();

            edit_form_data.append('id', id);
            edit_form_data.append('start', start);
            edit_form_data.append('end', end);
            edit_form_data.append('target', target);
            edit_form_data.append('_method', 'PUT');

            if (start == null || start == undefined || start == '' || end == null || end == undefined || end == '') {
                toastr.error('Mungkin Anda salah tanggal, Harap periksa kembali!', 'Error Alert', {timeOut: 5000});
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'yearly/' + id_edit,
                    data: edit_form_data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('.error-edit-start').addClass('d-none');
                        $('.error-edit-end').addClass('d-none');
                        $('.error-edit-target').addClass('d-none');

                        if (data.errors) {
                            if (data.errors.start) {
                                setTimeout(function() {
                                    $('#edit-modal').modal('show');
                                    toastr.error(data.errors.start, 'Error Alert', {timeOut: 5000});
                                }, 500);
                                $('.error-edit-start').removeClass('d-none');
                                $('.error-edit-start').text(data.errors.start);
                            } else if (data.errors.end) {
                                setTimeout(function() {
                                    $('#edit-modal').modal('show');
                                    toastr.error(data.errors.end, 'Error Alert', {timeOut: 5000});
                                }, 500);
                                $('.error-edit-end').removeClass('d-none');
                                $('.error-edit-end').text(data.errors.end);
                            } else if (data.errors.target) {
                                setTimeout(function() {
                                    $('#edit-modal').modal('show');
                                    toastr.error(data.errors.target, 'Error Alert', {timeOut: 5000});
                                }, 500);
                                $('.error-edit-target').removeClass('d-none');
                                $('.error-edit-target').text(data.errors.target);
                            } else {
                                setTimeout(function() {
                                    $('#edit-modal').modal('show');
                                    toastr.error(data.errors, 'Error Alert', {timeOut: 5000});
                                }, 500);
                            }
                        } else {
                            toastr.success('Successfully updated Year!', 'Success Alert', {timeOut: 5000});
                            $('#yearly-id-' + data.id).replaceWith(
                                "<tr id='yearly-id-" + data.id + "'>" +
                                "<td>" + data.name + "</td>" +
                                "<td>" + get_date(data.start) + "</td>" +
                                "<td>" + get_date(data.end) + "</td>" +
                                "<td>" + format_money(parseFloat(data.target)) + " Ton" + "</td>" +
                                "<td class='actions'>" +
                                "<a href='javascript:void(0)' data-id='" + data.id + "' data-name='" + data.name + "' data-start='" + data.start + "' data-end='" + data.end + "' data-target='" + data.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-editing save-row show-yearly' data-toggle='tooltip' data-original-title='Show'>" +
                                "<i class='icon md-wrench' aria-hidden='true'></i> Show" +
                                "</a>" +
                                "<a href='javascript:void(0)' data-id='" + data.id + "' data-name='" + data.name + "' data-start='" + data.start + "' data-end='" + data.end + "' data-target='" + data.target + "' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row edit-yearly' data-toggle='tooltip' data-original-title='Edit'>" +
                                "<i class='icon md-edit' aria-hidden='true'></i> Edit" +
                                "</a>" +
                                "<a href='javascript:void(0)' data-id='" + data.id + "' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row delete-yearly' data-toggle='tooltip' data-original-title='Delete'>" +
                                "<i class='icon md-delete' aria-hidden='true'></i> Delete" +
                                "</a>" +
                                "</td>" +
                                "</tr>");
                        }
                    },
                    error: function(data) {
                        toastr.error(data.errors, 'Error Alert', {timeOut: 5000});
                    }
                });
            }
        }

        function get_date(date) {
            console.log(date);
            date = new Date(date);
            const month = ['January', 'February', 'March', 'April', 'Mei', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const day = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            return day[date.getDay()] + ', ' + date.getDate() + ' ' + month[date.getMonth()] + ' ' + date.getFullYear();
        }

        function convert_month(month) {
            if (month == 1) return 'January';
            else if (month == 2) return 'February';
            else if (month == 3) return 'March';
            else if (month == 4) return 'April';
            else if (month == 5) return 'Mei';
            else if (month == 6) return 'June';
            else if (month == 7) return 'July';
            else if (month == 8) return 'August';
            else if (month == 9) return 'September';
            else if (month == 10) return 'October';
            else if (month == 11) return 'November';
            else if (month == 12) return 'December';
            else return 'Undefined Month';
        }

        function format_money(n) {
            return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,').replace('.00', '');
        }
    </script>
@endsection
