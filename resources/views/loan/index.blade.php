<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Show Loans</h1>
@stop

@section('content')

    <table id="myTable" class="display">
        <thead>
        <tr>
            <th>Id</th>
            <th>Client Name</th>
            <th>Total Loan</th>
            <th>Amount Loan</th>
            <th>Terms</th>
            <th>Collector</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($loans as $loan)
        <tr>
            <td>{{$loan->id}}</td>
            <td>{{$loan->client_last_name}} , {{$loan->client_first_name}}</td>
            <td>{{$loan->total_loan}}</td>
            <td>{{$loan->amount_loaned}}</td>
            <td>{{$loan->loan_term}}</td>
            <td>Collector 1</td>
            <td>
                <a href="" data-toggle="modal" data-target="#view-{{$loan->id}}"><button class="btn btn-primary">View</button></a>
                <a href="" data-toggle="modal" data-target="#edit-{{$loan->id}}"><button class="btn btn-primary">Delete</button></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
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

