
{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Show All Loans</h1>
@stop

@section('content')
    @include('loan._modal')
    @include('loan._modal2')

    <ul class="nav nav-pills">
        <li class="active"><a href="#not_paid">Not Paid</a></li>
        <li><a href="#paid">Paid</a></li>
        <li><a href="#overdue">Overdue</a></li>
    </ul>

    <div class="tab-content">
        <div id="not_paid" class="tab-pane fade in active" style="background-color: white;">
            <table id="myTable" class="display" style="font-size: 13px;">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>LTerm</th>
                    <th>LStart</th>
                    <th>LDue</th>
                    <th>Collector</th>
                    <th>Perday</th>
                    <th>Total Balance</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody style="text-align: center;">
                @foreach($not_paid_loans as $loan)
                    @if($loan->due_date <= date('Y-m-d'))
                        <tr style="background-color: #F5C6CB;">
                    @else
                        <tr>
                            @endif
                            <td>{{$loan->id}}</td>
                            <td>{{$loan->customer->last_name}}, {{$loan->customer->first_name}}</td>
                            <td>{{$loan->amount_loaned}}</td>
                            <td>{{$loan->loan_term}}</td>
                            <td>{{$loan->date_loaned}}</td>
                            <td>{{$loan->due_date}}</td>
                            <td>{{$loan->collector->name}}</td>
                            <td>{{$loan->daily_payment}}</td>
                            <td><span class="label label-default" style="font-size: 12px;"><span>{{$loan->balance}}</span></span></td>
                            <td>
                                <a href="loan\{{$loan->id}}" ><button class="btn btn-success"><i class="fa fa-fw fa-eye"></i></button></a>
                                {{--<a href="" data-toggle="modal" data-target="#edit-{{$loan->id}}"><button class="btn btn-primary"><i class="fa fa-fw fa-edit"></i></button></a>--}}
                                <a href="" data-toggle="modal" data-target="#delete-{{$loan->id}}"><button class="btn btn-danger"><i class="fa fa-fw fa-times"></i></button></a>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        <div id="paid" class="tab-pane fade" style="background-color: white;">
            <table id="myTable2" class="display" style="font-size: 13px;">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>LTerm</th>
                    <th>LStart</th>
                    <th>LDue</th>
                    <th>Collector</th>
                    <th>Perday</th>
                    <th>Total Balance</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody style="text-align: center;">
                @foreach($paid_loans as $loan)
                    @if($loan->due_date <= date('Y-m-d'))
                    @else
                        <tr>
                            @endif
                            <td>{{$loan->id}}</td>
                            <td>{{$loan->customer->last_name}}, {{$loan->customer->first_name}}</td>
                            <td>{{$loan->amount_loaned}}</td>
                            <td>{{$loan->loan_term}}</td>
                            <td>{{$loan->date_loaned}}</td>
                            <td>{{$loan->due_date}}</td>
                            <td>{{$loan->collector->name}}</td>
                            <td>{{$loan->daily_payment}}</td>
                            <td><span class="label label-default" style="font-size: 12px;"><span>{{$loan->balance}}</span></span></td>
                            <td>
                                <a href="loan\{{$loan->id}}" ><button class="btn btn-success"><i class="fa fa-fw fa-eye"></i></button></a>
                                {{--<a href="" data-toggle="modal" data-target="#edit2-{{$loan->id}}"><button class="btn btn-primary"><i class="fa fa-fw fa-edit"></i></button></a>--}}
                                <a href="" data-toggle="modal" data-target="#delete2-{{$loan->id}}"><button class="btn btn-danger"><i class="fa fa-fw fa-times"></i></button></a>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        <div id="overdue" class="tab-pane fade" style="background-color: white;">
            <table id="myTable3" class="display" style="font-size: 13px;">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>LTerm</th>
                    <th>LDue</th>
                    <th>Collector</th>
                    <th>Perday</th>
                    <th>Total Balance</th>
                    <th>Expiry</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody style="text-align: center;">
                @foreach($overdue_loans as $loan)
                    @if($loan->due_date <= date('Y-m-d'))
                    @else
                        <tr>
                            @endif
                            <td>{{$loan->id}}</td>
                            <td>{{$loan->customer->last_name}}, {{$loan->customer->first_name}}</td>
                            <td>{{$loan->amount_loaned}}</td>
                            <td>{{$loan->loan_term}}</td>
                            <td>{{$loan->due_date}}</td>
                            <td>{{$loan->collector->name}}</td>
                            <td>{{$loan->daily_payment}}</td>
                            <td><span class="label label-default" style="font-size: 12px;"><span>{{$loan->balance}}</span></span></td>
                            <td>{{\Carbon\Carbon::parse(\Carbon\Carbon::now())->diffInDays($loan->due_date)}} Days</td>
                            <td>
                                <a href="loan\{{$loan->id}}" ><button class="btn btn-success"><i class="fa fa-fw fa-eye"></i></button></a>
                                {{--<a href="" data-toggle="modal" data-target="#edit2-{{$loan->id}}"><button class="btn btn-primary"><i class="fa fa-fw fa-edit"></i></button></a>--}}
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
@stop

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );

        $(document).ready( function () {
            $('#myTable2').DataTable();
        } );

        $(document).ready( function () {
            $('#myTable3').DataTable();
        } );

        $(document).ready(function(){
            $(".nav-pills a").click(function(){
                $(this).tab('show');
            });
        });
    </script>
@stop

