
<!-- Bootstrap CSS -->

{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create Loan</h1>
@stop

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @elseif(session()->has('warning'))
        <div class="alert alert-warning">
            {{ session()->get('warning')}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="background-color: white; padding: 15px;">
            <form action="{{route('loan.store')}}" method="POST">
                {{csrf_field()}}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="title">Account Number:</label>
                            <input type="text" class="form-control" id="productName"  name="account_no" size="10" required readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="title">Collector:<span class="required">*</span></label>
                            <select class="form-control" name="collector_id" required >
                                <option value="" selected>--Choose Collector--</option>
                                @foreach($collectors as $collector)
                                <option value="{{$collector->id}}">{{$collector->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Total Loan:<span class="required">*</span></label>
                            <input type="text" class="form-control" id="total_loan"  name="total_loan" readonly required>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <label for="title">Date Loan:<span class="required">*</span></label>
                            <div class="input-group" style="
                                border-color: #ecf0f5;
                                background-color: white;
                                border: 0px;
                                padding: 0px;">
                                <input type="date" class="form-control" id="date_loaned"  name="date_loaned" required>
                                <span class="input-group-addon" style="padding: 0px;border: 0px;"><button class="input-group-text btn btn-primary" type="button" id="setButton">Set</button></span>
                            </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">First Name:<span class="required">*</span></label>
                            <input type="text" class="form-control" id="productName"  name="first_name" placeholder="First Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Last Name:<span class="required">*</span></label>
                            <input type="text" class="form-control" id="productName"  name="last_name" placeholder="Last Name" required>
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="title">Address:<span class="required">*</span></label>
                    <input type="text" class="form-control" id="productName"  name="address" size="10" required>
                </div>
                <div class="form-group ">
                    <label for="title">Mobile Number:</label>
                    <input type="text" class="form-control" id="productName"  name="mobile_no" size="10" >
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Amount Loan:<span class="required">*</span></label>
                            <input type="text" autocomplete="off" class="form-control" id="amount_loaned"  name="amount_loaned" onkeypress="return isNumberKey(event)" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="title">Due Date:<span class="required">*</span></label>
                            <input type="date" class="form-control" id="due_date"  name="due_date" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Daily Payment:<span class="required">*</span> </label>
                            <input type="text" class="form-control" id="daily_payment"  name="daily_payment" readonly >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Term:<span class="required">*</span></label>
                            <select class="form-control"  name="loan_term" id="loan_term" required>
                                <option value="" selected>--Choose Term--</option>
                                <option value="52">52</option>
                                <option value="26">26</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    <style>
        th, td {
            padding: 2px;
            text-align: left;
        }
        .required
        {
            color: red;
        }
    </style>

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

        var loan_term = document.getElementById('loan_term');

        amount_loaned.addEventListener('input',function() {
            total_loan.value = Math.round(this.value * 1.2);
            daily_payment.value = Math.ceil(this.value * 1.2 / 52);
        });

        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }

        loan_term.addEventListener('input', function(){
            var total_with_interest = this.value == '52' ? 1.2 : 1.1;
            if(this.value == '52'){
                total_loan.value = amount_loaned.value * total_with_interest;
                daily_payment.value = Math.ceil(amount_loaned.value * total_with_interest / 52);

                var date_loaned  = document.getElementById('date_loaned');
                var due_date = document.getElementById('due_date');
                var result = new Date(date_loaned.value);
                result.setDate(result.getDate() + 60);
                var month = (result.getMonth() + 1 ) >= '10' ? (result.getMonth() + 1) : '0' + (result.getMonth() + 1);
                var day = result.getDate() >= '10' ? result.getDate() : '0' + result.getDate();
                due_date.value = result.getFullYear() + '-' + month + '-' + day;

            }else {
                total_loan.value = Math.floor(amount_loaned.value * total_with_interest);
                daily_payment.value = Math.ceil(amount_loaned.value * total_with_interest / 26);

                var date_loaned  = document.getElementById('date_loaned');
                var due_date = document.getElementById('due_date');
                var result = new Date(date_loaned.value);
                result.setDate(result.getDate() + 30);
                var month = (result.getMonth() + 1 ) >= '10' ? (result.getMonth() + 1) : '0' + (result.getMonth() + 1);
                var day = result.getDate() >= '10' ? result.getDate() : '0' + result.getDate();
                due_date.value = result.getFullYear() + '-' + month + '-' + day;
            }

        });
    </script>
    <script>
        $(document).ready(function(){
            $('#setButton').click(function () {
                var date_loaned  = document.getElementById('date_loaned');
                var due_date = document.getElementById('due_date');
                var result = new Date(date_loaned.value);
                result.setDate(result.getDate() + 60);
                var month = (result.getMonth() + 1 ) >= '10' ? (result.getMonth() + 1) : '0' + (result.getMonth() + 1);
                var day = result.getDate() >= '10' ? result.getDate() : '0' + result.getDate();
                due_date.value = result.getFullYear() + '-' + month + '-' + day;

                var loan_term = document.getElementById('loan_term');
                loan_term.value = 52;
            })
        });

        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

@stop


