
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
            Total Loan <strong><u>{{$loan->total_loan}}</u></strong>
            Date Loan <strong><u>{{$loan->date_loaned}}</u></strong>
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
                    <div style="padding-top: 4px;">
                    @if(++$key <=  30)
                        {{$key ++ }}. <u>{{\Carbon\Carbon::parse($payment->date)->format('m/d')}}</u>
                        @if($payment->if_sunday != 1)
                            &nbsp;______
                            &nbsp;______
                        @else
                            &nbsp; SUN
                            &nbsp;______
                        @endif
                        <br>
                    @endif
                    </div>
                @endforeach
            </div>
            <div style="margin-left:140pt;">
                Date &nbsp;&nbsp;&nbsp;&nbsp; Payment &nbsp;  BAL <br>
                @foreach($loan->payment as $key=>$payment)
                    <div style="padding-top: 4px;">
                    @if(++$key >  30)
                        {{$key ++ - 30 }}. <u>{{\Carbon\Carbon::parse($payment->date)->format('m/d')}}</u>
                        @if($payment->if_sunday != 1)
                            &nbsp; ______
                            &nbsp;______
                        @else
                            &nbsp; SUN
                            &nbsp;______
                        @endif
                        <br>
                    @endif
                    </div>
                @endforeach
            </div>
            <div class="row">
                =================================================================================
            </div>
        </div>

    </div>
    <div style="margin-left:285pt;">
        <div class="h3" style="text-align: center; font-size: 24px;"><strong>Golden Sand Capital Ventures</strong></div>
        <div style="text-align: center; font-family: 18px;">Crossing Tambo, Iligan City</div>
        <br>
        <div class="row">
            Acc. No._______
            Area ____
            Remarks ______
        </div>
        <div class="row">
            Total Loan <strong><u>{{$loan->total_loan}}</u></strong>
            Date Loan <strong><u>{{$loan->date_loaned}}</u></strong>
        </div>
        <div class="row">
            Client's Name: <strong><u>{{$loan->customer->last_name}}, {{$loan->customer->first_name}}</u></strong>
        </div>
        <div class="row">
            Address: <strong><u>{{$loan->customer->address}}</u></strong>
        </div>
        <div class="row">
            Mobile No. <strong><u>{{$loan->customer->mobile_no}}</u></strong>
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
            =========================================
        </div>
        <div style="clear:both; position:relative;">
            <div style="position:absolute; left:0pt; width:140pt;">
                Date &nbsp;&nbsp;&nbsp;&nbsp; Payment &nbsp;  BAL <br>
                @foreach($loan->payment as $key=>$payment)
                    <div style="padding-top: 4px;">
                    @if(++$key <=  30)
                        {{$key ++ }}. <u>{{\Carbon\Carbon::parse($payment->date)->format('m/d')}}</u>
                        @if($payment->if_sunday != 1)
                            &nbsp; _____
                            &nbsp;_____

                        @else
                            &nbsp; SUN
                            &nbsp;_____
                        @endif
                        <br>
                    @endif
                    </div>
                @endforeach
            </div>
            <div style="margin-left:140pt;">
                Date &nbsp;&nbsp;&nbsp;&nbsp; Payment &nbsp;  BAL <br>
                @foreach($loan->payment as $key=>$payment)
                    <div style="padding-top: 4px;">
                    @if(++$key >  30)
                        {{$key ++ - 30 }}. <u>{{\Carbon\Carbon::parse($payment->date)->format('m/d')}}</u>
                        @if($payment->if_sunday != 1)
                            &nbsp; ____
                            &nbsp;____
                        @else
                            &nbsp; SUN
                            &nbsp;____
                        @endif
                        <br>
                    @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endforeach
