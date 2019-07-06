
<!-- Bootstrap CSS -->

{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create Loan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('loan.store')}}" method="POST">
                {{csrf_field()}}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="title">Account Number:</label>
                            <input type="text" class="form-control" id="productName"  name="account_no" size="10">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="title">Collector:</label>
                            <select class="form-control" name="">
                                <option>Collector 1</option>
                                <option>Collector 2</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Total Loan:</label>
                            <input type="text" class="form-control" id="total_loan"  name="total_loan" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <label for="title">Date Loan:</label>
                            <input type="text" class="form-control" id="date_loaned"  name="date_loaned">
                            <div class="input-group-addon">
                                <button class="input-group-text btn" type="button">Button</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">First Name:</label>
                            <input type="text" class="form-control" id="productName"  name="client_first_name" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Last Name:</label>
                            <input type="text" class="form-control" id="productName"  name="client_last_name" placeholder="Last Name">
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="title">Address:</label>
                    <input type="text" class="form-control" id="productName"  name="client_address" size="10">
                </div>
                <div class="form-group ">
                    <label for="title">Mobile Number:</label>
                    <input type="text" class="form-control" id="productName"  name="mobile_no" size="10">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Amount Loan:</label>
                            <input type="text" autocomplete="off" class="form-control" id="amount_loaned"  name="amount_loaned">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="title">Due Date:</label>
                            <input type="date" class="form-control" id="due_date"  name="due_date" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Daily Payment: </label>
                            <input type="text" class="form-control" id="daily_payment"  name="daily_payment">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="title">Term:</label>
                            <select class="form-control" name="loan_term">
                                <option >52 Days (2 Months)</option>
                                <option>26 Days (1 Month)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-6">
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        jQuery.each(data, function(index, value) {
            $("#table_div").append("<tr><td>" + value + "</td></tr>");
        });
    </script>
    <script>
        var total_loan = document.getElementById('total_loan');
        total_loan.value = 0.00;
        var amount_loaned = document.getElementById('amount_loaned');
        amount_loaned.value = 0.00;
        var daily_payment = document.getElementById('daily_payment');
        daily_payment.value = 0.00;

        amount_loaned.addEventListener('input',function() {
           total_loan.value = (this.value * 1.2);
           daily_payment.value = Math.ceil(this.value * 1.2 / 52);
        });
    </script>
    <script>
        var date_loaned = document.getElementById('date_loaned');
        var due_date = document.getElementById('due_date');

        date_loaned.addEventListener('input',function () {
            var result = new Date(date_loaned);

        })
    </script>
@stop


