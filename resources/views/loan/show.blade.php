<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1>Show Loans <span class="h3" style="color: green;float: right;">Today is {{date('Y-m-d')}}</span></h1>
        </div>
        <div class="col-md-6 text-right">
            {{ $payments->render() }}
        </div>
    </div>
@stop

@section('content')
    @include('loan._modal_reloan')
    <div class="row" style="background-color: white;">
        <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="title">ID Number:</label>
                                    <input type="text" class="form-control" id="productName"  name="account_no" size="10" required readonly value="{{$loan->id}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="title">Status</label>
                                    @if($loan->is_paid == 1)
                                    <input type="text" class="form-control" id="productName"  name="account_no" size="10" required readonly value="Paid" style="color: green">
                                    @else
                                    <input type="text" class="form-control" id="productName"  name="account_no" size="10" required readonly value="Not Paid" style="color: red">
                                    @endif
                                </div>
                            </div>
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title">Balance:</label>
                            <input type="text" class="form-control" id="total_loan"  name="total_loan" readonly required value="{{$loan->balance}}" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title">Total Loan:</label>
                            <input type="text" class="form-control" id="total_loan"  name="total_loan" readonly required value="{{$loan->total_loan}}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="title">Date Loan:</label>
                        <input type="date" class="form-control" id="date_loaned"  name="date_loaned" required readonly value="{{$loan->date_loaned}}">
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
                <div class="row">
                    {{\Carbon\Carbon::parse(\Carbon\Carbon::now())->diffInDays($loan->due_date, false)}}
                    @if((\Carbon\Carbon::parse(\Carbon\Carbon::now())->diffInDays($loan->due_date, false)) > 7 && $loan->is_paid == 0)
                    <a href="" data-toggle="modal" data-target="#reloan-{{$loan->id}}"><button class="btn btn-danger"><i class="fa fa-fw fa-times"></i></button></a>
                    @endif
                </div>
        </div>

        <div class="col-md-6" >
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
            <table class="table table-striped">
                <tr>
                    <th>Date</th>
                    <th>Check</th>
                    <th>Daily Payment</th>
                </tr>
                @foreach($payments as $payment)
                    <input type="hidden" id="loan_id" value="{{ $payment->loan_id}}">
                    @if($payment->date === date('Y-m-d'))
                    <tr id="payment_{{$payment->id}}" class="" style="background-color:#FFEEBA">
                    @else
                    <tr id="payment_{{$payment->id}}">
                    @endif
                        <td>{{date('m/d',strtotime($payment->date))}}</td>
                        <td>
                            @if($payment->status == 0 && $payment->if_sunday != 1)
                            <button class="paid_button btn btn-primary" name="paid_name" id="paid_button_{{$payment->id}}" value="{{$payment->id}}">Paid</button>
                            @else
                            <button class="paid_button btn btn-success" name="paid_name" value="{{$payment->id}}" disabled>Paid</button>
                            @endif
                        </td>
                        <td>
                            <input class="form-control" type="text" id="payment_value_{{$payment->id}}" value="{{$payment->loan->daily_payment == $payment->payment_amount ? $payment->payment_amount : $payment->payment_amount  }}" style="border: 0px solid #ECF0F5; background-color: #ECF0F5;"></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
       input{
           border-color: #ECF0F5;
           background-color: #ECF0F5;
       }
    </style>
@stop

@section('js')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();

            $(".paid_button").click(function () {
                var value = this.value;
                var daily_payment = $('#daily_payment').val();
                var payment_id = $('#payment_id').val();
                var payment_amount = $('#payment_value_'+value).val();
                var total_loan = $('#total_loan')[0];
                var CSRF_TOKEN = $('#_token').val();
                var loan_id = $('#loan_id').val();

                $.ajax({
                    url: '/getLoan/' + loan_id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        var balance = response['data'][0].balance;
                        total_loan.value = balance;
                    }
                });

                $.ajax({
                    url:'/updatePayment',
                    type: 'POST',
                    data: {
                        _token : CSRF_TOKEN,
                        id : this.value,
                        daily_payment: payment_amount,
                        payment_id : payment_id,

                    },
                    success: function () {
                        $("#payment_" + value).attr("class","table-primary");
                        $("#payment_" + value).attr("style","background-color:#C3E6CB");
                        $("#paid_button_" + value).prop("disabled",true);
                        total_loan.value -= payment_amount;
                    }
                });
            });
        } );

    </script>
@stop

