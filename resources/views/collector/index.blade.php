{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Collector</h1>
@stop

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if(session()->has('danger'))
        <div class="alert alert-danger">
            {{ session()->get('danger') }}
        </div>
    @endif
    @include('collector._modal')
    <div class="row">
        <div class="col-md-12">
            <div class="text-right" style="padding-right: 15px;">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#add_collector">
                    Add Collector
                </button>
            </div>
            <div class="container-fluid" style="background-color: white; padding: 10px;">
                <table id="" class="table table-striped myTable" >
                    <thead>
                    <tr>
                        <th scope="col" width="10%">#</th>
                        <th scope="col" width="60%">Name</th>
                        <th scope="col" width="30%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($collectors as $collector)
                    <tr>
                        <td>{{$collector->id}}</td>
                        <td>{{$collector->name}}</td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#view-clients-{{$collector->id}}" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-group"></i></a>
                            <a href="" data-toggle="modal" data-target="#edit-{{$collector->id}}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="" data-toggle="modal" data-target="#delete-{{$collector->id}}" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-fw fa-times"></i></a>
                            <a href="collector/pdf/{{$collector->id}}" target="_blank" class="btn btn-sm btn-success" > <i class="fa fa-fw fa-print"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
@stop

@section('js')
    <script>
        $(document).ready( function () {
            $('.myTable').DataTable();
        } );
    </script>

@stop

