{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Backup</h1>
@stop

@section('content')
    {{\Illuminate\Support\Facades\Storage::get('public/mysql/2019-08-30_34_58.sql')}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script></script>
@stop

