<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Show Loans</h1>
@stop

@section('content')
    <div class="col-md-6"  style="    background: rgba(245, 198, 18, 0.54);">
        <form action="{{route('loan.store')}}" method="POST">
            {{csrf_field()}}

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group ">
                        <label for="title">Account Number:</label>
                        <input type="text" class="form-control" id="productName"  name="account_no" size="10" required readonly value="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label for="title">Collector:</label>
                        <select class="form-control" name="collector_id" required readonly>
                        <option value="">{{$loan->collector->name}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Total Loan:</label>
                        <input type="text" class="form-control" id="total_loan"  name="total_loan" readonly required value="{{$loan->total_loan}}" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <label for="title">Date Loan:</label>
                        <input type="date" class="form-control" id="date_loaned"  name="date_loaned" required readonly value="{{$loan->date_loaned}}">
                        {{--<div class="input-group-addon" style="--}}
                                {{--border-color: #ecf0f5;--}}
                                {{--background-color: #ecf0f5;">--}}
                            {{--<button class="input-group-text btn" type="button" id="setButton">Set</button>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">First Name:</label>
                        <input type="text" class="form-control" id="productName"  name="first_name" placeholder="First Name" required value="{{$loan->customer->first_name}}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Last Name:</label>
                        <input type="text" class="form-control" id="productName"  name="last_name" placeholder="Last Name" required value="{{$loan->customer->last_name}}" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group ">
                <label for="title">Address:</label>
                <input type="text" class="form-control" id="productName"  name="address" size="10" required readonly value="{{$loan->customer->address}}">
            </div>
            <div class="form-group ">
                <label for="title">Mobile Number:</label>
                <input type="text" class="form-control" id="productName"  name="mobile_no" size="10" readonly value="{{$loan->customer->mobile_no}}" >
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Amount Loan:</label>
                        <input type="text" autocomplete="off" class="form-control" id="amount_loaned"  name="amount_loaned" readonly value="{{$loan->amount_loaned}}" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label for="title">Due Date:</label>
                        <input type="date" class="form-control" id="due_date"  name="due_date" readonly value="{{$loan->due_date}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Daily Payment: </label>
                        <input type="text" class="form-control" id="daily_payment"  name="daily_payment" readonly value="{{$loan->daily_payment}}" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Term:</label>
                        <select class="form-control"  name="loan_term" id="loan_term" required readonly>
                            <option >{{$loan->loan_term}}</option>
                        </select>
                    </div>
                </div>
            </div>
            {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@stop

