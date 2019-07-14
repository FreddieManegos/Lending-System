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
    @include('collector._modal')
    <div class="text-right">
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#add_collector">
            Add Collector
        </button>
    </div>
    <div class="container-fluid">
        <table class="table table-striped" >
            <tr>
                <th scope="col" width="10%">#</th>
                <th scope="col" width="60%">Name</th>
                <th scope="col" width="30%">Action</th>
            </tr>
            @foreach($collectors as $collector)
            <tr>
                <td>{{$collector->id}}</td>
                <td>{{$collector->name}}</td>
                <td>
                    <a href="" data-toggle="modal" data-target="#edit-" class="btn btn-sm btn-warning">Edit</a>
                    <a href="" data-toggle="modal" data-target="#delete-{{$collector->id}}" class="btn btn-sm btn-danger" title="Delete">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
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

