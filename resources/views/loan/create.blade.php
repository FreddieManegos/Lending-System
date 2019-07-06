
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
                            <input type="text" class="form-control" id="productName"  name="total_loan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="title">Date Loan:</label>
                            <input type="date" class="form-control" id="productName"  name="date_loaned">
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
                            <input type="text" class="form-control" id="productName"  name="amount_loaned">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="title">Due Date:</label>
                            <input type="date" class="form-control" id="productName"  name="due_date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Daily Payment: </label>
                            <input type="text" class="form-control" id="productName"  name="daily_payment">
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
            Hello
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

    </script>
@stop

