{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Customer</h1>
@stop

@section('content')
    <div class="container-fluid">
        <table class="table table-striped">
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

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

    </script>
@stop

