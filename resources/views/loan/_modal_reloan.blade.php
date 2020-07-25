
<div class="modal" tabindex="-1" role="dialog" id="reloan-{{$loan->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"><h3>Overdue Reloan</h3></div>
            <div class="modal-body">
                <form action="{{route('loan.reloan')}}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="original_id" id="original_id" value="{{$loan->id}}">
                                <label for="title">Account Number:</label>
                                <input type="text" class="form-control" id="productName"  name="account_no" size="10" required readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="title">Collector:</label>
                                <select class="form-control" name="reloan_collector_id" required>
                                    @foreach($collectors as $collector)
                                        <option value="{{$collector->id}}">{{$collector->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Total Loan:</label>
                                <input type="text" class="form-control" id="reloan_total_loan"  name="reloan_total_loan" readonly required value="{{ ceil($loan->balance * 1.2) }}" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="title">Date Loan:</label>
                            <input type="date" class="form-control" id="reloan_date_loaned"  name="reloan_date_loaned" required readonly value="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">First Name:</label>
                                <input type="text" class="form-control" id="productName"  name="reloan_first_name" placeholder="First Name" required value="{{$loan->customer->first_name}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Last Name:</label>
                                <input type="text" class="form-control" id="productName"  name="reloan_last_name" placeholder="Last Name" required value="{{$loan->customer->last_name}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="title">Address:</label>
                        <input type="text" class="form-control" id="productName"  name="reloan_address" size="10" required readonly value="{{$loan->customer->address}}">
                    </div>
                    <div class="form-group ">
                        <label for="title">Mobile Number:</label>
                        <input type="text" class="form-control" id="productName"  name="reloan_mobile_no" size="10" readonly value="{{$loan->customer->mobile_no}}" >
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Amount Loan:</label>
                                <input type="text" autocomplete="off" class="form-control" id="reloan_amount_loaned"  name="reloan_amount_loaned" readonly value="{{$loan->balance}}" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="title">Due Date:</label>
                                <input type="date" class="form-control" id="reloan_due_date"  name="reloan_due_date" readonly value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Daily Payment: </label>
                                <input type="text" class="form-control" id="reloan_daily_payment"  name="reloan_daily_payment" readonly value="{{ceil($loan->balance * 1.2 / 52)}}" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Term:</label>
                                <select class="form-control"  name="reloan_loan_term" id="reloan_loan_term" required>
                                    <option value="" selected>--Choose Term--</option>
                                    <option value="52">52</option>
                                    <option value="26">26</option>
                                    <option value="44">44</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Reloan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="extend-{{$loan->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"><h3>Extend</h3></div>
            <div class="modal-body">
                <form action="{{route('payment.store')}}" method="POST">
                {{csrf_field()}}
                    <p class="text-center">Are you sure you want to extend Loan <<b>{{$loan->customer->last_name}}, {{ $loan->customer->first_name }}</b>>?</p>
                    <input type="hidden" value="{{$loan->id}}" name="id">
                    <button type="submit" class="btn btn-success">Yes, Extend</button>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>




