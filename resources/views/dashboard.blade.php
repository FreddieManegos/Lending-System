{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container-fluid">
    <div class="row" >
        <div class="col-md-4">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-blue"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"># Loans</span>
                    <span class="info-box-number">{{$loans_num}}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-yellow"><i class="fa fa-group"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"># Clients</span>
                    <span class="info-box-number">{{$customers_num}}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-red"><i class="fa fa-hourglass-3"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"># Overdues</span>
                    <span class="info-box-number">{{$overdue_num}}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="" id="sales"></div>
        </div>
        <div class="col-md-4" style=" margin-top: 10px; padding-right: 15px; padding-left: 15px;">
            <div style="background-color: white; padding: 10px;">
            <h4>Overdue Loans</h4>
            @if($overdue_num > 0)
            <table class=" table display" style="margin-bottom: 0px;" >
                <thead>
                <tr>
                    <th scope="col" width="10%">#</th>
                    <th scope="col" width="60%">Name</th>
                    <th scope="col" width="30%">Action</th>
                </tr>
                </thead>


                @foreach($overdue_customers as $loan)
                 <tbody>
                    <tr>
                        <td>{{$loan->id}}</td>
                        <td>{{$loan->customer->last_name}}, {{$loan->customer->first_name}}</td>
                        <td>
                            <a href="loan\{{$loan->id}}" class="btn btn-sm btn-warning">View Loan</a>
                        </td>
                    </tr>
                 </tbody>
                @endforeach
            </table>
            @else
                <p style="text-align: center;">Nothing to show</p>
            @endif
            <div style="text-align: center;">
            {{ $overdue_customers->links() }}
            </div>
        </div>
        </div>
    </div>


    {{--<div class="row" style="padding-top: 10px;">--}}
        {{--<div class="col-md-8">--}}
            {{--<canvas id="myChart2" max-width="100" max-height="50" style="background-color: white"></canvas>--}}
        {{--</div>--}}
    {{--</div>--}}
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    
@stop

@section('js')

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $.getJSON('dashboard/sales', function(data){
                Highcharts.chart('sales', {
                    title: {
                        text: 'Net Sales'
                    },

                    subtitle: {
                        text: 'This Week'
                    },

                    yAxis: {
                        title: {
                            text: 'Net Sales'
                        }
                    },
                    xAxis: {
                        categories: data.labels
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },

                    plotOptions: {
                        series: {
                            label: {
                                connectorAllowed: false
                            }
                        }
                    },

                    series: [{
                        name: 'Net Sales',
                        data: data.series,
                        color: "green"
                    }],

                    responsive: {
                        rules: [{
                            condition: {
                                maxWidth: 500
                            },
                            chartOptions: {
                                legend: {
                                    layout: 'horizontal',
                                    align: 'center',
                                    verticalAlign: 'bottom'
                                }
                            }
                        }]
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@stop

