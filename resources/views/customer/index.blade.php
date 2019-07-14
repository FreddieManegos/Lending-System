{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Customer</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-8">
            <div class="container-fluid">
                <table id="myTable" class="display">
                    <tr>
                        <th scope="col" width="10%">#</th>
                        <th scope="col" width="60%">Name</th>
                        <th scope="col" width="30%">Action</th>
                    </tr>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer->id}}</td>
                            <td> {{$customer->last_name}}, {{$customer->first_name}}</td>
                            <td>
                                <a href="" data-toggle="modal" data-target="#edit-" class="btn btn-sm btn-warning">Edit</a>
                                <a href="" data-toggle="modal" data-target="#delete-{{$customer->id}}" class="btn btn-sm btn-danger" title="Delete">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
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
    </script>
@stop

