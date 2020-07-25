
<style>
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
</style>

@foreach($data as $loan)
<div style="clear:both; position:relative;">
    <div style="position:absolute; left:0pt; width:280pt;">
        <div class="h3" style="text-align: center; font-size: 24px;"><strong>Golden Sand Capital Ventures</strong></div>
        <div style="text-align: center; font-family: 18px;">Crossing Tambo, Iligan City</div>
        <br>
        <div class="row">
            Acc. No._______
            Area ____
            Remarks ______
        </div>
        <div class="row">
            Total Loan <strong><u>{{$total_loan = $loan->total_loan}}</u></strong>
            Date Loan <strong><u>{{\Carbon\Carbon::parse($loan->date_loaned)->format('M d Y')}}</u></strong>
        </div>
        <div class="row">
            Client's Name: <strong><u>{{$loan->customer->last_name}}, {{$loan->customer->first_name}}</u></strong>
        </div>
        <div class="row">
            Address: <strong><u>{{$loan->customer->address}}</u></strong>
        </div>
        <div class="row">
            Mobile No. <strong><u>{{$loan->customer->mobile_no}}</u></strong>_______________
        </div>
        <div class="row">
            Amount Loan: <strong><u>{{$loan->amount_loaned}}</u></strong>
            Due Date: <strong><u>{{$loan->due_date}}</u></strong>
        </div>
        <div class="row">
            Daily Payment: <strong><u>{{$loan->daily_payment}}</u></strong>
            Term:<strong><u> {{$loan->loan_term}}</u></strong>
        </div>
        <div class="row">
            ========================================
        </div>
        <div style="clear:both; position:relative;">
            <div style="position:absolute; left:0pt; width:140pt;">
                Date &nbsp;&nbsp;&nbsp;&nbsp; Payment &nbsp;  BAL <br>
                @foreach($loan->payment as $key=>$payment)
                    <div style="padding-top: 5px;">
                    @if(++$key <=  30)
                        {{$key ++ }}. <u>{{\Carbon\Carbon::parse($payment->date)->format('m/d')}}</u>
                        @if($payment->if_sunday != 1)
                            @if($payment->status == 1)
                            &nbsp;&nbsp;<strong><u>{{$payment->payment_amount}}</u></strong>
                            &nbsp;&nbsp;&nbsp;<strong><u>{{$total_loan -= $payment->payment_amount}}</u></strong>
                            @else
                            &nbsp;&nbsp;______
                            &nbsp;______
                            @endif

                        @else
                            &nbsp;&nbsp; SUN
                            &nbsp;&nbsp;______
                        @endif
                        <br>
                    @endif
                    </div>
                @endforeach
            </div>
            <div style="margin-left:140pt;">
                Date &nbsp;&nbsp;&nbsp;&nbsp; Payment &nbsp;  BAL <br>
                @foreach($loan->payment as $key=>$payment)
                    <div style="padding-top: 5px;">
                    @if(++$key >  30 && $key <= 60)
                        {{$key ++ - 30 }}. <u>{{\Carbon\Carbon::parse($payment->date)->format('m/d')}}</u>
                            @if($payment->if_sunday != 1)
                                @if($payment->status == 1)
                                    &nbsp;&nbsp;<strong><u>{{$payment->payment_amount}}</u></strong>
                                    &nbsp;&nbsp;&nbsp;<strong><u>{{$total_loan -= $payment->payment_amount}}</u></strong>
                                @else
                                    &nbsp;&nbsp;______
                                    &nbsp;______
                                @endif

                            @else
                                &nbsp;&nbsp; SUN
                                &nbsp;&nbsp;______
                            @endif
                    @endif
                    </div>
                @endforeach
            </div>
            <div class="row">
                =========================================
        </div>

    </div>
    {{--<div style="margin-left:285pt;">--}}
        {{--<div class="h3" style="text-align: center; font-size: 24px;"><strong>Golden Sand Capital Ventures</strong></div>--}}
        {{--<div style="text-align: center; font-family: 18px;">Crossing Tambo, Iligan City</div>--}}
        {{--<br>--}}
        {{--<div class="row">--}}
            {{--Acc. No._______--}}
            {{--Area ____--}}
            {{--Remarks ______--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--Total Loan <strong><u>{{$loan->total_loan}}</u></strong>--}}
            {{--Date Loan <strong><u>{{$loan->date_loaned}}</u></strong>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--Client's Name: <strong><u>{{$loan->customer->last_name}}, {{$loan->customer->first_name}}</u></strong>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--Address: <strong><u>{{$loan->customer->address}}</u></strong>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--Mobile No. <strong><u>{{$loan->customer->mobile_no}}</u></strong>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--Amount Loan: <strong><u>{{$loan->amount_loaned}}</u></strong>--}}
            {{--Due Date: <strong><u>{{$loan->due_date}}</u></strong>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--Daily Payment: <strong><u>{{$loan->daily_payment}}</u></strong>--}}
            {{--Term:<strong><u> {{$loan->loan_term}}</u></strong>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--=========================================--}}
        {{--</div>--}}
        {{--<div style="clear:both; position:relative;">--}}
            {{--<div style="position:absolute; left:0pt; width:140pt;">--}}
                {{--Date &nbsp;&nbsp;&nbsp;&nbsp; Payment &nbsp;  BAL <br>--}}
                {{--@foreach($loan->payment as $key=>$payment)--}}
                    {{--<div style="padding-top: 5px;">--}}
                    {{--@if(++$key <=  30)--}}
                        {{--{{$key ++ }}. <u>{{\Carbon\Carbon::parse($payment->date)->format('m/d')}}</u>--}}
                            {{--@if($payment->if_sunday != 1)--}}
                                {{--@if($payment->status == 1 )--}}
                                    {{--&nbsp;<strong>{{$payment->payment_amount}}</strong>--}}
                                {{--@else--}}
                                    {{--&nbsp;______--}}
                                {{--@endif--}}
                                {{--&nbsp;______--}}
                            {{--@else--}}
                                {{--&nbsp; SUN--}}
                                {{--&nbsp;______--}}
                            {{--@endif--}}
                        {{--<br>--}}
                    {{--@endif--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
            {{--<div style="margin-left:140pt;">--}}
                {{--Date &nbsp;&nbsp;&nbsp;&nbsp; Payment &nbsp;  BAL <br>--}}
                {{--@foreach($loan->payment as $key=>$payment)--}}
                    {{--<div style="padding-top: 5px;">--}}
                    {{--@if(++$key >  30 && $key <= 60)--}}
                        {{--{{$key ++ - 30 }}. <u>{{\Carbon\Carbon::parse($payment->date)->format('m/d')}}</u>--}}
                            {{--@if($payment->if_sunday != 1)--}}
                                {{--@if($payment->status == 1 )--}}
                                    {{--&nbsp;<strong>{{$payment->payment_amount}}</strong>--}}
                                {{--@else--}}
                                    {{--&nbsp;____--}}
                                {{--@endif--}}
                                {{--&nbsp;____--}}
                            {{--@else--}}
                                {{--&nbsp; SUN--}}
                                {{--&nbsp;____--}}
                            {{--@endif--}}
                        {{--<br>--}}
                    {{--@endif--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>
@endforeach
