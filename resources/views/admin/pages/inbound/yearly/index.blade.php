@extends('admin.template')

@section('title', 'Yearly')

@section('stylesheets')

@endsection

@section('pageheader')
    <div class="page-header">
        <h1 class="page-title">Inbound</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.home') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Yearly</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <header class="panel-heading">
                    <h3 class="panel-title">Year List</h3>
                </header>

                <div class="panel-body">
                    @if(count($yearlys) > 0)
                        <div class="table-responsive">
                            <table class="ui table table-bordered table-striped table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Periode</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Target</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="yearlys-crud">
                                    @foreach($yearlys as $yearly)
                                        <tr id="yearly-id-{{ $yearly->id }}">
                                            <td>{{ $yearly->name }}</td>
                                            <td>{{ date('D, j F Y', strtotime($yearly->yearly_achievement->start)) }}</td>
                                            <td>{{ date('D, j F Y', strtotime($yearly->yearly_achievement->end)) }}</td>
                                            <td>{{ number_format($yearly->yearly_achievement->target) }} Ton</td>
                                            <td>{{ $yearly->total }} Ton</td>
                                            <td>{{ $yearly->status }}</td>
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
                                        <th>Total</th>
                                        <th>Status</th>
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

        function get_date(date) {
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