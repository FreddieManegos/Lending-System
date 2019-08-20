
<style>
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
</style>

<h3 style="text-align: center">Golden Sand Lending Corporation <span></span></h3>
<p><span style="text-align: left">Collector: <strong>{{$data->first()->collector->name}}</strong></span> || Date: <strong>{{\Carbon\Carbon::today()->toDateString()}}</strong></p>
<input type="hidden" value="{{$count=0}}">

<table>
    <thead>
    <tr>
        <th></th>
        <th>Name of the Clients</th>
        <th>Balance</th>
        <th>PerDay</th>
        <th>Remarks</th>
    </tr>
    </thead>
    <tbody>

    @foreach($data as $loan)
        <tr>
            <td>{{ $count++ }}</td>
            <td>{{$loan->customer->last_name}}, {{$loan->customer->first_name}}</td>
            <td>{{$loan->balance}}</td>
            <td>{{$loan->daily_payment}}</td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>


{{--@foreach($data as $customer)--}}
{{--{{}}--}}
{{--<tr>--}}
{{--<td>{{ $count }}</td>--}}
{{--<td>{{$customer['last_name']}}</td>--}}
{{--<td>10,000</td>--}}
{{--<td></td>--}}
{{--</tr>--}}
{{--@endforeach--}}
