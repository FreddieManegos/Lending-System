
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
    @endif
    <div class="row">
        <div class="col-md-6"  style="    background: rgba(245, 198, 18, 0.54);">
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
                            <label for="title">Collector:</label>
                            <select class="form-control" name="collector_id" required >
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
                            <label for="title">Total Loan:</label>
                            <input type="text" class="form-control" id="total_loan"  name="total_loan" readonly required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <label for="title">Date Loan:</label>
                            <input type="date" class="form-control" id="date_loaned"  name="date_loaned" required>
                            <div class="input-group-addon" style="
                                border-color: #ecf0f5;
                                background-color: #ecf0f5;">
                                <button class="input-group-text btn" type="button" id="setButton">Set</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">First Name:</label>
                            <input type="text" class="form-control" id="productName"  name="first_name" placeholder="First Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Last Name:</label>
                            <input type="text" class="form-control" id="productName"  name="last_name" placeholder="Last Name" required>
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="title">Address:</label>
                    <input type="text" class="form-control" id="productName"  name="address" size="10" required>
                </div>
                <div class="form-group ">
                    <label for="title">Mobile Number:</label>
                    <input type="text" class="form-control" id="productName"  name="mobile_no" size="10" >
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Amount Loan:</label>
                            <input type="text" autocomplete="off" class="form-control" id="amount_loaned"  name="amount_loaned" onkeypress="return isNumberKey(event)" >
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
                            <input type="text" class="form-control" id="daily_payment"  name="daily_payment" readonly >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Term:</label>
                            <select class="form-control"  name="loan_term" id="loan_term" required>
                                <option >52</option>
                                <option>26</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-3">
            {{--<table class="TABLE"></table>--}}
            <div id="dvTable"></div>
        </div>
        <div class="col-md-3">
            {{--<table class="TABLE"></table>--}}
            <div id="dvTable2"></div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    <style>
        th, td {
            padding: 2px;
            text-align: left;
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
            total_loan.value = (this.value * 1.2);
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
            }else {
                total_loan.value = Math.floor(amount_loaned.value * total_with_interest);
                daily_payment.value = Math.ceil(amount_loaned.value * total_with_interest / 26);
            }
            // var customers = new Array();
            // var date_loaned = document.getElementById('date_loaned');
            // var incremented_date = new Date(date_loaned.value);
            //
            // customers.push(["Date", "Payment", "Balance"]);
            // for(var i = 1; i <= 30 ; i++)
            //   customers.push([ incremented_date.addDays(i).getMonth() + 1+'/'+ incremented_date.addDays(i).getDate(), , total_loan.value]);
            //
            // //Create a HTML Table element.
            // var table = document.createElement("TABLE");
            // table.border = "1";
            //
            // //Get the count of columns.
            // var columnCount = customers[0].length;
            //
            // //Add the header row.
            // var row = table.insertRow(-1);
            // for (var i = 0; i < columnCount; i++) {
            //     var headerCell = document.createElement("TH");
            //     headerCell.innerHTML = customers[0][i];
            //     row.appendChild(headerCell);
            // }
            //
            // //Add the data rows.
            // for (var i = 1; i < customers.length; i++) {
            //     row = table.insertRow(-1);
            //     for (var j = 0; j < columnCount; j++) {
            //         var cell = row.insertCell(-1);
            //         cell.innerHTML = customers[i][j];
            //     }
            // }
            // var dvTable = document.getElementById("dvTable");
            // dvTable.innerHTML = "";
            // dvTable.appendChild(table);
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


