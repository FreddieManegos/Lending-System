{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Customers</h1>
@stop

@section('content')

    @include('customer._modal')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="container-fluid">
                <table id="myTable" class="display">
                    <thead>
                    <tr>
                        <th scope="col" width="10%">#</th>
                        <th scope="col" width="60%">Name</th>
                        <th scope="col" width="30%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer->id}}</td>
                            <td> {{$customer->last_name}}, {{$customer->first_name}}</td>
                            <td>
                                <a href="" data-toggle="modal" data-target="#view-loans-{{$customer->id }}" class="btn btn-sm btn-warning">View All Loans</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{--<div class="col-md-4">--}}
            {{--<a href="customer/view_table" target="_blank"> <button class="btn btn-primary">Export PDF</button>  </a>--}}
            {{--<a href="{{ URL::to('/customer/pdf') }}" target="_blank"> <button class="btn btn-primary">Export PDF</button>  </a>--}}
        {{--</div>--}}
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

